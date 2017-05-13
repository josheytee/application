<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use app\core\Context;

$entitiesPath = array(__DIR__ . '/model');
// App configuration
$dbParams = [
    'driver' => 'pdo_mysql',
    'dbname' => 'ntc_doctrine',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
];
// Dev mode?
$dev = true;

$config = Setup::createAnnotationMetadataConfiguration($entitiesPath, $dev);

Context::getContext()->manager = EntityManager::create($dbParams, $config);
