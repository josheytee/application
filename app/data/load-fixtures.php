<?php

//require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../config/init.doctrine.php';

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

$loader = new Loader();

$loader->loadFromDirectory(__DIR__ . '/fixtures');
$purger = new ORMPurger();
$executor = new ORMExecutor($entityManager, $purger);
$executor->execute($loader->getFixtures());
