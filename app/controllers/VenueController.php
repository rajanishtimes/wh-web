<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class VenueController extends BaseController{
	public $venue;
	public function initialize(){
        $this->tag->setTitle('Venue');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if(!empty($this->dispatcher->getParam('venue')))
			$this->venue = $this->dispatcher->getParam('venue');
		
		$this->view->setVars(array(
			'venue' => $this->venue
		));
		
		parent::initialize();
    }

    public function indexAction(){
		preg_match('/\b-v-[0-9]{1,}\b/i', $this->venue, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
        $venuedetail = $Solr->getDetailResults();
		exit;
		foreach($contentdetail['images'] as $key=>$images){
			if(!empty($images['uri'])){
				if(substr($images['uri'], 0, 4) != 'http'){
					$contentdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
				}
			}
		}
		$contentdetail['author']['slug'] = $this->create_slug($contentdetail['author']['name']).'-'.$contentdetail['author']['id'];
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($contentdetail['title']))) =>''));
		
		$this->view->setVars(array(
			'contentdetail' => $contentdetail,
			'breadcrumbs' => $breadcrumbs
		));
    }
}
