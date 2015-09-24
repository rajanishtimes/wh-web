<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
    }

	public function indexAction(){
		$title = 'Times Food and Nightlife awards 2016 | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		$this->view->meta_description = 'Times Food and Nightlife awards 2016 '. $this->city;
		$this->view->meta_keywords = 'Times Food awards, Nightlife awards '. $this->city;
    }
}