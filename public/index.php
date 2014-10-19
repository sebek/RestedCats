<?php

/**
 * The simplest of bootstraping
 * Using composers autoload and then we'll go directly to the routes
 */

$basePath = dirname(__FILE__);
$basePath = str_replace("public", "", $basePath);

require $basePath . "/vendor/autoload.php";
require $basePath . "/app/routes.php";
