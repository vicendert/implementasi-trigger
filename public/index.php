<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance Mode Check
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoload Composer
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Handle request
$response = $app->handle(Request::capture());
$response->send();

// Terminate application (middleware, etc.)
$app->terminate(Request::capture(), $response);
