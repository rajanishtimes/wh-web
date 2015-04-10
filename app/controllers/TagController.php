<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class TagController extends BaseController{
	public $tags = '';
	public function initialize(){
        $this->tag->setTitle('Tag');
        $this->view->setLayout('mainLayout');
		
		if(!empty($this->dispatcher->getParam('tag')))
			$this->tags = $this->dispatcher->getParam('tag');
			$this->view->tags = $this->tags;
		
		parent::initialize();
    }

    public function indexAction(){
		$tagsfeeds = $this->getfeeddata(0, 3, $this->city, 'all', 'tags', $this->tags);
		$this->view->tagsfeeds = $tagsfeeds;
    }
}
