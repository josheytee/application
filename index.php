<?php

$autoloader = require_once './vendor/autoload.php';
require './app/config/config.inc.php';
include_once './test.php';

use app\core\http\Request;

error_reporting(E_ALL);
$framework = new app\core\App($autoloader);
$response = $framework->handle(
        Request::capture()
);
//var_dump($response);
//app\core\Context::getContainer()->get('router.builder')->setRebuildNeeded();
//app\core\Context::getContainer()->get('router.builder')->rebuild();
$response->send();
