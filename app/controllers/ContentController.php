<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class ContentController extends BaseController{
	public $contenttitle = '';
	public function initialize(){
        $this->tag->setTitle('Content');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if(!empty($this->dispatcher->getParam('city')))
			$this->city = $this->dispatcher->getParam('city');
			$this->view->city = $this->city;
		
		
		if(!empty($this->dispatcher->getParam('contenttitle')))
			$this->contenttitle = $this->dispatcher->getParam('contenttitle');
			$this->view->contenttitle = $this->contenttitle;
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\bc-[0-9]{1,}\b/i', $this->contenttitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        $contentdetail = $Solr->getDetailResults();
		foreach($contentdetail['images'] as $key=>$images){
			if(!empty($images['uri'])){
				if(substr($images['uri'], 0, 4) != 'http'){
					$contentdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
				}
			}
		}
		$this->view->contentdetail = $contentdetail;
    }
}
