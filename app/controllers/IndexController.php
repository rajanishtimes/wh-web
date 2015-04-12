<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class IndexController extends BaseController{
	
	public function initialize(){
        $this->tag->setTitle('Welcome');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		parent::initialize();
    }

    public function indexAction(){
		$getfeedsUrl = $this->api_end_point.'solr/searchEntity';
		$topfeeds = $this->getfeeddata(0, 3, $this->city, 'Today');
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
        $populartags = $core->getResults();
		
		$start = 0;
		$limit = 12;
		$allfeedslist = $this->getfeeddata($start, $limit, $this->city, 'all');
		
		$this->view->setVars(
			array(
				'getfeedsUrl' => $getfeedsUrl,
				'allfeedslist' => $allfeedslist,
				'start'=>$limit,
				'limit'=>$limit,
				'populartags'=>$populartags,
				'topfeeds'=>$topfeeds
				)
			);
    }
	
	public function getfeedsAction(){
		$start = 0;
		$city = $this->city;
		$limit = 12;
		$bydays = 'all';
		$allfeeds = $this->getfeeddata($start, $limit, $city, $bydays);
		echo "<pre>"; print_r($allfeeds);
		$this->view->allfeeds = $allfeeds;
		exit;
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

}
