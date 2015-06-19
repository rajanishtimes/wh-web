<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class LocationController extends BaseController{
	public function initialize(){
		$this->setlogsarray('location_start');
		$this->view->setLayout('ajaxLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        parent::initialize();
    }
	
	public function indexAction(){
		$this->response->setHeader('Cache-Control', 'max-age=900');
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->create_title($this->request->getPost('searchkeyword'));
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$city = $this->request->getPost('city');
		$fromtype = $this->request->getPost('type');
		$spstart = $this->request->getPost('spstart');
		$splimit = $this->request->getPost('splimit');
		$this->view->entitytype = 'location';
		
		try{
			if($bydate == 'Event'){
				$allfeedslist = $this->getfeeddata($start, $limit, $city, 'all', $tags, '', $bydate, $searchkeyword, $fromtype, $spstart, $splimit);
			}else{
				$allfeedslist = $this->getfeeddata($start, $limit, $city, $bydate, $tags, '', '', $searchkeyword, $fromtype, $spstart, $splimit);
			}
			$this->setlogsarray('location_get_records');
		}catch(Exception $e){
			$allfeedslist = array();
		}

		/* ======= Seo Update ============= */
		$this->tag->setTitle('Events in ' .$searchkeyword.', '.$city.' | '.$this->config->application->SiteName);
		$this->view->meta_description = 'Check out the top upcoming events and current events happening in '.$searchkeyword.', '.$city.' along with date, time, map and contact details.';
		$this->view->meta_keywords = 'events in '.$searchkeyword.', events in '.$searchkeyword.' '.$city.', upcoming events in '.$searchkeyword;
		$this->view->deep_link = 'timescity://ty=s&qu'.$searchkeyword;
		/* ======= Seo Update ============= */
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'mainurl'=>$mainurl,
				'searchkeyword'=>$searchkeyword,
				'start'=>$start+$limit-$sponsors_count,
				'limit'=>$limit,
				'tags'=>$tags,
				'bydate'=>$bydate,
				'parentid'=>$parentid,
				'city' => $city,
				'cityshown' => $this->cityshown($city),
				'fromtype' => $fromtype,
				'spstart' => $spstart+$limit,
				'splimit' => $limit
				)
			);
		$this->setlogsarray('location_end');
		$this->getlogs('location', $this->baseUrl.'/'.$city.'/location/'.$searchkeyword);
    }
	
    public function autosuggestionAction(){
		if ($this->request->isAjax() == true) {
			$Suggestion = new \WH\Model\Solr();
			$searchkeyword = $this->request->get("search");
			$Suggestion->setParam('searchname',$searchkeyword);
			$Suggestion->setParam('bycity',$this->currentCity);
			$Suggestion->setAutoSuggest();
			try{
				$autosuggestresult = $Suggestion->getSuggestResults();
				foreach($autosuggestresult['suggestions'] as $key=>$autos){
					$autosuggestresult['suggestions'][$key] = str_replace("/"," ",stripslashes($autos));
				}
			}catch(Exception $e){
				$autosuggestresult = array();
			}
			echo json_encode($autosuggestresult['suggestions']);
		}
		exit;
    }
	
	
	public function locationAction(){
		$this->view->setLayout('mainLayout');
		$searchkeyword = '';
		if($this->dispatcher->getParam('locationname')){
			$searchkeyword = str_replace("-"," ",$this->dispatcher->getParam('locationname'));
			$searchkeyword = $this->create_title($searchkeyword);
		}
		

		$this->view->entityid = 0;
		$this->view->entitytype = 'location';
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->currentCity, '', '', '', 'Event,Content,Venue,Review', $searchkeyword, 'location');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		//echo "<pre>"; print_r($allfeedslist); echo "</pre>"; exit;

		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($searchkeyword))) =>''));
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'locationresultcount' => count($allfeedslist['results']),
				'searchkeyword'=>$searchkeyword,
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs,
				'cityshown' =>$this->cityshown($this->currentCity)
				)
			);
			
		/* ======= Seo Update ============= */
		if($searchkeyword){
			$this->tag->setTitle('Events in ' .$searchkeyword.', '.$this->cityshown($this->currentCity).' | '.$this->config->application->SiteName);
		}else{
			$this->tag->setTitle('Location | '.$this->config->application->SiteName);
		}
		$this->view->meta_description = 'Check out the top upcoming events and current events happening in '.$searchkeyword.', '.$this->cityshown($this->currentCity).' along with date, time, map and contact details.';
		$this->view->meta_keywords = 'events in '.$searchkeyword.', events in '.$searchkeyword.' '.$this->cityshown($this->currentCity).', upcoming events in '.$searchkeyword;
		$this->view->deep_link = 'timescity://ty=s&qu'.$searchkeyword;
		/* ======= Seo Update ============= */
		
    }
	
	public function locationlistAction(){
		$mainurl = $this->request->getPost('mainurl');
		$searchkeyword = $this->create_title($this->request->getPost('searchkeyword'));
		$tags = $this->request->getPost('tags');
		$bydate = ucwords(strtolower($this->request->getPost('bydate')));
		$start = $this->request->getPost('start');
		$limit = $this->request->getPost('limit');
		$parentid = $this->request->getPost('parentid');
		$cities = $this->request->getPost('city');
		$fromtype = $this->request->getPost('type');

		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $cities, $bydate, $tags, '', 'Event,Content,Venue,Review', $searchkeyword, $fromtype);
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'searchresultcount' => count($allfeedslist),
				'mainurl'=>$mainurl,
				'searchkeyword'=>$searchkeyword,
				'start'=>$start+$limit,
				'limit'=>$limit,
				'tags'=>$tags,
				'bydate'=>$bydate,
				'parentid'=>$parentid,
				'cities'=>$cities,
				'cityshown' =>$this->cityshown($cities)
				)
			);
    }
	
	public function forwardlocationAction(){
		$searchkeyword = htmlentities($this->request->getPost('location'));
		$searchkeyword = strtolower(str_replace(" ","-",stripslashes($searchkeyword)));
		$searchkeyword = str_replace("/"," ",stripslashes($searchkeyword));
		$searchkeyword = str_replace("*","",$searchkeyword);
		$searchkeyword = urlencode($searchkeyword);
		$url = $this->baseUrl.'/'.$this->currentCity.'/location/'.$searchkeyword;
		return $this->response->redirect($url);
	}
}