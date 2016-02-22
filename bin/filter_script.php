<?php

use AndreasWeber\YealinkWorkflow\Application;
use AndreasWeber\YealinkWorkflow\Query\Query;

/** @var Application $app */
$app = require_once __DIR__ . '/../inc/bootstrap.php';

// query
$query = new Query($query);

// run
$app->filter($query);
