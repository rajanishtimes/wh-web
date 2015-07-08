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
    	$title = 'Biryani and Haleem Contest 2015 | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Times Biryani and Haleem contest has been on since last 7 years and it started as an initiative to honor best Biryani and Haleem which are unique only to the Hyderabadi culture.';
		$this->view->meta_keywords = 'Biryani, Haleem, Biryani and Haleem, Hyderabadi culture';

		$this->tag->setTitle($title);
		
    	$city = $this->currentCity;
		$cityshown = $this->cityshown($city);

		$bwinnerid = $this->config->biryaniwinner->bwinner;
		$hwinnerid = $this->config->haleemwinner->hwinner;

		$biryaniwinner = new \WH\Model\BNH();
		$biryaniwinners = $biryaniwinner->nominationDetail($bwinnerid);

		foreach($biryaniwinners as $key=>$biryaniwinner){
			$votes = new \WH\Model\BNH();
			$votes->setNominationID($biryaniwinner['id']);
			$votecount = $votes->votingCount();
			$biryaniwinners[$key]['votes'] = $votecount;
		}

		$haleemwinner = new \WH\Model\BNH();
		$haleemwinners = $haleemwinner->nominationDetail($hwinnerid);
		foreach($haleemwinners as $key=>$haleemwinner){
			$votes = new \WH\Model\BNH();
			$votes->setNominationID($haleemwinner['id']);
			$votecount = $votes->votingCount();
			$haleemwinners[$key]['votes'] = $votecount;
		}

		$start = 0;
    	$this->view->setVars(array(
			'cityshown' => $cityshown,
			'start'	=> $start,
			'biryaniwinners' => $biryaniwinners,
			'haleemwinners' => $haleemwinners,
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