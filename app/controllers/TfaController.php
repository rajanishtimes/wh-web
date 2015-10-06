<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	public $tfacity = '';
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
        if($this->dispatcher->getParam('tfacity'))
			$this->tfacity = $this->dispatcher->getParam('tfacity');
		$this->view->tfacity = $this->tfacity;
    }

	public function indexAction(){
		$title = $this->cityshown($this->currentCity).' Times Food & Nightlife Awards 2016, Best Restaurants | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		$this->view->meta_description = 'Times Food Awards & Times Nightlife Awards 2016 '.$this->cityshown($this->currentCity).': Find best restaurants, bars & clubs in '.$this->currentCity.'. Best dining and party places in '.$this->currentCity;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->cityshown($this->currentCity).', Times Nightlife Awards '.$this->currentCity;

		$TFA = new \WH\Model\Tfa();
        $TFA->setCityID($this->cityId);
        $allpastwinners = $TFA->getpastwinners();
        $this->view->allpastwinners = $allpastwinners;

        //echo "<pre>"; print_r($allpastwinners); echo "</pre>"; exit;
    }

    public function nominationAction(){
		$title = $this->cityshown($this->currentCity).' Times Food & Nightlife Awards 2016, Best Restaurants | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		$this->view->meta_description = 'Times Food Awards & Times Nightlife Awards 2016 '.$this->cityshown($this->currentCity).': Find best restaurants, bars & clubs in '.$this->currentCity.'. Best dining and party places in '.$this->currentCity;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->cityshown($this->currentCity).', Times Nightlife Awards '.$this->currentCity;
		$TFA = new \WH\Model\Tfa();
        $TFA->setCityID($this->cityId);
        $tfacategorys = $TFA->getAllCategories();
        $this->view->tfacategorys = $tfacategorys;
        //echo "<pre>"; print_r($tfacategory); echo "</pre>"; exit;
    }
}