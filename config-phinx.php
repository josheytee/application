<?php

require 'config.php';
return [
    'paths' => [
        'migrations' => 'migrations',
        'seeds' => 'migrations/seeds',
    ],
    'migration_base_class' => '\app\migration\Migration',
    'seed_base_class' => '\app\migration\Seed',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'ntc',
        'ntc' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'port' => DB_PORT
        ]
    ]
];
