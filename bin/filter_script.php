<?php

// bootstrap
$config = require_once __DIR__ . '/../inc/bootstrap.php';

// script
$script = new FilterScript($config);

/** @var string $query Input query */
$script->invoke($query);
