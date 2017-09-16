<?php

// Doctrine CLI configuration file
use app\core\Context;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/../app/data/init.doctrine.php';
//require_once __DIR__.'/../index.php';

try {
//    return ConsoleRunner::createHelperSet(Context::doctrine());
    return ConsoleRunner::createHelperSet(Context::getContext()->manager);
} catch (DBALException $e) {
    echo $e->getMessage();
}