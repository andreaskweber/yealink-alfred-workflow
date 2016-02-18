<?php

namespace AndreasWeber;

// boot
define('BASE_DIR', realpath(__DIR__ . '/../'));

// bootstrap
$config = require_once BASE_DIR . '/bin/bootstrap.php';

// script
$script = new CommandScriptInput($config);

/** @var string $query Input query */
$script->invoke($query);
