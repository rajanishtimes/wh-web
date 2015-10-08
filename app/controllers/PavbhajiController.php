<?php

use WH\Core\BaseController as BaseController;

class PavbhajiController extends BaseController{
	
	public function initialize(){
		$this->view->setLayout('badapavLayout');
        $this->view->iscontestrunning = $this->config->pavbhaji->isrunning;
        parent::initialize();
    }

	public function indexAction(){
		$title = 'Pavwow Contest for best Pav Bhaji in '.$this->cityshown($this->currentCity).' | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Finding best pav bhaji in Mumbai - Bombay Times Pavwow Contest. Vote up the best pav bhaji restaurant in Mumbai on What\'s Hot.';
		$this->view->meta_keywords = 'pav bhaji, pavwow Contest, Best pav bhaji in Mumbai, Best pavwow';

		$this->tag->setTitle($title);
		$city = $this->currentCity;
        if($city != 'mumbai'){
        	$this->forwardtoerrorpage(404);
        }

		$isvotedbiryani = 0;
		if ($this->cookies->has("isvotedbiryani")){
			$isvotedbiryani = (string)$this->cookies->get("isvotedbiryani");
		}
		
		$cityshown = $this->cityshown($city);

		$start = 0;
		$limit = 50;

		$biryaninominations = new \WH\Model\BNH();
		$biryaninominations->setCityID($this->cityId);
		$biryaninominations->setStart($start);
		$biryaninominations->setLimit($limit);
		$biryaninominations->setContest('pavbhaji');
		$biryaninominations->setContestName('pavbhaji');
        $biryaninomination = $biryaninominations->nominations();

        //echo "<pre>"; print_r($biryaninomination); echo "</pre>"; exit;
         
        if($this->config->pavbhaji->isrunning == 0){
        	$this->view->setLayout('badapavLayout');
        	$this->view->pick(['pavbhaji/complete']);
        }

        $this->view->setVars(array(
			'biryaninominations' => $biryaninomination,
			'cityshown' => $cityshown,
			'start'	=> $start,
			'limit'	=> $limit,
			'isvotedbiryani' => $isvotedbiryani
		));
    }

    public function winnersAction(){
    	$title = 'King of Bhel Contest for Best Bhel Puri in '.$this->cityshown($this->currentCity).' | '.$this->config->application->SiteName;
		$this->view->meta_description = 'Finding best bhel puri in Mumbai - Bombay Times King of Bhel Contest. Vote up the best bhel puri restaurant in Mumbai on What\'s Hot.';
		$this->view->meta_keywords = 'King of Bhel, King of Bhel Contest, Best Bhel Puri in Mumbai, Best Bhel Puri';

		$this->tag->setTitle($title);
		
    	$city = $this->currentCity;
		$cityshown = $this->cityshown($city);

		$bwinnerid = $this->config->pavbhajiwinner->bwinner;

		$biryaniwinner = new \WH\Model\BNH();
		$biryaniwinners = $biryaniwinner->nominationDetail($bwinnerid);
		foreach($biryaniwinners as $key=>$biryaniwinner){
			$votes = new \WH\Model\BNH();
			$votes->setNominationID($biryaniwinner['id']);
			$votecount = $votes->votingCount();
			$biryaniwinners[$key]['votes'] = $votecount;
		}

		$start = 0;
    	$this->view->setVars(array(
			'cityshown' => $cityshown,
			'start'	=> $start,
			'biryaniwinners' => $biryaniwinners
		));
		$this->view->setLayout('badapavLayout');
        $this->view->pick(['pavbhaji/winners']);
    }

    public function votingAction(){
    	$nominationid = $this->request->getPost('nominationid');
    	$category = $this->request->getPost('category');

    	if ($this->cookies->has("uniquekey")){
			$uniquekey = (string)$this->cookies->get("uniquekey");
		}

    	$voting = new \WH\Model\BNH();
    	//$voting->setContestName('biryani and haleem');
    	$voting->setContestName('pavbhaji');
    	$voting->setNominationID($nominationid);
    	$voting->setBrowserID($uniquekey);
    	$voting->setCategoryName($category);
    	$voting->setIP($_SERVER['REMOTE_ADDR']);
		$result = $voting->voting();
		exit;
    }
}