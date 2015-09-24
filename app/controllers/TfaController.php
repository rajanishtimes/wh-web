<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
    }

	public function indexAction(){
		$title = $this->city.' Times Food & Nightlife Awards 2016, Best Restaurants | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		$this->view->meta_description = 'Times Food Awards & Times Nightlife Awards 2016 '.$this->city.': Find best restaurants, bars & clubs in '.$this->city.'. Best dining and party places in '.$this->city;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->city.', Times Nightlife Awards '.$this->city;
    }
}