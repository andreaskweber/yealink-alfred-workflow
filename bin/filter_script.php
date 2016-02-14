<?php

namespace AndreasWeber;

// boot
define('BASE_DIR', realpath(__DIR__ . '/../'));
require_once BASE_DIR . '/bin/bootstrap.php';

// load config
$config = require_once BASE_DIR . '/config.php';

// script
$script = new FilterScriptInput($config);

/** @var string $query Input query */
$script->invoke($query);
