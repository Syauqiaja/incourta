<?php

use App\Events\AdminWelcome;
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

Route::middleware('auth')->get('/profile', [App\Http\Controllers\Player\PlayerController::class, 'show'])->name('player.profile');

Route::middleware('auth')->prefix('events')->name('events.')->group(function () {
    Route::get('/', [App\Http\Controllers\Events\EventController::class, 'index'])->name('index');

    Route::get('/create', [App\Http\Controllers\Events\EventController::class, 'create'])->name('create');
    Route::post('/create', [App\Http\Controllers\Events\EventController::class, 'store'])->name('store');

    Route::get('/{event}', [App\Http\Controllers\Events\EventController::class, 'show'])->name('show');
    Route::get('/{event}/edit', [App\Http\Controllers\Events\EventController::class, 'edit'])->name('edit');
    Route::put('/{event}', [App\Http\Controllers\Events\EventController::class, 'update'])->name('update');
    Route::delete('/{event}', [App\Http\Controllers\Events\EventController::class, 'destroy'])->name('destroy');
});

Route::get('/test-reverb', function () {
    event(new AdminWelcome(Auth::id()));

    return 'Private event broadcasted';
})->middleware('auth');
