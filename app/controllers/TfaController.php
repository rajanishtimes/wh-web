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
		$this->view->meta_description = 'Times Food Awards & Times Nightlife Awards 2016 '.$this->cityshown($this->currentCity).': Find best restaurants, bars & clubs in '.$this->currentCity.'. Best dining and party places in '.$this->currentCity;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->cityshown($this->currentCity).', Times Nightlife Awards '.$this->currentCity;

		$TFA = new \WH\Model\Tfa();
        $TFA->setCityID($this->cityId);
        $allpastwinners = $TFA->getpastwinners();
        $this->view->allpastwinners = $allpastwinners;

        //echo "<pre>"; print_r($allpastwinners); echo "</pre>"; exit;
    }

    public function nominationAction(){
        $this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate'); 
		$title = $this->cityshown($this->currentCity).' Times Food & Nightlife Awards 2016, Best Restaurants | '.$this->config->application->SiteName;
		$this->tag->setTitle($title);
		$this->view->meta_description = 'Times Food Awards & Times Nightlife Awards 2016 '.$this->cityshown($this->currentCity).': Find best restaurants, bars & clubs in '.$this->currentCity.'. Best dining and party places in '.$this->currentCity;
		$this->view->meta_keywords = 'Times Food Awards, Times Nightlife Awards, Times Food Awards '.$this->cityshown($this->currentCity).', Times Nightlife Awards '.$this->currentCity;
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
                $eventId = $tfacategorys['location'][$key]['events'][0]['id'];
                foreach ($tfacategory['events'][0]['categories'] as $key1 => $event) {
                    foreach ($event['child_category'] as $key2 => $category) {
                        $title = $this->create_title(strtolower($this->tfasubcat));
                        if($this->tfasubcat == '' and $i == 1){
                            $catid = $key2;
                            $catname = $category['name'];
                            $child_category = $category['child_category'];
                        }else if($title == strtolower($category['name'])){
                            $catid = $key2;
                            $catname = $category['name'];
                            $child_category = $category['child_category'];
                        }
                        $i++;
                    }
                }
            }
        }
        //echo "<pre>"; print_r($child_category); echo "</pre>"; exit;
        $nominations =  array();
        $i = 0;
        foreach($child_category as $key=>$child_cat){
            $TFA = new \WH\Model\Tfa();
            $TFA->setEventID($eventId);
            $TFA->setCategoryID($key);
            $nomination_vanue =  $TFA->getAllNominations();
            if(!empty($nomination_vanue)){
                $nominations[$i]['id'] = $key;
                $nominations[$i]['event_id'] = $eventId;
                $nominations[$i]['maincat_id'] = $catid;
                $nominations[$i]['category_name'] = $catname;
                $nominations[$i]['subcategory_name'] = $child_cat['name'];
                $nominations[$i]['count_venue'] = count($nomination_vanue);
                $nominations[$i]['venue'] = $nomination_vanue;
                $i++;
            }
        }
        $this->view->nominations = $nominations;
        //echo "<pre>"; print_r($nominations); echo "</pre>";exit;
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
}