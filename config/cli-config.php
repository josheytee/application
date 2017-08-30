<?php

// Doctrine CLI configuration file
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use app\core\Context;
use Doctrine\DBAL\DBALException;

require_once __DIR__ . '/../app/data/init.doctrine.php';
try {
    return ConsoleRunner::createHelperSet(Context::getContext()->manager);
} catch (DBALException $e) {
    echo $e->getMessage();
}