<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// define base path
defined('BASE_PATH')
|| define('BASE_PATH', realpath(__DIR__ . '/../'));

// autoloader
require_once BASE_PATH . '/vendor/autoload.php';
