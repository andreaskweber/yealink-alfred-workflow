<?php

use AndreasWeber\YealinkWorkflow\Application;

// define base directory
define('BASE_PATH', realpath(__DIR__ . '/../'));
define('COMMAND_PREFIX', 'ye');

// load files
require_once BASE_PATH . '/inc/autoload.php';

// simulate a query for debugging
// $query = 'ye:call +49 123 456798';

// bootstrap application
$app = new Application();

// return
return $app;
