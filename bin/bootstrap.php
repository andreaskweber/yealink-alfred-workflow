<?php

// load files
require_once BASE_DIR . '/src/AbstractScript.php';
require_once BASE_DIR . '/src/FilterScriptInput.php';
require_once BASE_DIR . '/src/CommandScriptInput.php';
require_once BASE_DIR . '/src/FilterScriptInput/Command.php';
require_once BASE_DIR . '/src/FilterScriptInput/Item.php';
require_once BASE_DIR . '/src/FilterScriptInput/ResponseXmlBuilder.php';

// debug
//$query = 'line1@foo.bar 123123';

// safeguard
if (empty($query)) {
    throw new \InvalidArgumentException('Missing or empty input query.');
}
