<?php

// example.com/src/app.php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('_', array(
    '_controller' => 'app\admin\page\Index::create',
)));
$routes->add('adminproduct', new Routing\Route('_/product/{name}', array(
    'name' => null,
    '_controller' => 'app\admin\page\Product::create',
)));
return $routes;