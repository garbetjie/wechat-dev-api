<?php
// Include autoloader.
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\App;
use Slim\Collection;
use WeChat\MockApi\Middleware\AuthTokenRequired;
use WeChat\MockApi\View;

// Build application.
$app = new App();
$container = $app->getContainer();

// Configure the settings.
$settings = $container->get('settings');
/* @var Collection $settings */

// Load default configuration.
$settings->replace(require __DIR__ . DIRECTORY_SEPARATOR . 'config.php');

// Load local configuration, if supplied. Supports either returning configuration, or the settings can be manipulated
// via the $settings collection directly.
if (is_file(__DIR__ . DIRECTORY_SEPARATOR . 'config.local.php')) {
    call_user_func(function () use (&$settings) {
        $config = require __DIR__ . DIRECTORY_SEPARATOR . 'config.local.php';
        if (is_array($config)) {
            $settings->replace($config);
        }
    });
}

// Configure database connection.
$capsule = new Capsule();
$capsule->addConnection($settings[ 'database' ]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container[ 'db' ] = $capsule;

// Load up templating.
$container[ 'view' ] = new View($container);

// Load up routes.
$iterator = new RegexIterator(
    new RecursiveIteratorIterator(new RecursiveDirectoryIterator('./routes')),
    '/\.php$/',
    RegexIterator::MATCH
);

foreach ($iterator as $file) {
    call_user_func(function () use (&$app, $file) {
        require $file->getPathname();
    });
}

// Add middleware.
$app->add(new AuthTokenRequired());

// Run the application.
$app->run();
