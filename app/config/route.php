<?php

// example.com/src/app.php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/hello/{name}', array(
    'name' => null,
    '_controller' => 'app\page\admin\Index::create',
)));

return $routes;
