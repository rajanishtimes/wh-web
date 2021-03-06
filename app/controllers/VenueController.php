<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class VenueController extends BaseController{
	public $venue;
	public function initialize(){
		$this->setlogsarray('venue_start');
        $this->tag->setTitle('Venue');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('venue'))
			$this->venue = $this->dispatcher->getParam('venue');
		
		$this->view->setVars(array(
			'venue' => $this->venue
		));
		
		parent::initialize();
    }

    public function indexAction(){
		$this->response->setHeader('Cache-Control', 'max-age=86400');
		preg_match('/\bv-[0-9]{1,}\b/i', $this->venue, $match);
		$id = str_replace('-', '_', $match[0]);
		
		$Solr = new \WH\Model\Solr();
		$Solr->setParam('ids',$id);
		$Solr->setParam('fl','detail');
		$Solr->setSolrType('detail');
        $Solr->setEntityDetails();
		
		$this->view->entityid = $id;
		$this->view->entitytype = 'venue';
		
        try{
			$venuedetail = $Solr->getDetailResults();
			$this->setlogsarray('venue_get_detail');
		}catch(Exception $e){
			$venuedetail = array();
		}

		if($venuedetail){
			$this->validateRequest($venuedetail['url']);
			$formatted_address = '';
			if(isSet($venuedetail['address']) && trim($venuedetail['address'])!=''){
				$address_arr[] = $venuedetail['address'];
			}
			if(isSet($venuedetail['landmark']) && trim($venuedetail['landmark'])!=''){
				$address_arr[] = $venuedetail['landmark'];
			}
			if(isSet($venuedetail['locality']) && trim($venuedetail['locality'])!=''){
				$address_arr[] = $venuedetail['locality'];
			}
			if(isSet($venuedetail['zonename']) && trim($venuedetail['zonename'])!=''){
				$address_arr[] = $venuedetail['zonename'];
			}
			if(isSet($venuedetail['city']) && trim($venuedetail['city'])!=''){
				$address_arr[] = $venuedetail['city'];
			}
			
			$formatted_address = implode(', ', $address_arr);
			$venuedetail['formatted_address'] = $formatted_address;
			
			
			if($venuedetail['website']){
				$pos = strpos($venuedetail['website'], 'http');
				if($pos === false){
					$venuedetail['website'] = 'http://'.$venuedetail['website'];
				}
			}

			$cityshown = $this->cityshown($this->currentCity);
			$breadcrumbs = $this->breadcrumbs(array(
				$cityshown => $this->baseUrl.'/'.$this->currentCity,
				ucwords(strtolower(trim($venuedetail['title']))) =>''
			));
			
			/* ======= Seo Update ============= */
			if($venuedetail['page_title'])
				$this->tag->setTitle($venuedetail['page_title']);
			$this->view->meta_description = $venuedetail['meta_description'];
			$this->view->meta_keywords = $venuedetail['meta_keywords'];
			$this->view->og_title = $venuedetail['og_title'];
			$this->view->og_type = 'website';
			$this->view->og_description = $venuedetail['og_description'];
			$this->view->og_image = $this->baseUrl.$venuedetail['og_image'];
			$this->view->og_url = $this->baseUrl.$venuedetail['url'];
			$this->view->canonical_url = $this->baseUrl.$venuedetail['url'];
			$this->view->deep_link = $venuedetail['deep_link'];
			/* ======= Seo Update ============= */
			$this->view->setVars(array(
				'venuedetail' => $venuedetail,
				'breadcrumbs' => $breadcrumbs,
				'cityshown' => $cityshown
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('venue_end');
		$this->getlogs('venue', $this->baseUrl.$venuedetail['url']);
    }
}
