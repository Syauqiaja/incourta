<?php

use App\Events\AdminWelcome;
use App\Models\Event;
use App\Models\Player;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $events = Event::all();
    $players = Player::all();

    return view('welcome', compact('events', 'players'));
})->name('home');

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

Route::middleware('auth')->prefix('player')->name('player.')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Player\PlayerController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [App\Http\Controllers\Player\PlayerController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\Player\PlayerController::class, 'update'])->name('profile.update');
});



Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [App\Http\Controllers\Events\EventController::class, 'index'])->name('index');
    Route::get('/{event}', [App\Http\Controllers\Events\EventController::class, 'show'])->name('show');

    Route::middleware('auth')->group(function () {
        Route::get('/{event}/register', [App\Http\Controllers\Events\EventController::class, 'register'])->name('register');
        Route::post('/{event}/register', [App\Http\Controllers\Events\EventController::class, 'register'])->name('register.store');
    });
});

Route::get('/test-reverb', function () {
    event(new AdminWelcome(Auth::id()));

    return 'Private event broadcasted';
})->middleware('auth');
