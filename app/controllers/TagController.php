<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class TagController extends BaseController{
	public $tags = '';
	public function initialize(){
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
		$start = 0;
		$limit = 11;
		try{
			$tagsfeeds = $this->getfeeddata($start, $limit, $this->city, 'all', 'tags', $this->tags, 'Event,Content');
		}catch(Exception $e){
			$tagsfeeds = array();
		}
		
		$breadcrumbs = $this->breadcrumbs(array(ucwords(strtolower(trim($this->tags))) =>''));
		
		$this->view->setVars(
			array(
				'tagsfeeds' => $tagsfeeds,
				'tags'=>$this->tags,
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
    }
	
	public function forwardtagAction(){
		$url = $this->baseUrl.'/'.'#finished';
		return $this->response->redirect($url);     
	}
}
