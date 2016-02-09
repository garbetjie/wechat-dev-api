<?php
// Include autoloader.
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Collection;
use WeChat\MockApi\Middleware\AuthTokenRequired;

// Build application.
$app = new App();

// Configure the settings.
$settings = $app[ 'settings' ];
/* @var Collection $settings */
$settings[ 'basePath' ] = __DIR__;
$settings[ 'templatePath' ] = __DIR__ . DIRECTORY_SEPARATOR . 'templates';
$settings['database'] = [
    'driver' => 'sqlite',
    'database' => $settings['basePath'] . DIRECTORY_SEPARATOR . 'db.sqlite',
];

// Load local configuration.
if (is_file(__DIR__ . DIRECTORY_SEPARATOR . 'config.local.php')) {
    require __DIR__ . DIRECTORY_SEPARATOR . 'config.local.php';
}

// Configure database connection.
$capsule = new Capsule();
$capsule->addConnection($settings['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$app['db'] = $capsule;

// Load up routes.
$iterator = new RegexIterator(
    new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./routes')),
    '/\.php$/',
    RegexIterator::MATCH
);

foreach ($iterator as $file) {
    require $file->getPathname();
}

// Add middleware.
$app->add(new AuthTokenRequired());

// Run the application.
$app->run();
