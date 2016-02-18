<?php

use AndreasWeber\YealinkWorkflow\Script\MainScript;

// bootstrap application
$app = require_once __DIR__ . '/../inc/bootstrap.php';

// bootstrap script
$script = new MainScript($app);

// invoke script
$script->invoke();
