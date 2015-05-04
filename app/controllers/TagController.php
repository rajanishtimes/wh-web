<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class TagController extends BaseController{
	public $tags = '';
	public function initialize(){
		$this->setlogsarray('tag_start');
        $this->tag->setTitle('Tag');
        $this->view->setLayout('mainLayout');
		$this->view->searchform = new SearchForm;
		$this->view->newsletterform = new NewsletterForm;
		
		if($this->dispatcher->getParam('tags'))
			$this->tags = $this->dispatcher->getParam('tags');
			
		$this->view->setVars(array('tags' => $this->tags));
		parent::initialize();
    }

    public function indexAction(){
		$this->response->setHeader('Cache-Control', 'max-age=900');
		if($this->dispatcher->getParam('city'))
			$city = $this->dispatcher->getParam('city');
		$start = 0;
		$limit = 11;
		$this->tags = $this->create_title($this->tags);
                $tags = $this->tags;
		try{
			$tagsfeeds = $this->getfeeddata($start, $limit, $city, 'all', 'tags', $this->tags, 'Event,Content');
			$this->setlogsarray('tag_get_records');
		}catch(Exception $e){
			$tagsfeeds = array();
		}
		
		//$current_encoding = mb_detect_encoding($this->tags, 'auto');
		//$ttgs = iconv($current_encoding, 'UTF-8', $this->tags);
	
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($tags))) =>''));
		$this->view->setVars(
			array(
				'tagsfeeds' => $tagsfeeds,
				'tags'=>$tags,
				'start'=>$limit,
				'limit'=>$limit,
				'breadcrumbs'=>$breadcrumbs
				)
			);
			
		/* ======= Seo Update ============= */
		$this->tag->setTitle($this->tags.' | '.$this->config->application->SiteName);
		$this->view->meta_description = $this->tags.': Find all the information related to '.$this->tags.' at '.$this->config->application->SiteName;
		$this->view->meta_keywords = $this->tags;
		/* ======= Seo Update ============= */
		$this->setlogsarray('tag_end');
		$this->getlogs('tag', $this->baseUrl.'/tag/'.$this->tags);
    }
	
	public function forwardtagAction(){
		$url = $this->baseUrl.'/'.'#finished';
		return $this->response->redirect($url);     
	}
	
	public function apptestingAction(){
		$url = 'timescity://ty=s&qu=WhatsHot App';
		return $this->response->redirect($url);     
	}
}
