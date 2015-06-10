<?php

use WH\Core\BaseController as BaseController;
use WH\Api\Params;

class LogController extends BaseController{
	public function initialize(){
		parent::initialize();
    }

    public function indexAction(){
		if ($this->request->isAjax() == true) {
			$entitytype = $this->request->get("entitytype");
			$entityid = $this->request->get("entityid");
			$request_uri = $this->request->get("request_uri");
			$logger = new \WH\Model\Logger();
			$logger->setEntityId($entityid);
			$logger->setRequestUri($request_uri);
			$logger->setSource('web');
			$logger->setEntityType($entitytype);
			$logger->saveViewLogs();
		}
		exit;
    }
}