<?php

// Doctrine CLI configuration file
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use app\core\Context;

require_once __DIR__ . '/../app/data/init.doctrine.php';

return ConsoleRunner::createHelperSet(Context::getContext()->manager);
