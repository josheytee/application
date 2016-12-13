<?php

require_once './vendor/autoload.php';

$kernel = new app\core\Kernel();

$request = new app\core\Request();
$page = new \app\core\Page("hello");

$page->setTemplate(new \app\core\template\BootstrapTemplate());
$component = new \app\component\Hello\Hello(new app\core\event\EventDispatcher());
$page->registerComponent($component);
$page->create();
