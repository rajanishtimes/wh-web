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

		$allfeedslist = $this->getfeeddata($start, $limit, $this->city, $bydate, $tags, $searchkeyword, 'Event,Content');
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
			$autosuggestresult = $Suggestion->getSuggestResults();
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
}
