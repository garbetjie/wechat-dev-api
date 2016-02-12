<?php

use Illuminate\Database\QueryException;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

// Get the installation start page.
$app->get('/install', function () {
    $db = $this['db']->connection();
    /* @var Illuminate\Database\Connection $db */
    
    // Basic check to see whether the database is connected.
    try {
        $db->getPdo();
    } catch (InvalidArgumentException $e) {
        return $this['view']->render('install/check_details', [
            'driver' => $db->getConfig('driver'),
            'name' => $db->getConfig('database'),
            'host' => $db->getConfig('host'),
            'username' => $db->getConfig('username'),
            'password' => $db->getConfig('password'),
        ]);
    }
    
    // Database is connected. Check if there's a configuration table.
    try {
        $value = $db->query()->where('name', 'version')->first(['value']);
        if (empty($value)) {
            // db not initted. do first-timen install.
        } else {
            
        }
    } catch (QueryException $e) {
        
    }
});

$app->post('/install', function () {
    $phinx = new PhinxApplication();
    $wrapped = new TextWrapper($phinx);
});
