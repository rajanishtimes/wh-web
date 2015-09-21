<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
    }

	public function indexAction(){
		$title = 'Biryani and Haleem Contest 2015 | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Times Biryani and Haleem contest has been on since last 7 years and it started as an initiative to honor best Biryani and Haleem which are unique only to the Hyderabadi culture.';
		$this->view->meta_keywords = 'Biryani, Haleem, Biryani and Haleem, Hyderabadi culture';

		$this->tag->setTitle($title);
		$city = $this->currentCity;
        
		$isvotedbiryani = 0;
		$isvotedhaleem = 0;
		if ($this->cookies->has("isvotedbiryani")){
			$isvotedbiryani = (string)$this->cookies->get("isvotedbiryani");
		}

		if ($this->cookies->has("isvotedhaleem")){
			$isvotedhaleem = (string)$this->cookies->get("isvotedhaleem");
		}

		$cityshown = $this->cityshown($city);

		$start = 0;
		$limit = 50;

		$biryaninominations = new \WH\Model\BNH();
		$biryaninominations->setCityID($this->cityId);
		$biryaninominations->setStart($start);
		$biryaninominations->setLimit($limit);
		$biryaninominations->setContest('biryani');
		$biryaninominations->setContestName('biryani and haleem');
        $biryaninomination = $biryaninominations->nominations();
         

        $haleemnominations = new \WH\Model\BNH();
		$haleemnominations->setCityID($this->cityId);
		$haleemnominations->setStart($start);
		$haleemnominations->setLimit($limit);
		$haleemnominations->setContest('haleem');
		$haleemnominations->setContestName('biryani and haleem');
        $haleemnomination = $haleemnominations->nominations();

        
        $this->view->setVars(array(
			'biryaninominations' => $biryaninomination,
			'haleemnominations' => $haleemnomination,
			'cityshown' => $cityshown,
			'start'	=> $start,
			'limit'	=> $limit,
			'isvotedbiryani' => $isvotedbiryani,
			'isvotedhaleem' => $isvotedhaleem
		));
    }
}