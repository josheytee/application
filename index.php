<?php

$autoloader = require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/config.inc.php';

use app\core\http\Request;

error_reporting(E_ALL);
//dump($autoloader);
$framework = new app\core\App($autoloader);
$response = $framework->handle(
        Request::capture()
);
app\core\Context::getContainer()->get('router.builder')->setRebuildNeeded();
app\core\Context::getContainer()->get('router.builder')->rebuild();
//var_dump($response);
$response->send();

include_once './test.php';
