<?php

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * We register the events manager
 */
 $di->set(
    'dispatcher',
    function() use ($di) {

        $evManager = $di->getShared('eventsManager');
        $evManager->attach("dispatch:beforeException", new NotFoundPlugin);
        $dispatcher = new Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($evManager);
        return $dispatcher;
    },
    true
);

/* $di->set('dispatcher', function() use ($di) {
	$eventsManager = new EventsManager;
	$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
	$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
	$dispatcher = new Dispatcher;
	$dispatcher->setEventsManager($eventsManager);
	return $dispatcher;
});
 */
$di->set('config', $config);

/**
 * Load router from external file
 */
$di->set('router', function(){
	require APP_PATH.'app/config/routes.php';
	//$router->notFound(['controller' => 'Index', 'action'=> 'index']);
    //$router->setDefaultController('index');
    //$router->setDefaultAction('index');
	return $router;
});


/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config){
	$url = new UrlProvider();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});


$di->set('view', function() use ($config) {
	$view = new View();
	$view->setViewsDir(APP_PATH . $config->application->viewsDir);
	$view->registerEngines(array(
		".volt" => 'volt'
	));
	return $view;
});

/**
 * Setting up volt
 */
$di->set('volt', function($view, $di) {

	$volt = new VoltEngine($view, $di);

	$volt->setOptions(array(
		"compiledPath" => APP_PATH . "cache/volt/"
	));

	$compiler = $volt->getCompiler();
	$compiler->addFunction('is_a', 'is_a');

	return $volt;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function() use ($config) {
	$dbclass = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
	return new $dbclass(array(
		"host"     => $config->database->host,
		"username" => $config->database->username,
		"password" => $config->database->password,
		"dbname"   => $config->database->name
	));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function() {
	return new MetaData();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});


/**
 * Start the cookie the first time some component request the session service
 */
$di->set('cookies', function() {
    $cookies = new Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function(){
	return new FlashSession(array(
		'error'   => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice'  => 'alert alert-info',
	));
});

/**
 * Register a user component
 */
$di->set('elements', function(){
	return new Elements();
});

$di->set('feeds', function(){
	return new Feeds();
});
