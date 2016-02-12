<?php
$config = [];

// Base path to the application.
$config[ 'basePath' ] = __DIR__;

// Location to where templates are stored.
$config[ 'templatePath' ] = __DIR__ . DIRECTORY_SEPARATOR . 'templates';

// Location for general storage - such as compiled views, database, etc.
$config[ 'storagePath' ] = __DIR__ . DIRECTORY_SEPARATOR . 'storage';

// Base path for webroot URLs.
$config[ 'webrootBasePath' ] = '/';

// Base path for routes.
$config[ 'routeBasePath' ] = '/';

// Database configuration details. See Laravel's illuminate/database package for configuration details.
$config[ 'database' ] = [
    'driver'   => 'sqlite',
    'database' => $config[ 'storagePath' ] . DIRECTORY_SEPARATOR . 'db.sqlite',
];

return $config;
