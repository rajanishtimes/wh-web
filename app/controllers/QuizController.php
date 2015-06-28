<?php

use WH\Core\BaseController as BaseController;

class QuizController extends BaseController{
	
	public function initialize(){
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
        $this->view->setLayout('quizLayout');
        $this->view->iscontestrunning = $this->config->biryaniandhaleem->isrunning;
        parent::initialize();
    }

	public function indexAction(){

		$city = $this->currentCity;
        if($city != 'hyderabad'){
        	$this->forwardtoerrorpage(404);
        }

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

        if($this->config->biryaniandhaleem->isrunning == 0){
        	$this->view->setLayout('quizLayout');
        	$this->view->pick(['quiz/complete']);
        }

        $this->view->setVars(array(
			'biryaninominations' => $biryaninomination,
			'haleemnominations' => $haleemnomination,
			'cityshown' => $cityshown,
			'start'	=> $start,
			'limit'	=> $limit,
			'isvoted' => $isvoted
		));
    }


    public function votingAction(){
    	$nominationid = $this->request->getPost('nominationid');
    	$category = $this->request->getPost('category');

    	$voting = new \WH\Model\BNH();
    	$voting->setContestName('biryani and haleem');
    	$voting->setNominationID($nominationid);
    	$voting->setBrowserID($_SERVER['HTTP_USER_AGENT']);
    	$voting->setCategoryName($category);
    	$voting->setIP($_SERVER['REMOTE_ADDR']);
		$result = $voting->voting();
		exit;
    }
}