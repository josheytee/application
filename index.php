<?php

require_once './vendor/autoload.php';
require './app/config/config.inc.php';

$kernel = new app\core\Kernel();
//$kernel->installService(new \app\core\service\UserAccountService());
//$kernel->uninstallService(new \app\core\service\UserAccountService());
$request = new app\core\Request();
$page = new \app\core\Page();

$page->setTheme(new \app\core\theme\AdminBootstrapTheme());
$component = new \app\component\Hello\Hello\Hello(new app\core\event\EventDispatcher());
$register = new app\component\defaultbootstrap\Register\Register(new app\core\event\EventDispatcher());
$page->registerComponent($register);
$page->registerComponent($component);
$page->create();

class index {

}
