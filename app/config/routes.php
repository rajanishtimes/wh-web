<?php

$router = new Phalcon\Mvc\Router(true);
$router->removeExtraSlashes(true);

$request = $_SERVER['QUERY_STRING'];
$request = trim($request, '/');
$split = explode('/', $request);
$urlparams = end($split);
	
$router->add("/tag/{tags:[a-zA-Z0-9\- ]+}", array(
    'controller' => 'tag',
    'action' => 'index',
));


$router->add("/author/{authorname:[a-zA-Z0-9\- ]+}", array(
    'controller' => 'author',
    'action' => 'index',
)); 

$router->add("/author/posts", array(
    'controller' => 'author',
    'action' => 'posts',
)); 


$router->add("/{city:[a-zA-Z0-9\-]+}/venue/{venue:[a-zA-Z0-9\- ]+}", array(
	'controller' => 'venue',
	'action' => 'index',
));


/* $router->add("/critic-review/{critic:[a-zA-Z0-9\-]+}", array(
    'controller' => 'critic',
    'action' => 'index',
)); */


$router->add("/search/{searchquery:[a-zA-Z0-9\- ]+}", array(
    'controller' => 'search',
    'action' => 'search',
));

$router->add("/search/search", array(
    'controller' => 'search',
    'action' => 'forwardsearch',
));

$router->add("/search/index", array(
    'controller' => 'search',
    'action' => 'index',
));

$router->add("/search/searchlist", array(
    'controller' => 'search',
    'action' => 'searchlist',
));

$router->add("/search", array(
    'controller' => 'search',
    'action' => 'search',
));


$router->add("/search/autosuggestion", array(
    'controller' => 'search',
    'action' => 'autosuggestion',
));

if(preg_match('/\b-e-[a-zA-Z0-9\- ]+/i', $urlparams, $match)){	
	$router->add("/{city:[a-zA-Z0-9\-]+}/{eventtitle:[a-zA-Z0-9\-]+}", array(
		'controller' => 'event',
		'action' => 'index',
	));
}

if(preg_match('/\b-c-[a-zA-Z0-9\- ]+/i', $urlparams, $match)){
	$router->add("/{city:[a-zA-Z0-9\-]+}/{contenttitle:[a-zA-Z0-9\-]+}", array(
		'controller' => 'content',
		'action' => 'index',
	));
}

if(preg_match('/\b-s-[a-zA-Z0-9\- ]+/i', $urlparams, $match)){
	$router->add("/{city:[a-zA-Z0-9\-]+}/{specialpagetitle:[a-zA-Z0-9\-]+}", array(
		'controller' => 'specialpage',
		'action' => 'index',
	));
}

$router->add("/{city:[a-zA-Z0-9\-]+}", array(
	'controller' => 'index',
	'action' => 'homepage',
));

$router->add("/policy", array(
    'controller' => 'index',
    'action' => 'policy',
));

$router->add("/terms", array(
    'controller' => 'index',
    'action' => 'terms',
));


$router->add("/search", array(
    'controller' => 'search',
    'action' => 'search',
));


$router->add("/homepage", array(
    'controller' => 'index',
    'action' => 'homepage',
)); 


$router->handle();