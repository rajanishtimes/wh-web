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
		
		if($this->dispatcher->getParam('tag'))
			$this->tags = $this->dispatcher->getParam('tag');
			
		$this->view->setVars(array('tags' => $this->tags));
		parent::initialize();
    }

    public function indexAction(){
		$tagsfeeds = $this->getfeeddata(0, 12, $this->city, 'all', 'tags', $this->tags, 'Event,Content');
		$this->view->setVars(array('tagsfeeds' => $tagsfeeds));
    }
}
