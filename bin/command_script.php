<?php

namespace AndreasWeber;

// boot
define('BASE_DIR', realpath(__DIR__ . '/../'));
require_once BASE_DIR . '/bin/bootstrap.php';

// load config
$config = require_once BASE_DIR . '/config.php';

// script
$script = new CommandScriptInput($config);

/** @var string $query Input query */
$xml = $script->invoke($query);

// echo xml
echo $xml;
