<?php

use AndreasWeber\YealinkWorkflow\Script\ContactScript;

// bootstrap application
$app = require_once __DIR__ . '/../inc/bootstrap.php';

// bootstrap script
$script = new ContactScript($app);

// invoke script
$script->invoke();
