<?php

use WH\Core\BaseController as BaseController;

class QuizController extends BaseController{
	
	public function initialize(){
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        $this->view->setLayout('quizLayout');
		parent::initialize();
    }

	public function indexAction(){
		$isvoted = 0;
		if ($this->cookies->has("isvoted")){
			$isvoted = (int)$this->cookies->get("isvoted");
		}

		$city = $this->currentCity;
		$cityshown = $this->cityshown($city);

		$start = 0;
		$limit = 50;

		$biryaninominations = new \WH\Model\BNH();
		$biryaninominations->setCityID($this->cityId);
		$biryaninominations->setStart($start);
		$biryaninominations->setLimit($limit);
		$biryaninominations->setContestName('biryani');
        $biryaninomination = $biryaninominations->nominations();

        $haleemnominations = new \WH\Model\BNH();
		$haleemnominations->setCityID($this->cityId);
		$haleemnominations->setStart($start);
		$haleemnominations->setLimit($limit);
		$haleemnominations->setContestName('haleem');
        $haleemnomination = $haleemnominations->nominations();

        $this->view->setVars(array(
			'biryaninominations' => $biryaninomination,
			'haleemnominations' => $haleemnomination,
			'cityshown' => $cityshown,
			'start'	=> $start,
			'limit'	=> $limit,
			'isvoted' => $isvoted
		));
        
    }
}