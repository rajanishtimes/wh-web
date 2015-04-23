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
		$title = ucwords($this->city).' Events: Things to do in '.ucwords($this->city).' Today | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		
		try{
			$topfeeds = $this->getfeeddata(0, 3, $this->city, 'Today', '', '', 'Event,Content', 2);
		}catch(Exception $e){
			$topfeeds = array();
		}
		
		
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
        $populartags = $core->getResults();
		
		$start = 0;
		$limit = 12;
		
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
        $allData=$this->getConstants();
        $policy='';
        if(isset($allData['constants']['privacy'])){
            $policy=$allData['constants']['privacy'];
        }
        $this->view->setVars(
            array(
                'data' => $policy
                )
            );
    }
    public function termsAction(){
        $allData=$this->getConstants();
        $terms='';
        if(isset($allData['constants']['terms'])){
            $terms=$allData['constants']['terms'];
        }
        $this->view->setVars(
            array(
                'data' => $terms
                )
            );
    }
	
	public function aboutusAction(){
        $allData=$this->getConstants();
        $terms='';
        if(isset($allData['constants']['About us'])){
            $terms=$allData['constants']['About us'];
        }
        $this->view->setVars(
            array(
                'data' => $terms
                )
            );
    }
}
