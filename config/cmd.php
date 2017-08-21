<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/data/init.doctrine.php';

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use app\core\Context;

$loader = new Loader();
$loader->loadFromDirectory(__DIR__ . '/../app/data/fixtures');
$purger = new ORMPurger();
$executor = new ORMExecutor(Context::getContext()->manager, $purger);
$executor->execute($loader->getFixtures());
