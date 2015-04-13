<?php

$router = new Phalcon\Mvc\Router(true);
$router->removeExtraSlashes(true);

$request = $_SERVER['QUERY_STRING'];
$request = trim($request, '/');
$split = explode('/', $request);
$urlparams = end($split);
	
/* $router->add("/tag/{tags:[a-zA-Z0-9\-]+}", array(
    'controller' => 'tag',
    'action' => 'index',
));
*/

$router->add("/author/{authorname:[a-zA-Z0-9\-]+}", array(
    'controller' => 'author',
    'action' => 'index',
)); 

$router->add("/author/posts", array(
    'controller' => 'author',
    'action' => 'posts',
)); 

/* $router->add("/critic-review/{critic:[a-zA-Z0-9\-]+}", array(
    'controller' => 'critic',
    'action' => 'index',
)); */
/* 
$router->add("/search/{searchquery:[a-zA-Z0-9\-]+}", array(
    'controller' => 'search',
    'action' => 'index',
)); */

if(preg_match('/\b-e-[0-9]{1,}\b/i', $urlparams, $match)){
	$router->add("/{city:[a-zA-Z0-9\-]+}/{eventtitle:[a-zA-Z0-9\-]+}", array(
		'controller' => 'event',
		'action' => 'index',
	));
}

if(preg_match('/\b-c-[0-9]{1,}\b/i', $urlparams, $match)){
	$router->add("/{city:[a-zA-Z0-9\-]+}/{contenttitle:[a-zA-Z0-9\-]+}", array(
		'controller' => 'content',
		'action' => 'index',
	));
}

$router->add("/{city:[a-zA-Z0-9\-]+}", array(
	'controller' => 'index',
	'action' => 'index',
));

$router->handle();