<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$modularRoutePath = __DIR__ . '/web';

if (is_dir($modularRoutePath)) {
    foreach (glob($modularRoutePath . '/*.php') as $routeFile) {
        require $routeFile;
    }
}
$modularRouteAdminPath = __DIR__ . '/admin';

if (is_dir($modularRouteAdminPath)) {
    foreach (glob($modularRouteAdminPath . '/*.php') as $routeFile) {
        require $routeFile;
    }
}
