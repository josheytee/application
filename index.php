<?php

require_once './vendor/autoload.php';

$kernel = new app\core\Kernel();
//$kernel->installService(new \app\core\service\UserAccountService());
//$kernel->uninstallService(new \app\core\service\UserAccountService());
$request = new app\core\Request();
$page = new \app\core\Page();

$page->setTemplate(new \app\core\template\BootstrapTemplate());
$component = new \app\component\Hello\Hello(new app\core\event\EventDispatcher());
$page->registerComponent($component);
$page->create();

class index {

}
