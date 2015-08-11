<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
	array(
		APP_PATH . $config->application->controllersDir,
		APP_PATH . $config->application->pluginsDir,
		APP_PATH . $config->application->libraryDir,
		APP_PATH . $config->application->modelsDir,
		APP_PATH . $config->application->formsDir,
		APP_PATH . $config->application->coreDir,
	)
)->register();

$loader->registerNamespaces(
    array(
		'WH\Forms'    => APP_PATH."app/forms/",
		'WH\Core'    => APP_PATH."app/core/",
		'WH'    => APP_PATH."app/models/wh-appapi/",
		'Predis'    => APP_PATH."app/models/wh-appapi/Lib/predis/src",
    )
);


/* $loader->registerClasses(
    array(
        "SearchForm"	=>	APP_PATH .'/app/forms/SearchForm.php',
    )
); */

$loader->register();
//$SearchForm = new SearchForm();