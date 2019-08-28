<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config.php';

session_start();

use Src\Router;

try {
    $router = new Router();
    require __DIR__.'/routes/routes.php';
} catch (\Exception $e) {
    exit($e->getMessage());
}
