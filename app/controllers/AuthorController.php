<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class AuthorController extends BaseController{
	public $authorname = '';
	public function initialize(){
        $this->tag->setTitle('Author');
        $this->view->setLayout('mainLayout');
		
		if(!empty($this->dispatcher->getParam('authorname')))
			$this->authorname = $this->dispatcher->getParam('authorname');
			$this->view->authorname = $this->authorname;
		
		parent::initialize();
    }

    public function indexAction(){
		
    }
}
