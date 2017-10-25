<?php

use app\core\Context;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

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
// general ORM configuration
$config = new Doctrine\ORM\Configuration();
$config->setProxyDir(sys_get_temp_dir());
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
//$config->setMetadataDriverImpl($driverChain);
//// use our allready initialized cache driver
//$config->setMetadataCacheImpl($cache);
//$config->setQueryCacheImpl($cache);

// Third, create event manager and hook prefered extension listeners
$evm = new Doctrine\Common\EventManager();
// gedmo extension listeners


// tree
$treeListener = new Gedmo\Tree\TreeListener();
//$treeListener->setAnnotationReader($cachedAnnotationReader);
$evm->addEventSubscriber($treeListener);

$config = Setup::createYAMLMetadataConfiguration($entitiesPath, $dev);

Context::getContext()->manager = EntityManager::create($dbParams, $config,$evm);
$connection = Context::getContext()->manager->getConnection();
Type::addType('product_type', 'app\core\entity\types\ProductType');
Type::addType('product_condition', 'app\core\entity\types\ProductCondition');
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_type', 'product_type');
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('product_condition', 'product_condition');

