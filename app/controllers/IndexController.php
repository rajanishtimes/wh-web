<?php

use WH\Core\BaseController as BaseController;

class IndexController extends BaseController{
	
	public function initialize(){
		
        $this->tag->setTitle('Welcome');
        $this->view->setLayout('mainLayout');
		parent::initialize();
    }

    public function indexAction(){
		$city = $this->dispatcher->getParam('city');
		if(empty($city))
			$this->view->city = 'delhi';
		
		$this->view->city = $city;
		$getfeedsUrl = $this->api_end_point.'solr/searchEntity';
		$this->view->getfeedsUrl = $getfeedsUrl;
		
		$params = array('city' => $city);
        $response = $this->sendCurl($getfeedsUrl, $params);
		$getallfeeds = $response->response;
		$this->view->allfeeds = $getallfeeds;
    }
	
	public function getfeedsAction(){
		
	}
}
