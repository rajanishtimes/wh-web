<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class CriticController extends BaseController{
	public $critic = '';
	public function initialize(){
        $this->tag->setTitle('Critic');
        $this->view->setLayout('mainLayout');
		
		if(!empty($this->dispatcher->getParam('critic')))
			$this->critic = $this->dispatcher->getParam('critic');
			$this->view->critic = $this->critic;
		
		parent::initialize();
    }

    public function indexAction(){
		
    }
}
