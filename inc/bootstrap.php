<?php

// define base directory
define('BASE_PATH', realpath(__DIR__ . '/../'));

// load files
require_once BASE_PATH . '/inc/autoload.php';

// simulate a query for debugging
// $query = 'line1@foo.bar 123123';

// we must have a valid query string
if (empty($query)) {
    throw new \InvalidArgumentException('Missing or empty input query.');
}

// check if config file exists
$configFile = BASE_PATH . '/config.php';
if (!file_exists($configFile) || !is_readable($configFile)) {
    throw new \RuntimeException(
        sprintf(
            'Could not bootstrap. Config file missing or not readable: %s',
            $configFile
        )
    );
}

// load config
return require_once BASE_PATH . '/config/config.php';