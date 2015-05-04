<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class IndexController extends BaseController{
	
	public function initialize(){
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		parent::initialize();
    }

	public function homepageAction(){
		/* $this->setcities();
		$this->setcityid();*/
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['timings']['homepage_start'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		
		$city = $this->currentCity;
		$cityshown = $city;
		if($cityshown == 'delhi-ncr' || $cityshown == 'delhi')
			$cityshown = 'Delhi NCR';
		$this->view->cityshown = $cityshown;
		
		$this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
		
		
		/* ======= Seo Update ============= */
		$title = ucwords($city).' Events: Things to do in '.ucwords($city).' Today | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		
		
		$this->view->meta_description = 'Events in '.ucwords($city).': Getting bored? Wondering what to do in '.ucwords($city).' today? Check out the list of things to do in '.ucwords($city).' today and have unlimited fun. ';
		$this->view->meta_keywords = 'things to do in '.ucwords($city).', what to do in '.ucwords($city).', '.ucwords($city).' events';
		$this->view->canonical_url = $this->baseUrl.'/'.$city;
		$this->view->deep_link = 'timescity://wh/ty';
		/* ======= Seo Update ============= */
		
		
		
		try{
			$topfeeds = $this->getfeeddata(0, 3, $city, 'Today', '', '', 'Event,Content', '', 2);
		}catch(Exception $e){
			$topfeeds = array();
		}
		
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['timings']['top_feeds'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
		try{
			$populartags = $core->getResults();
		}catch(Exception $e){
			$populartags = array();
		}
		
        $GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['timings']['popular_tags'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $city, 'all', '', '', 'Event,Content');
		}catch(Exception $e){
			$allfeedslist = array();
		}
		
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'start'=>$limit,
				'limit'=>$limit,
				'populartags'=>$populartags,
				'topfeeds'=>$topfeeds
				)
			);
		
		$GLOBALS["time_end"] = microtime(true);
		$GLOBALS["logs"]['timings']['all_feeds'] = $GLOBALS["time_end"] - $GLOBALS["time_start"];
		$GLOBALS["time_start"] = microtime(true);
		
		$this->getlogs('Homepage', $this->baseUrl.'/homepage');
		
    }
	
	public function newsletterAction(){
		$ermessage = array();
		$form = new NewsletterForm();
		if ($form->isValid($this->request->getPost())) {
			// Test only
			
			$this->session->set("email", $this->request->getPost('email'));
			return $this->forward('index/index');
		} else {
			//print_r($form);
			//print_r($form->getMessages());
			foreach ($form->getMessages() as $message) {
				$ermessage[] = $message;
			}
			exit;
		}
	}
	
	public function indexAction(){
		$this->view->setLayout('homepageLayout');
    }
	
	public function policyAction(){
        $this->tag->setTitle('Privacy Policy');
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Privacy Policy';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'policy';
		$this->view->canonical_url = $this->baseUrl.'/'.'policy';
    }
    public function termsAction(){
        $this->tag->setTitle('Terms & Conditions');
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Terms & Conditions';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'terms';
		$this->view->canonical_url = $this->baseUrl.'/'.'terms';
    }
	
	public function aboutusAction(){
        $this->tag->setTitle('About Us');
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'About Us';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'about-us';
		$this->view->canonical_url = $this->baseUrl.'/'.'about-us';
    }
	
	public function unsubscribeAction(){
		echo "unsubscribed";
		exit;
	}
}
