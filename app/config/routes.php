<?php

$router = new Phalcon\Mvc\Router();

$router->add("/{city:[a-zA-Z0-9\-]+}", array(
    'controller' => 'index',
    'action' => 'index',
));


