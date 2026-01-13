<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->get('/profile', [App\Http\Controllers\Player\PlayerController::class, 'show'])->name('player.profile');