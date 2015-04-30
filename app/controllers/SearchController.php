<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class SearchController extends BaseController{
	public function initialize(){
		$this->view->setLayout('ajaxLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        parent::initialize();
    }
	
	public function indexAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->request->getPost('searchkeyword');
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');

		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->city, $bydate, $tags, $searchkeyword, 'Event,Content', '', 4);
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
    }
	
    public function autosuggestionAction(){
		if ($this->request->isAjax() == true) {
			$Suggestion = new \WH\Model\Solr();
			$searchkeyword = $this->request->get("search");
			$Suggestion->setParam('searchname',$searchkeyword);
			$Suggestion->setParam('bycity',$this->city);
			$Suggestion->setAutoSuggest();
			try{
				$autosuggestresult = $Suggestion->getSuggestResults();
				foreach($autosuggestresult['suggestions'] as $key=>$autos){
					$autosuggestresult['suggestions'][$key] = stripslashes($autos);
				}
			}catch(Exception $e){
				$autosuggestresult = array();
			}
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
	
	
	public function searchAction(){
		$this->view->setLayout('mainLayout');
		if($this->dispatcher->getParam('searchquery'))
			$searchkeyword = $this->dispatcher->getParam('searchquery');
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->city, '', '', $searchkeyword);
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($searchkeyword))) =>''));
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
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
	
	public function searchlistAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->request->getPost('searchkeyword');
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');

		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->city, $bydate, $tags, $searchkeyword);
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
    }
	
	public function forwardsearchAction(){
		$searchkeyword = $this->request->getPost('search');
		$url = $this->baseUrl.'/'.'search/'.$searchkeyword;
		return $this->response->redirect($url);     
	}
}
