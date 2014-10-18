<?php

/**
 * The simplest of bootstraping
 */

$basePath = dirname(__FILE__);
$basePath = str_replace("public", "", $basePath);

require $basePath . "/vendor/autoload.php";
require $basePath . "/app/routes.php";
