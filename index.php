<?php

$autoloader = require_once './vendor/autoload.php';
require './app/config/config.inc.php';
include_once './test.php';

use Symfony\Component\HttpFoundation\Request;

error_reporting(E_ALL);
$framework = new app\core\App($autoloader);
$request = Request::createFromGlobals();
$response = $framework->handle($request);
//var_dump($autoloader);
$response->send();

