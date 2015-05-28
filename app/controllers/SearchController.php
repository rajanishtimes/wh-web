<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class SearchController extends BaseController{
	public function initialize(){
		$this->setlogsarray('search_start');
		$this->view->setLayout('ajaxLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        parent::initialize();
    }
	
	public function indexAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->create_title($this->request->getPost('searchkeyword'));
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$city = $this->request->getPost('city');
		$fromtype = $this->request->getPost('type');
		$this->view->entitytype = 'search';
		
		try{
			if($bydate == 'Event'){
				$allfeedslist = $this->getfeeddata($start, $limit, $city, 'all', $tags, $searchkeyword, $bydate, '', $fromtype);
			}else{
				$allfeedslist = $this->getfeeddata($start, $limit, $city, $bydate, $tags, $searchkeyword, 'Event,Content', '', $fromtype);
			}
			$this->setlogsarray('search_get_records');
		}catch(Exception $e){
			$allfeedslist = array();
		}

		/* ======= Seo Update ============= */
		$this->tag->setTitle($searchkeyword.' | '.$this->config->application->SiteName);
		$this->view->meta_description = 'Find all information related to '.$searchkeyword.' at '.$this->config->application->SiteName;
		$this->view->meta_keywords = $searchkeyword;
		$this->view->deep_link = 'timescity://ty=s&qu'.$searchkeyword;
		/* ======= Seo Update ============= */
		
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
				'city' => $city,
				'cityshown' => $this->cityshown($city),
				'fromtype' => $fromtype
				)
			);
			
		$this->setlogsarray('search_end');
		$this->getlogs('search', $this->baseUrl.'/search/'.$searchkeyword);
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
				foreach($autosuggestresult['suggestions'] as $key=>$autos){
					$autosuggestresult['suggestions'][$key] = str_replace("/"," ",stripslashes($autos));
				}
			}catch(Exception $e){
				$autosuggestresult['suggestions'] = array();
			}
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
	
	
	public function searchAction(){
		$this->view->setLayout('mainLayout');
		$searchkeyword = '';
		if($this->dispatcher->getParam('searchquery'))
			$searchkeyword = $this->create_title($this->dispatcher->getParam('searchquery'));
		
		$this->view->entityid = 0;
		$this->view->entitytype = 'search';
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->currentCity, '', '', $searchkeyword, '', '', 'search');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		
		
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($searchkeyword))) =>''));
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'searchresultcount' => count($allfeedslist),
				'searchkeyword'=>$searchkeyword,
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs,
				'cityshown' =>$this->cityshown($this->currentCity)
				)
			);
			
		/* ======= Seo Update ============= */
		if($searchkeyword){
			$this->tag->setTitle($searchkeyword.' | '.$this->config->application->SiteName);
		}else{
			$this->tag->setTitle('Search | '.$this->config->application->SiteName);
		}
		$this->view->meta_description = 'Find all information related to '.$searchkeyword.' at '.$this->config->application->SiteName;
		$this->view->meta_keywords = $searchkeyword;
		$this->view->deep_link = 'timescity://ty=s&qu'.$searchkeyword;
		/* ======= Seo Update ============= */
		
    }
	
	public function searchlistAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->create_title($this->request->getPost('searchkeyword'));
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$cities = $this->request->getPost('city');

		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $cities, $bydate, $tags, $searchkeyword, '', '', 'search');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'searchresultcount' => count($allfeedslist),
				'mainurl'=>$mainurl,
				'searchkeyword'=>$searchkeyword,
				'start'=>$start+$limit,
				'limit'=>$limit,
				'tags'=>$tags,
				'bydate'=>$bydate,
				'parentid'=>$parentid,
				'cities'=>$cities,
				'cityshown' =>$this->cityshown($cities)
				)
			);
    }
	
	public function forwardsearchAction(){
		$searchkeyword = htmlentities($this->request->getPost('search'));
		$searchkeyword = str_replace("/"," ",stripslashes($searchkeyword));
		$searchkeyword = urlencode($searchkeyword);
		$url = $this->baseUrl.'/'.$this->currentCity.'/search/'.$searchkeyword;
		return $this->response->redirect($url);     
	}
}
