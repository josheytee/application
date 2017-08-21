<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use app\core\Context;

$entitiesPath = array(__DIR__ . '/../core/entity/prototype');
// App configuration
$dbParams = [
    'driver' => 'pdo_mysql',
    'dbname' => 'ntc_yml',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
];
// Dev mode?
$dev = true;

$config = Setup::createYAMLMetadataConfiguration($entitiesPath, $dev);

Context::getContext()->manager = EntityManager::create($dbParams, $config);
