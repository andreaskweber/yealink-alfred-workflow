<?php

// load files
require_once BASE_DIR . '/src/AbstractScript.php';
require_once BASE_DIR . '/src/FilterScriptInput.php';
require_once BASE_DIR . '/src/CommandScriptInput.php';
require_once BASE_DIR . '/src/FilterScriptInput/Item.php';
require_once BASE_DIR . '/src/FilterScriptInput/ResponseXmlBuilder.php';

// read query
$query = "{query}";

// debug
// $query = 'abc';

// safeguard
if (empty($query)) {
    throw new \InvalidArgumentException('Missing or empty input query.');
}
