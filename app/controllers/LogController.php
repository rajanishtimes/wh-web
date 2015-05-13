<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class LogController extends BaseController{
	public function initialize(){
		parent::initialize();
    }

    public function indexAction(){
		if ($this->request->isAjax() == true) {
			$entitytype = $this->request->getPost("type");
			$request_uri = $this->request->getPost("request_uri");
			$logger = new \WH\Model\Logger();
			$logger->setEntityId('');
			$logger->setRequestUri($request_uri);
			$logger->setEntityType($entitytype);
			$logger->saveViewLogs();
		}
		exit;
    }
}
