<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
    }

	public function indexAction(){
		$title = 'Times Food and Nightlife awards 2016 | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Times Food and Nightlife awards 2016';
		$this->view->meta_keywords = 'Times Food awards, Nightlife awards';
    }
}