<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class IndexController extends BaseController{
	
	public function initialize(){
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		parent::initialize();
    }

	public function indexAction(){
		if(!empty($this->profileid)){
			$this->profilepage();
		}else{
			$this->homepage();
		}
    }

    protected function profilepage(){
    	$allfeedslists = $this->getfeeddata(0, 4, $this->city, 'all', '', '', 'Content', '', 'feed', 0, 4);
		$this->view->allfeedslists = $allfeedslists;

		$Wishlist = new \WH\Model\Wishlist();
        $Wishlist->setUserId($this->profileid);
        $Wishlist->setVersion($this->config->application->version);
		$Wishlist->setPackage($this->config->application->package);
		$Wishlist->setEnv($this->config->application->environment);
        $allwishlistlist = $Wishlist->getAll();
		
		$this->view->setVars(
			array(
				'allwishlistlist' => $allwishlistlist,
				'total_count' => $total_count,
				'start'=>10,
				'limit'=>10
				)
			);

    	$this->view->pick(["index/profile"]);
    }
	
	protected function homepage(){
		/* $this->setcities();
		$this->setcityid();*/
		$this->setlogsarray('homepage_start');
		$this->view->entitytype = 'homepage';
		$city = $this->currentCity;
		$cityshown = $this->cityshown($city);
		$this->view->cityshown = $cityshown;
		$this->response->setHeader('Cache-Control', 'max-age=900');
		//$this->response->setHeader('Cache-Control', 'private, max-age=0, must-revalidate');
		
		
		/* ======= Seo Update ============= */
		
		if($cityshown == 'Delhi NCR'){
			$title = 'Things to do in Delhi NCR, Gurgaon, Noida, Faridabad & Ghaziabad Today | '.$this->config->application->SiteName;
			$this->view->meta_description = 'Events in NCR - Delhi, Gurgaon, Noida, Faridabad, Ghaziabad & Greater Noida: Check out the list of things to do in Delhi NCR today and have unlimited fun.';
			$this->view->meta_keywords = 'things to do in Delhi NCR, what to do in Delhi NCR, Delhi NCR events';
		}else{
			$title = $cityshown.' Events: Things to do in '.$cityshown.' Today | '.$this->config->application->SiteName;
			$this->view->meta_description = 'Events in '.$cityshown.': Getting bored? Wondering what to do in '.$cityshown.' today? Check out the list of things to do in '.ucwords($city).' today and have unlimited fun. ';
			$this->view->meta_keywords = 'things to do in '.$cityshown.', what to do in '.$cityshown.', '.$cityshown.' events';
		}
		$this->tag->setTitle($title);

		if($_SERVER['REQUEST_URI'] == '/'){
			$this->view->canonical_url = $this->baseUrl;	
		}else{
			$this->view->canonical_url = $this->baseUrl.'/'.$city;
		}
		
		$this->view->deep_link = 'timescity://';
		/* ======= Seo Update ============= */
		$top3event = new \WH\Model\Event();
		$top3event->setCityID($this->cityId);
		$top3event->setParam('byType', 'Event,Content,Review');

		try{
			$topfeeds = $top3event->webTop3List();
		}catch(Exception $e){
			$topfeeds = array();
		}
		$this->setlogsarray('top_feeds');
		
		$core = new \WH\Model\Core();
		$core->setCity($this->cityId);
		try{
			$populartags = $core->getResults();
		}catch(Exception $e){
			$populartags = array();
		}
		
		$this->setlogsarray('popular_tags');
		
		$start = 0;
		$limit = 11;

		if($this->config->adtech->enableadtech == 1){
			$llimit = $limit-1;
		}else{
			$llimit = $limit;
		}
		
		try{
			$allfeedslist = $this->getfeeddata($start, $llimit, $city, 'all', '', '', 'Event,Content', '', 'feed', $start, $llimit);
			$sponsors_count = count($allfeedslist['results']) - $llimit;
		}catch(Exception $e){
			$allfeedslist = array();
		}
				
		$this->view->setVars(
			array(
				'allfeedslist' => $allfeedslist,
				'start'=> $llimit - $sponsors_count,
				'limit'=>$limit,
				'populartags'=>$populartags,
				'topfeeds'=>$topfeeds,
				'spstart' => $llimit,
				'splimit' => $limit
				)
			);
		
		$this->setlogsarray('all_feeds');
		$this->getlogs('homepage', $this->baseUrl.'/homepage');
	}

	public function newsletterAction(){
		$ermessage = array();
		$form = new NewsletterForm();
		if ($form->isValid($this->request->getPost())) {
			// Test only
			
			$this->session->set("email", $this->request->getPost('email'));
			return $this->forward('index/index');
		} else {
			//print_r($form);
			//print_r($form->getMessages());
			foreach ($form->getMessages() as $message) {
				$ermessage[] = $message;
			}
			exit;
		}
	}
	
	public function homepageAction(){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$this->baseUrl);
		exit;
		//$this->view->setLayout('homepageLayout');
    }
	
	public function policyAction(){
        $this->tag->setTitle('Privacy Policy');
		$this->view->entitytype = 'policy';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Privacy Policy';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'policy';
		$this->view->canonical_url = $this->baseUrl.'/'.'policy';
    }
    public function termsAction(){
        $this->tag->setTitle('Terms & Conditions');
		$this->view->entitytype = 'terms';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'Terms & Conditions';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'terms';
		$this->view->canonical_url = $this->baseUrl.'/'.'terms';
    }
	
	public function whytimescityAction(){
        $this->tag->setTitle('What is What&apos; Hot?');
		$this->view->entitytype = 'story';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'What is What&apos; Hot?';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'story';
		$this->view->canonical_url = $this->baseUrl.'/'.'about-us';
    }

    public function whytimescityrawAction(){
        $this->view->setLayout('rawLayout');
    }

    public function aboutusAction(){
        $this->tag->setTitle('About Us');
		$this->view->entitytype = 'about us';
		$this->view->meta_description = '';
		$this->view->meta_keywords = '';
		$this->view->og_title = 'About Us';
		$this->view->og_description = '';
		$this->view->og_url = $this->baseUrl.'/'.'about-us';
		$this->view->canonical_url = $this->baseUrl.'/'.'about-us';
    }

	
	public function unsubscribeAction(){
		$email = base64_decode($this->dispatcher->getParam('email'));
		$Newsletter = new \WH\Model\User();
		$Newsletter->setNewsletter();
        $Newsletter->setEmail($email);
		$Newsletter->getUnsubNewsletterResults();
	}
}
