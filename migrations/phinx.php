<?php
// Need to extract the database configuration.
$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php';

switch ($config['database']['driver']) {
    case 'sqlite';
        $dbConfig = [
            'adapter' => 'sqlite',
            'name' => $config['database']['database'],
        ];
        break;
    
    case 'mysql':
        $dbConfig = [
            'adapter' => 'mysql',
            'host' => $config['database']['host'],
            'user' => $config['database']['username'],
            'pass' => $config['database']['password'],
            'name' => $config['database']['database'],
        ];
        break;
}

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => '_migrations',
        'default_database' => '404_database_not_found',
        'environments' => [
            'development' => $dbConfig,
        ],
    ],
];
