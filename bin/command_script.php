<?php

namespace AndreasWeber;

// boot
define('BASE_DIR', realpath(__DIR__ . '/../'));
require_once BASE_DIR . '/src/Bootstrap/bootstrap.php';

// load config
$config = require_once BASE_DIR . '/config.php';

// script
$script = new CommandScriptInput($config);

if (isset($query)) {
    $xml = $script->invoke($query);
} else {
    throw new \InvalidArgumentException('Missing input query.');
}

// echo xml
echo $xml;
