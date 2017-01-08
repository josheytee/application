<?php

require 'config.php';
return [
    'paths' => [
        'migrations' => 'app/model/migrations',
        'seeds' => 'app/model/seeds',
    ],
    'migration_base_class' => 'app\core\database\Migration',
    'seed_base_class' => 'app\core\database\Seeder',
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
