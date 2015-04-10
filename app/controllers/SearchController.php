<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class SearchController extends BaseController{
	public function initialize(){
		$this->view->setLayout('ajaxLayout');
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
		
		//echo $start.' '.$limit.' '.$this->city.' '.$bydate.' '.$tags.' '.$searchkeyword; exit;
		
		$allfeedslist = $this->getfeeddata($start, $limit, $this->city, $bydate, $tags, $searchkeyword);
		
		$this->view->allfeedslist = $allfeedslist;
		$this->view->mainurl = $mainurl;
		$this->view->searchkeyword = $searchkeyword;
		$this->view->start = $start+1;
		$this->view->limit = $limit;
		$this->view->tags = $tags;
		$this->view->bydate = $bydate;
		$this->view->parentid = $parentid;
		
    }
	
    public function autosuggestionAction(){
		if ($this->request->isAjax() == true) {
			$Suggestion = new \WH\Model\Solr();
			$searchkeyword = $this->request->get("search");
			$Suggestion->setParam('searchname',$searchkeyword);
			$Suggestion->setParam('bycity',$this->city);
			$Suggestion->setAutoSuggest();
			$autosuggestresult = $Suggestion->getSuggestResults();
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
}
