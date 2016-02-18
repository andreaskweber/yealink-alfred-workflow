<?php

namespace AndreasWeber;

// load files
require_once BASE_DIR . '/src/AbstractScript.php';
require_once BASE_DIR . '/src/FilterScript.php';
require_once BASE_DIR . '/src/CommandScriptInput.php';
require_once BASE_DIR . '/src/FilterScript/Command.php';
require_once BASE_DIR . '/src/FilterScript/Item.php';
require_once BASE_DIR . '/src/FilterScript/ResponseXmlBuilder.php';
require_once BASE_DIR . '/src/Phone/PhoneCommand.php';
require_once BASE_DIR . '/src/Query/QueryParser.php';

// debug
//$query = 'line1@foo.bar 123123';

// safeguard
if (empty($query)) {
    throw new \InvalidArgumentException('Missing or empty input query.');
}

// check if config exists
$configFile = BASE_DIR . '/config.php';
if (!file_exists($configFile) || !is_readable($configFile)) {
    throw new \RuntimeException(
        sprintf(
            'Could not bootstrap. Config file missing or not readable: %s',
            $configFile
        )
    );
}

// load config
return require_once BASE_DIR . '/config.php';
