<?php

$GLOBALS["time_start"] = microtime(true);
$GLOBALS["time_end"] = 0;
$GLOBALS["logs"] = array();

error_reporting(E_ALL);

use Phalcon\Mvc\Application;
use Phalcon\Config\Adapter\Ini as ConfigIni;

//$_GET['_url'] = '/contact/send';
//$_SERVER['REQUEST_METHOD'] = 'POST';


try {

	define('APP_PATH', realpath('..') . '/');
	define('APP_ROOT', APP_PATH . 'app/models/wh-appapi');

	/**
	 * Read the configuration
	 */
	$config = new ConfigIni(APP_PATH . 'app/config/config.ini');
	
	/**
	 * Auto-loader configuration
	 */
	require APP_PATH . 'app/config/loader.php';
	
	/**
	 * Load application services
	 */
	require APP_PATH . 'app/config/services.php';
	
	$application = new Application($di);
	echo $application->handle()->getContent();

} catch (Exception $e){
	echo $e->getMessage();
}
