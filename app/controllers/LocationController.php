<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class LocationController extends BaseController{
	public function initialize(){
		$this->setlogsarray('location_start');
		$this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        parent::initialize();
    }
	
	public function indexAction(){
		$this->response->setHeader('Cache-Control', 'max-age=900');
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->request->getPost('searchkeyword');
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');

		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->city, $bydate, $tags, $searchkeyword);
			$this->setlogsarray('location_get_records');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'mainurl'=>$mainurl,
				'searchkeyword'=>$searchkeyword,
				'start'=>$start+$limit,
				'limit'=>$limit,
				'tags'=>$tags,
				'bydate'=>$bydate,
				'parentid'=>$parentid
				)
			);
		$this->setlogsarray('location_end');
		$this->getlogs('location', $this->baseUrl.'/'.$this->city.'/location/'.$searchkeyword);
    }
	
    public function autosuggestionAction(){
		if ($this->request->isAjax() == true) {
			$Suggestion = new \WH\Model\Solr();
			$searchkeyword = $this->request->get("search");
			$Suggestion->setParam('searchname',$searchkeyword);
			$Suggestion->setParam('bycity',$this->currentCity);
			$Suggestion->setAutoSuggest();
			try{
				$autosuggestresult = $Suggestion->getSuggestResults();
			}catch(Exception $e){
				$autosuggestresult = array();
			}
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
	
	
	public function locationAction(){
		$this->view->setLayout('mainLayout');
		if($this->dispatcher->getParam('locationname'))
			$searchkeyword = $this->dispatcher->getParam('locationname');
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->currentCity, '', '', '', '', $searchkeyword);
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($searchkeyword))) =>''));
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'locationresultcount' => count($allfeedslist),
				'searchkeyword'=>$searchkeyword,
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs
				)
			);
			
		/* ======= Seo Update ============= */
		if($searchkeyword){
			$this->tag->setTitle($searchkeyword.' | '.$this->config->application->SiteName);
		}else{
			$this->tag->setTitle('Search | '.$this->config->application->SiteName);
		}
		$this->view->meta_description = $searchkeyword;
		$this->view->meta_keywords = $searchkeyword;
		/* ======= Seo Update ============= */
		
    }
	
	public function locationlistAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->request->getPost('searchkeyword');
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$cities = $this->request->getPost('city');

		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $cities, $bydate, $tags, $searchkeyword);
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'mainurl'=>$mainurl,
				'searchkeyword'=>$searchkeyword,
				'start'=>$start+$limit,
				'limit'=>$limit,
				'tags'=>$tags,
				'bydate'=>$bydate,
				'parentid'=>$parentid,
				'cities'=>$cities
				)
			);
    }
	
	public function forwardlocationAction(){
		$searchkeyword = $this->request->getPost('location');
		$url = $this->baseUrl.'/'.$this->currentCity.'/location/'.$searchkeyword;
		return $this->response->redirect($url);     
	}
}
