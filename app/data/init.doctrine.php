<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use app\core\Context;
use Doctrine\DBAL\Types\Type;

$entitiesPath = array(__DIR__ . '/../core/entity/prototype');
// App configuration
$dbParams = [
    'driver' => 'pdo_mysql',
    'dbname' => 'ntc_yml',
    'host' => 'localhost',
    'user' => 'root',
    'password' => 1234567,
];
// Dev mode?
$dev = true;

$config = Setup::createYAMLMetadataConfiguration($entitiesPath, $dev);

Context::getContext()->manager = EntityManager::create($dbParams, $config);
$connection = Context::getContext()->manager->getConnection();
Type::addType('product_type', 'app\core\entity\types\ProductType');
Type::addType('product_condition', 'app\core\entity\types\ProductCondition');
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_type', 'product_type');
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_condition', 'product_condition');

