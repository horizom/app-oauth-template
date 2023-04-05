<?php

require __DIR__ . '/vendor/autoload.php';

$configs = require __DIR__ . '/config/database.php';
$default = (string) $configs['database.default'];
$connections = (array) $configs['database.connections'];
$connection = $connections[$default];

$manager = new \Illuminate\Database\Capsule\Manager();
$manager->addConnection($connection);
$manager->setAsGlobal();

// Retrieve migrations table config
$migrationsTable = (string) $configs['database.migrations_table'];

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => $configs['database.migrations_table'],
        'default_environment' => 'default',
        'default' => [
            'adapter' => $connection['driver'],
            'host' => $connection['host'],
            'port' => $connection['port'],
            'name' => $connection['database'],
            'user' => $connection['username'],
            'pass' => $connection['password'],
            'charset' => $connection['charset'],
        ]
    ],
    'version_order' => 'creation'
];
