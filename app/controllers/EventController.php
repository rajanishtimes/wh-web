<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class EventController extends BaseController{
	public $eventtitle = '';
	public function initialize(){
        $this->tag->setTitle('Event');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if(!empty($this->dispatcher->getParam('city')))
			$this->city = $this->dispatcher->getParam('city');
			$this->view->city = $this->city;
		
		
		if(!empty($this->dispatcher->getParam('eventtitle')))
			$this->eventtitle = $this->dispatcher->getParam('eventtitle');
			$this->view->eventtitle = $this->eventtitle;
		
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\be-[0-9]{1,}\b/i', $this->eventtitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        $eventdetail = $Solr->getDetailResults();
		foreach($eventdetail['images'] as $key=>$images){
			if(!empty($images['uri'])){
				if(substr($images['uri'], 0, 4) != 'http'){
					$eventdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
				}
			}
		}		
		$this->view->eventdetail = $eventdetail;
    }
}
