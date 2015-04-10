<?php

use WH\Core\BaseController as BaseController;

class NewsletterController extends BaseController{
	
	public function initialize(){
		
        $this->tag->setTitle('Welcome');
		parent::initialize();
    }

    public function indexAction(){
		echo "<pre>"; print_r($this->request);
    }
	
	
}
