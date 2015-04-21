<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class EventController extends BaseController{
	public $eventtitle = '';
	public function initialize(){
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('city'))
			$this->city = $this->dispatcher->getParam('city');		
		
		if($this->dispatcher->getParam('eventtitle'))
			$this->eventtitle = $this->dispatcher->getParam('eventtitle');
		
		$this->view->setVars(
			array(
				'city' => $this->city,
				'eventtitle' => $this->eventtitle
				)
			);
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
		if($eventdetail){			
			foreach($eventdetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$eventdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			}
			$eventdetail['venue']['slug'] = $this->create_slug($eventdetail['venue']['name']).'-v-'.str_replace('_', '-', strtolower($eventdetail['venue']['id']));
			/* ======= Seo Update ============= */
			if($eventdetail['page_title']){
				$this->tag->setTitle($eventdetail['page_title']);
			}
				
			$this->view->meta_description = $eventdetail['meta_description'];
			$this->view->meta_keywords = $eventdetail['meta_keywords'];
			$this->view->og_title = $eventdetail['og_title'];
			$this->view->og_type = 'Event';
			$this->view->og_description = $eventdetail['og_description'];
			$this->view->og_image = $eventdetail['og_image'];
			$this->view->og_url = $this->baseUrl.$eventdetail['url'];
			/* ======= Seo Update ============= */
			
			$breadcrumbs = $this->breadcrumbs(array(
				ucwords($this->city) => $this->baseUrl.$this->city,
				ucwords(strtolower(trim($eventdetail['title']))) =>''
			));
			$this->view->setVars(array('eventdetail' => $eventdetail, 'breadcrumbs'=>$breadcrumbs));
		}else{
			$this->forwardtoerrorpage(404);
		}
    }
}
