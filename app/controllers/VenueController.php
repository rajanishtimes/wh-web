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

			$Author = new \WH\Model\Solr();
			$Author->setParam('fl','detail');
			$Author->setSolrType('detail');

			foreach($venuedetail['reviews'] as $key=>$reviews){
				$Author->setParam('ids','a_'.$reviews['critic_id']);
				$Author->setEntityDetails();
				try{
					$author = $Author->getDetailResults();
				}catch(Exception $e){
					$author = array();
				}
				$venuedetail['reviews'][$key]['author'] = $author;


				$rwidth = round((($reviews['food_rate'] + $reviews['service_rate'] + $reviews['decor_rate'])/3), 1);
				$reviewwidth = $rwidth*33;
				$venuedetail['reviews'][$key]['rwidth'] = $rwidth;
				$venuedetail['reviews'][$key]['reviewwidth'] = $reviewwidth;

				/* Rating Progress Bar */
					$ratings = array();
					$background_color = array('#e74c3c', '#f7c912', '#2ecc71');
					$border_color = array('#b51707', '#be9f0e', '#0f9a4a');
					$food_rate = ($reviews['food_rate']/5)*100;
					$service_rate = ($reviews['service_rate']/5)*100;
					$decor_rate = ($reviews['decor_rate']/5)*100;

					$ratings['food']['rating'] = $reviews['food_rate'];
					if($food_rate < 33){
						$ratings['food']['background_color'] = $background_color[0];
						$ratings['food']['border_color'] = $border_color[0];
						$ratings['food']['width'] = $food_rate;
					}else if($food_rate > 33 && $food_rate < 66){
						$ratings['food']['background_color'] = $background_color[1];
						$ratings['food']['border_color'] = $border_color[1];
						$ratings['food']['width'] = $food_rate;
					}else{
						$ratings['food']['background_color'] = $background_color[2];
						$ratings['food']['border_color'] = $border_color[2];
						$ratings['food']['width'] = $food_rate;
					}
					

					$ratings['service']['rating'] = $reviews['service_rate'];
					if($service_rate < 33){
						$ratings['service']['background_color'] = $background_color[0];
						$ratings['service']['border_color'] = $border_color[0];
						$ratings['service']['width'] = $service_rate;
					}else if($service_rate > 33 && $service_rate < 66){
						$ratings['service']['background_color'] = $background_color[1];
						$ratings['service']['border_color'] = $border_color[1];
						$ratings['service']['width'] = $service_rate;
					}else{
						$ratings['service']['background_color'] = $background_color[2];
						$ratings['service']['border_color'] = $border_color[2];
						$ratings['service']['width'] = $service_rate;
					}

					$ratings['decor']['rating'] = $reviews['decor_rate'];
					if($decor_rate < 33){
						$ratings['decor']['background_color'] = $background_color[0];
						$ratings['decor']['border_color'] = $border_color[0];
						$ratings['decor']['width'] = $decor_rate;
					}else if($decor_rate > 33 && $decor_rate < 66){
						$ratings['decor']['background_color'] = $background_color[1];
						$ratings['decor']['border_color'] = $border_color[1];
						$ratings['decor']['width'] = $decor_rate;
					}else{
						$ratings['decor']['background_color'] = $background_color[2];
						$ratings['decor']['border_color'] = $border_color[2];
						$ratings['decor']['width'] = $decor_rate;
					}

				/* Rating Progress Bar End*/
				$venuedetail['reviews'][$key]['ratings'] = $ratings;

			}
			try{
				$Venue = new \WH\Model\Venue();
				$idwov = substr($id, 2);
				$Venue->setId($idwov);
				$events = $Venue->getResults();
			}catch(Exception $e){
				$events = array();
			}


			try{
				$Venue = new \WH\Model\Venue();
				$idwov = substr($id, 2);
				$Venue->setId($idwov);
				$pastevents = $Venue->allPastEvents();
			}catch(Exception $e){
				$pastevents = array();
			}

			try{
				$Venue = new \WH\Model\Venue();
				$idwov = substr($id, 2);
				$Venue->setLatitude($venuedetail['latitude']);
				$Venue->setLongitude($venuedetail['longitude']);
				$Venue->setCity($this->cityshown($this->currentCity));
				$nearbyevents = $Venue->allNearByEvents();
				foreach ($nearbyevents['results'] as $key => $nearbyevent) {
					 echo "<pre>"; print_r($nearbyevent); echo "</pre>"; exit;
					$formatted_addresss = '';
					$address_arrs = array();
					if(isSet($nearbyevent['address']) && trim($nearbyevent['address'])!=''){
						$address_arrs[] = $nearbyevent['address'];
					}
					if(isSet($nearbyevent['landmark']) && trim($nearbyevent['landmark'])!=''){
						$address_arrs[] = $nearbyevent['landmark'];
					}
					if(isSet($nearbyevent['locality']) && trim($nearbyevent['locality'])!=''){
						$address_arrs[] = $nearbyevent['locality'];
					}
					if(isSet($nearbyevent['zonename']) && trim($nearbyevent['zonename'])!=''){
						$address_arrs[] = $nearbyevent['zonename'];
					}
					if(isSet($nearbyevent['cities']) && trim($nearbyevent['cities'])!=''){
						$address_arrs[] = $nearbyevent['cities'];
					}	
					$formatted_addresss = implode(', ', $address_arrs);
					$nearbyevents['results'][$key]['formatted_address'] = str_replace(', ,', ',', $formatted_addresss);
				}
			}catch(Exception $e){
				$nearbyevents = array();
			}

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
			//echo "<pre>"; print_r($venuedetail); echo "</pre>"; exit;
			//echo "<pre>"; print_r($events); echo "</pre>";

			foreach($events['results'] as $key=>$event){
				$currentdatetime = strtotime(date("Y-m-d h:i:s a"));
				//echo ' '.date('Y-m-d h:i:s a', $currentdatetime)." ";
				$eventtime = $event['end_time'];
				$eventtime = strtotime(date('Y-m-d h:i:s a', $eventtime));
				//echo ' '.date('Y-m-d h:i:s a', $eventtime)."<br>";
				if($currentdatetime > $eventtime){
				        unset($events['results'][$key]);
				}

				//$currentdatetime = strtotime(date("Y-m-d h:i:s"));
				//echo ' '.date('Y-m-d h:i:s', $currentdatetime)."<br>";
				//$eventtime = $event['end_time'];
				//$eventtime = strtotime(date('Y-m-d h:i:s', $eventtime));
				//echo ' '.date('Y-m-d h:i:s', $eventtime)."<br>";
				//if($currentdatetime > $eventtime){
				//	unset($events['results'][$key]);
				//}
			}
			$events['results'] = array_values($events['results']);
			
			$this->view->setVars(array(
				'venuedetail' => $venuedetail,
				'breadcrumbs' => $breadcrumbs,
				'cityshown' => $cityshown,
				'events'	=> $events,
				'pastevents'	=> $pastevents,
				'nearbyevents' => $nearbyevents
			));
		}else{
			$this->forwardtoerrorpage(404);
		}
		$this->setlogsarray('venue_end');
		$this->getlogs('venue', $this->baseUrl.$venuedetail['url']);
    }
}
