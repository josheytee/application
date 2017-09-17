<?php

// example.com/src/app.php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/', array(
    '_controller' => 'app\front\page\Index::create',
)));
$routes->add('admin.index', new Routing\Route('_', array(
    '_controller' => 'app\admin\page\Index::create',
)));
$routes->add('admin.product', new Routing\Route('_/product/{name}', array(
    'name' => 'null',
    '_controller' => 'app\admin\page\Product::create',
)));
return $routes;
