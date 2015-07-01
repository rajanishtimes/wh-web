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
		header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
		$title = 'Biryani and Haleem Contest 2015 | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Times Biryani and Haleem contest has been on since last 7 years and it started as an initiative to honor best Biryani and Haleem which are unique only to the Hyderabadi culture.';
		$this->view->meta_keywords = 'Biryani, Haleem, Biryani and Haleem, Hyderabadi culture';

		$this->tag->setTitle($title);
		$city = $this->currentCity;
        if($city != 'hyderabad'){
        	$this->forwardtoerrorpage(404);
        }

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
			'isvotedbiryani' => $isvotedbiryani,
			'isvotedhaleem' => $isvotedhaleem
		));
    }

    public function winnersAction(){
    	$city = $this->currentCity;
		$cityshown = $this->cityshown($city);
		$start = 0;
    	$this->view->setVars(array(
			'cityshown' => $cityshown,
			'start'	=> $start
		));
		$this->view->setLayout('quizLayout');
        $this->view->pick(['quiz/winners']);
    }

    public function votingAction(){
    	$nominationid = $this->request->getPost('nominationid');
    	$category = $this->request->getPost('category');

    	if ($this->cookies->has("uniquekey")){
			$uniquekey = (string)$this->cookies->get("uniquekey");
		}

    	$voting = new \WH\Model\BNH();
    	$voting->setContestName('biryani and haleem');
    	$voting->setNominationID($nominationid);
    	$voting->setBrowserID($uniquekey);
    	$voting->setCategoryName($category);
    	$voting->setIP($_SERVER['REMOTE_ADDR']);
		$result = $voting->voting();
		exit;
    }
}