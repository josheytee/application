<?php

// Doctrine CLI configuration file
use Doctrine\ORM\Tools\Console\ConsoleRunner;

//require_once './bootstrap.php';
require_once __DIR__ . '/../app/config/init.doctrine.php';
return ConsoleRunner::createHelperSet($entityManager);
