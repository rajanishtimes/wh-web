<?php

use Phalcon\Mvc\Session;

class Session extends Session{
	
	function __construct(){
		$di->setShared('session', function() {
			$session = new Phalcon\Session\Adapter\Files();
			$session->start();
			return $session;
		});
	}
	
}
