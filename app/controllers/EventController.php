<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class EventController extends BaseController{
	public $eventtitle = '';
	public function initialize(){
		$this->setlogsarray('event_start');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		/* if($this->dispatcher->getParam('city'))
			$this->city = $this->dispatcher->getParam('city');		 */
		
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
		$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\be-[0-9]{1,}\b/i', $this->eventtitle, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
		
		$this->view->entityid = $id;
		$this->view->entitytype = 'event';
		
		try{
			$eventdetail = $Solr->getDetailResults();
			$this->setlogsarray('event_get_detail');
		}catch(Exception $e){
			$eventdetail = array();
		}
        
		if($eventdetail){			
			$this->validateRequest($eventdetail['url']);
			/* foreach($eventdetail['images'] as $key=>$images){
				if($images['uri']){
					if(substr($images['uri'], 0, 4) != 'http'){
						$eventdetail['images'][$key]['uri'] = $this->config->application->imgbaseUri.$images['uri'];
					}
				}
			} */
			$eventdetail['venue']['slug'] = $this->create_slug($eventdetail['venue']['name']).'-v-'.str_replace('_', '-', strtolower($eventdetail['venue']['id']));
			/* ======= Seo Update ============= */
			if($eventdetail['page_title']){
				$this->tag->setTitle($eventdetail['page_title']);
			}
				
			$this->view->meta_description = $eventdetail['meta_description'];
			$this->view->meta_keywords = $eventdetail['meta_keywords'];
			$this->view->og_title = $eventdetail['og_title'];
			$this->view->og_type = 'website';
			$this->view->og_description = $eventdetail['og_description'];
			if($eventdetail['og_image'] == '/img/wh_default.png'){
				$this->view->og_image = $this->makeurl($this->baseUrl, $eventdetail['images'][0]['uri']).'?w=500';
			}else{
				$this->view->og_image = $this->makeurl($this->baseUrl, $eventdetail['og_image']).'?w=500';
			}
			$this->view->og_url = $this->baseUrl.$eventdetail['url'];
			$this->view->canonical_url = $this->baseUrl.$eventdetail['url'];
			$this->view->deep_link = $eventdetail['deep_link'];
			/* ======= Seo Update ============= */
			
			$cityshown = $this->cityshown($this->currentCity);
			$breadcrumbs = $this->breadcrumbs(array(
				$cityshown => $this->baseUrl.'/'.$this->currentCity,
				'Events' => $this->baseUrl.'/'.$this->currentCity.'/events',
				ucwords(strtolower(trim($eventdetail['title']))) =>''
			));
			$this->view->setVars(array('eventdetail' => $eventdetail, 'breadcrumbs'=>$breadcrumbs, 'cityshown'=>$cityshown));
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('event_end');
		$this->getlogs('event', $this->baseUrl.$eventdetail['url']);
    }
	
	
	function eventlistAction(){
		$start = 0;
		$limit = 11;
		
		$this->view->entityid = $this->currentCity;
		$this->view->entitytype = 'eventlist';
		
		$cityshown = $this->cityshown($this->currentCity);
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->currentCity, 'all', '', '', 'Event');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		//print_r($allfeedslist); exit;
		
		$breadcrumbs = $this->breadcrumbs(array(
			$cityshown => $this->baseUrl.'/'.$this->currentCity,
			'Events in '.$cityshown =>''
		));
		$this->tag->setTitle('Events in '.$cityshown);
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'eventscount' => count($allfeedslist),
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs,
				'cityshown'=>$cityshown
				)
			);
	} 
}
