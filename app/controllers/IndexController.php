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
		
		
		/* ======= Seo Update ============= */
		$title = ucwords($this->city).' Events: Things to do in '.ucwords($this->city).' Today | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		
		$this->view->meta_description = 'Events in '.ucwords($this->city).': Getting bored? Wondering what to do in '.ucwords($this->city).' today? Check out the list of things to do in '.ucwords($this->city).' today and have unlimited fun. ';
		$this->view->meta_keywords = 'things to do in '.ucwords($this->city).', what to do in '.ucwords($this->city).', '.ucwords($this->city).' events';
		/* ======= Seo Update ============= */
		
		
		
		try{
			$topfeeds = $this->getfeeddata(0, 3, $this->city, 'Today', '', '', 'Event,Content', '', 2);
		}catch(Exception $e){
			$topfeeds = array();
		}
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
		try{
			$populartags = $core->getResults();
		}catch(Exception $e){
			$populartags = array();
		}
        
		
		$start = 0;
		$limit = 11;
		
		try{
			$allfeedslist = $this->getfeeddata($start, $limit, $this->city, 'all', '', '', 'Event,Content');
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
    }
    public function termsAction(){
        $this->tag->setTitle('Terms & Conditions');
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Terms & Conditions';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'terms';
    }
	
	public function aboutusAction(){
        $this->tag->setTitle('About Us');
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'About Us';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'about-us';
    }
}
