<?php

$router = new Phalcon\Mvc\Router(true);
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(true);

$request = $_SERVER['QUERY_STRING'];
$request = trim($request, '/');
$split = explode('/', $request);
$urlparams = end($split);

$router->add("/author/{authorname}", array(
    'controller' => 'author',
    'action' => 'index',
)); 

$router->add("/author/posts", array(
    'controller' => 'author',
    'action' => 'posts',
)); 


$router->add("/{city}/venue/{venue}", array(
	'controller' => 'venue',
	'action' => 'index',
));

$router->add("/{city}/location/{locationname}", array(
	'controller' => 'location',
	'action' => 'location',
));

$router->add("/{city}/search/{searchquery}", array(
    'controller' => 'search',
    'action' => 'search',
));


$router->add("/{city}/tag/{tags}", array(
    'controller' => 'tag',
    'action' => 'index',
));

$router->add("/critic-review/{critic}", array(
    'controller' => 'critic',
    'action' => 'index',
));

$router->add("/{city}/search/search", array(
    'controller' => 'search',
    'action' => 'forwardsearch',
));

$router->add("/{city}/location/location", array(
    'controller' => 'location',
    'action' => 'forwardlocation',
));

$router->add("/tag/forwardtag", array(
    'controller' => 'tag',
    'action' => 'forwardtag',
));

$router->add("/tag/apptesting", array(
    'controller' => 'tag',
    'action' => 'apptesting',
));


$router->add("/search/index", array(
    'controller' => 'search',
    'action' => 'index',
));

$router->add("/search/searchlist", array(
    'controller' => 'search',
    'action' => 'searchlist',
));

$router->add("/{city}/search", array(
    'controller' => 'search',
    'action' => 'search',
));

$router->add("/{city}/location", array(
    'controller' => 'location',
    'action' => 'location',
));

$router->add("/{city}/events", array(
    'controller' => 'event',
    'action' => 'eventlist',
));


$router->add("/search/autosuggestion", array(
    'controller' => 'search',
    'action' => 'autosuggestion',
));

if(preg_match('/\be-[0-9\- ]+/i', $urlparams, $match)){	
	$router->add("/{city}/{eventtitle}", array(
		'controller' => 'event',
		'action' => 'index',
	));
}

if(preg_match('/\bc-[0-9\- ]+/i', $urlparams, $match)){
	$router->add("/{city}/{contenttitle}", array(
		'controller' => 'content',
		'action' => 'index',
	));
}

if(preg_match('/\bs-[0-9\- ]+/i', $urlparams, $match)){
	$router->add("/{city}/{specialpagetitle}", array(
		'controller' => 'specialpage',
		'action' => 'index',
	));
}

if(preg_match('/\bv-[0-9\- ]+/i', $urlparams, $match)){
	$router->add("/{city}/{venue}", array(
		'controller' => 'venue',
		'action' => 'index',
	));
}

$router->add("/{city}", array(
	'controller' => 'index',
	'action' => 'index',
));

$router->add("/policy", array(
    'controller' => 'index',
    'action' => 'policy',
));

$router->add("/terms", array(
    'controller' => 'index',
    'action' => 'terms',
));

$router->add("/about-us", array(
    'controller' => 'index',
    'action' => 'aboutus',
));

$router->add("/story", array(
    'controller' => 'index',
    'action' => 'whytimescity',
));


$router->add("/storyraw", array(
    'controller' => 'index',
    'action' => 'whytimescityraw',
));


$router->add("/search", array(
    'controller' => 'search',
    'action' => 'search',
));


$router->add("/index", array(
    'controller' => 'index',
    'action' => 'index',
)); 

$router->add("/homepage", array(
    'controller' => 'index',
    'action' => 'homepage',
)); 

$router->add("/hyderabad/biryanihaleem", array(
    'controller' => 'quiz',
    'action' => 'index',
)); 

$router->add("/", array(
    'controller' => 'index',
    'action' => 'index',
)); 

$router->add("/unsubscribe/{email}", array(
    'controller' => 'index',
    'action' => 'unsubscribe',
)); 

$router->notFound(array(
    "controller" => "error",
    "action"     => "route404"
));

$router->handle();