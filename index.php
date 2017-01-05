<?php

require_once './vendor/autoload.php';
require './app/config/config.inc.php';
include_once './test.php';
//$kernel = new app\core\Kernel();
//$request = new app\core\Request();
//$page = new \app\core\Page();

$route = new app\core\Route();
//$route->add('/', function () {
//    echo 'This is home';
//});
$route->add('/application', function () {
    echo 'This is app';
});
$route->add('/', 'Index');
$route->add('/admin/', function() {
    echo 'admin is here';
});

$route->add('/admin/product', 'Product');
$route->add('/login(.*)', 'Login');
$route->add('/contact', 'Contact');
//$route->add('/shop(.*)', function ($name = '') {
//    $shop = new \beta\web\controller\ShopController($name);
//    $shop->run();
//});
////$route->add('/shop(.*)', 'shop');
//$route->add('/about-us', 'aboutus');
//$route->add('/my-account', 'myaccount');
//$route->add('/param/(.*)/(.*)', function ($x = '', $y = '') {
//    echo 'Hello from param ', $x, $y;
//});
//$route->add('/Admin', 'AdminIndex');
//$route->add('/AdminProduct(.*)', 'AdminProduct');
//echo '<pre>';
//print_r($route);
//echo '</pre>';
//$route->run();
//$page->setTheme(new \app\core\theme\AdminBootstrapTheme());
//$component = new \app\component\defaultbootstrap\EntityPack\EntityPack();
//$register = new app\component\defaultbootstrap\Register\Register();
//$page->registerComponent($register);
//$page->registerComponent($component);
//$page->create();
var_dump(app\model\Db::g());

//var_dump(app\model\Db::table('users')->where('id', '=', 1)->get());

class index {

}
