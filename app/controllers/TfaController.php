<?php

use WH\Core\BaseController as BaseController;

class TfaController extends BaseController{
	public $tfacity = '';
    public $tfasubcat = '';
	public function initialize(){
		$this->view->setLayout('tfaLayout');
        parent::initialize();
        if($this->dispatcher->getParam('city'))
			$this->tfacity = $this->dispatcher->getParam('city');

        if($this->tfacity == 'delhi-ncr'){
            $this->tfacity = 'delhi';
        }
		$this->view->tfacity = strtolower($this->tfacity);

        if($this->dispatcher->getParam('tfasubcat'))
            $this->tfasubcat = $this->dispatcher->getParam('tfasubcat');

        $this->view->tfasubcat = strtolower($this->tfasubcat);
    }

	public function indexAction(){
        $this->response->setHeader('Cache-Control', 'max-age=86400');
		$title = $this->cityshown($this->currentCity).' Times Food & Nightlife Awards 2016, Best Restaurants | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);

        $summary =  'Times Food Awards & Times Nightlife Awards 2016 '.$this->cityshown($this->currentCity).': Find best restaurants, bars & clubs in '.$this->currentCity.'. Best dining and party places in '.$this->currentCity;
		$this->view->meta_description = $summary;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->cityshown($this->currentCity).', Times Nightlife Awards '.$this->currentCity;

		$TFA = new \WH\Model\Tfa();
        $TFA->setCityID($this->cityId);
        $allpastwinners = $TFA->getpastwinners();
        $this->view->allpastwinners = $allpastwinners;

        $this->view->og_title = $title;
        $this->view->og_type = 'website';
        $this->view->og_description = $summary;
        $this->view->og_image = $this->baseUrl.'/img/tfa/food-image.jpg';
            

        $this->nomination();


        //echo "<pre>"; print_r($allpastwinners); echo "</pre>"; exit;
    }

    private function nomination(){
        $TFA = new \WH\Model\Tfa();
        $TFA->setCityID($this->cityId);
        $tfacategorys = $TFA->getAllCategories();
        $this->view->tfacategorys = $tfacategorys;
        //echo "<pre>"; print_r($tfacategorys); echo "</pre>"; exit;

        $child_category = array();
        $eventId = 0;
        $i = 1;

        foreach ($tfacategorys['location'] as $key => $tfacategory) {
            if(strtolower($tfacategory['name']) == $this->tfacity){
                $votestart = $tfacategorys['location'][$key]['events'][0]['voting_start'];
                $voteend = $tfacategorys['location'][$key]['events'][0]['voting_end'];
                $result_date = $tfacategorys['location'][$key]['events'][0]['result_date'];
                $venue_place = $tfacategorys['location'][$key]['events'][0]['venue_name'];
                $this->view->start_date = $votestart;
                $this->view->vote_end_date = $voteend;
                $this->view->result_date = $result_date;
                $this->view->venue_place = $venue_place;
            }
        }

        $votestart = '2015-10-06';
        //$voteend = '2015-10-08';
        //$result_date = '2015-10-08';

        if(strtotime($votestart) <= time()){
            foreach ($tfacategorys['location'] as $key => $tfacategory) {
                if(strtolower($tfacategory['name']) == $this->tfacity){
                    $eventId = $tfacategorys['location'][$key]['events'][0]['id'];
                    foreach ($tfacategory['events'][0]['categories'] as $key1 => $event) {
                        foreach ($event['child_category'] as $key2 => $category) {
                            $toslug = $this->toslug($category['name']);
                            if($this->tfasubcat == '' and $i == 1){
                                $catid = $key2;
                                $catname = $category['name'];
                                $child_category = $category['child_category'];
                                $toslugname = $toslug;
                            }else if($toslug == $this->tfasubcat){
                                $catid = $key2;
                                $catname = $category['name'];
                                $child_category = $category['child_category'];
                                $toslugname = $toslug;
                            }
                            $i++;
                        }
                    }
                }
            }
            $nominations =  array();
            $i = 0;
            foreach($child_category as $key=>$child_cat){
                $TFA = new \WH\Model\Tfa();
                $TFA->setEventID($eventId);
                $TFA->setCategoryID($key);
                $nomination_vanue =  $TFA->getAllNominations();

                /* For vote checking */
                if ($this->cookies->has("uniquekey")){
                    $uniquekey = (string)$this->cookies->get("uniquekey");
                }
                $votecheck = new \WH\Model\BNH();
                foreach ($nomination_vanue as $keyfornomination=>$nomination_venue) {
                    $id = explode('_', $nomination_venue['id']);
                    $votecheck->setNominationID($id[1]);
                    $votecheck->setCategoryName($key);
                    $votecheck->setBrowserID($uniquekey);
                    $votecheck->setContestName('tfa');
                    $votecheck->setEventID($eventId);
                    $result = $votecheck->votingStatus();
                    $nomination_vanue[$keyfornomination]['isvoted'] = $result;
                    //if($result == 1)
                        //$nomination_vanue[$keyfornomination]['is_winner'] = 1;
                }
                /* For vote checking */


                if(!empty($nomination_vanue)){
                    $nominations[$i]['id'] = $key;
                    $nominations[$i]['nominationcatid'] = $this->catCode($child_cat['name'], $key);
                    $nominations[$i]['event_id'] = $eventId;
                    $nominations[$i]['maincat_id'] = $catid;
                    $nominations[$i]['category_name'] = $catname;
                    $nominations[$i]['subcategory_name'] = $child_cat['name'];
                    $nominations[$i]['count_venue'] = count($nomination_vanue);
                    $nominations[$i]['venue'] = $nomination_vanue;
                    $nominations[$i]['slug'] = $toslugname;
                    $i++;
                }
            }
            $this->view->nominations = $nominations;
            //echo "<pre>"; print_r($nominations); echo "</pre>";exit;

            if(strtotime($voteend) <= time()){
                $this->view->iscontestrunning = 0;
            }else{
                $this->view->iscontestrunning = 1;
            }

            if(strtotime($result_date) <= time()){
                $this->view->setLayout('tfaLayout');
                $this->view->pick(['tfa/complete']);
            }else{
                $this->view->setLayout('tfaLayout');
                $this->view->pick(['tfa/nomination']);
            }
        }

    }


    public function catCode($catname, $catId){
        $catNameArray=explode(' ',$catname);
        $catcode='';
        for($i=0;$i<count($catNameArray);$i++)
        {
            $catcode.=strtoupper(substr($catNameArray[$i], 0, 1));
        }
        $catcode.='-'.$catId;
        return $catcode;
    }

    public function newsletterAction(){
    	$email = $this->request->getPost('email');
    	$city = $this->request->getPost('city');
    	$cityid = $this->request->getPost('cityid');
    	try{
    		if(!empty($email)){
    			$Newsletter = new \WH\Model\User();
		        $Newsletter->setNewsletter();
		        $Newsletter->setEmail($email);
		        $Newsletter->setCityId($cityid);
		        $Newsletter->setType('tfa');
		        $Newsletter->setVersion($this->config->application->version);
				$Newsletter->setPackage($this->config->application->package);
				$Newsletter->setEnv($this->config->application->environment);
		        $newsletter = $Newsletter->getNewsletterResults();
		        $this->flash->message("debug", "Thanks, we will inform you when the voting starts");	
    		}else{
    			$this->flash->message("debug", "Please enter your email");
    		}
    	}catch(Exception $e){
    		$this->flash->message("debug", "You are already subscribed with us");
    	}
    	$this->response->redirect($this->baseUrl.'/'.$city.'/times-food-and-nightlife-awards-2016');
    }

    public function votingAction(){
        $nominationid = $this->request->getPost('nominationid');
        $categoryid = $this->request->getPost('categoryid');
        $city = $this->request->getPost('city');
        $contestname = $this->request->getPost('contestname');
        $eventid = $this->request->getPost('eventid');
        if ($this->cookies->has("uniquekey")){
            $uniquekey = (string)$this->cookies->get("uniquekey");
        }

        $user_id = '';

        if(!empty($this->logged_user)){
            $user_id = $this->logged_user->sso_id;
        }
        $voting = new \WH\Model\BNH();
        $voting->setContestName($contestname);
        $voting->setNominationID($nominationid);
        $voting->setBrowserID($uniquekey);
        $voting->setCategoryName($categoryid);
        $voting->setIP($_SERVER['REMOTE_ADDR']);
        $voting->setEventID($eventid);
        $voting->setUserID($user_id);
        //echo "<pre>"; print_r($voting); echo "</pre>";

        try{
            $result = $voting->voting();    
            echo json_encode($result);
        }catch(Exception $e){
             echo "<pre>"; print_r($e); echo "</pre>";
        }
        
        exit;
    }



    public function cancelvotingAction(){
        $nominationid = $this->request->getPost('nominationid');
        $categoryid = $this->request->getPost('categoryid');
        $city = $this->request->getPost('city');
        $contestname = $this->request->getPost('contestname');
        $eventid = $this->request->getPost('eventid');
        if ($this->cookies->has("uniquekey")){
            $uniquekey = (string)$this->cookies->get("uniquekey");
        }

        $voting = new \WH\Model\BNH();
        $voting->setContestName($contestname);
        $voting->setNominationID($nominationid);
        $voting->setBrowserID($uniquekey);
        $voting->setCategoryName($categoryid);
        $voting->setEventID($eventid);
        
        try{
            $result = $voting->deletevote();    
            echo json_encode($result);
        }catch(Exception $e){
             echo "<pre>"; print_r($e); echo "</pre>";
        }
        
        exit;
    }
}