<?php

require_once './vendor/autoload.php';

$kernel = new app\core\Kernel();

$request = new app\core\Request();

//$response = $kernel->handle($request->create("/hello"));
//
//$response->send();
//$content = "<html> <head></head><body>hello wold</body></html>";
//$content = json_encode($_SERVER);
//$status = 200;
//$res = new \app\core\Response($content, $status/* , ['Content-Type :application/json'] */);
//$res->send();
$page = new \app\core\Page("hello");

$page->setTemplate(new \app\core\template\BootstrapTemplate());
$component = new \app\component\Hello\Hello\Hello(new app\core\event\EventDispatcher());
$page->registerComponent($component);
$page->display();
