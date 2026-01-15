<?php

use App\Http\Controllers\Admin\Events\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes - events
|--------------------------------------------------------------------------
|
| Here you can define admin routes for the event module.
|
*/
Route::prefix('admin/events')->name('admin.events.')->group(function () {
  Route::get('/', [EventController::class, 'index'])->name('index');
  Route::get('/create', [EventController::class, 'create'])->name('create');
  Route::post('/create', [EventController::class, 'store'])->name('store');
  Route::get('/{event}', [EventController::class, 'show'])->name('show');
  Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
  Route::put('/{event}', [EventController::class, 'update'])->name('update');
  Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
});