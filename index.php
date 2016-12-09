<?php

require_once './vendor/autoload.php';
$kernel = new app\core\Kernel();

var_dump($_SERVER);
//$request = Request::createFromGlobals();
//$response = $kernel->handle($request);
//$response->send();

$c = new app\core\Component();
$c->render();
