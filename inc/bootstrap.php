<?php

use AndreasWeber\YealinkWorkflow\Application;

// define base directory
define('BASE_PATH', realpath(__DIR__ . '/../'));

// load files
require_once BASE_PATH . '/inc/autoload.php';

// simulate a query for debugging
// $query = 'line1@foo.bar 123123';

// app
return new Application($query);
