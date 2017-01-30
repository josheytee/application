<?php

require_once './vendor/autoload.php';
require './app/config/config.inc.php';
include_once './test.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;

$request = Request::createFromGlobals();
$routes = require_once './app/config/route.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new app\core\ntc\App($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);
$response->send();

