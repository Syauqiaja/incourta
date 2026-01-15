<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes - auth
|--------------------------------------------------------------------------
|
| Here you can define admin routes for the auth module.
|
*/

Route::prefix('admin')->middleware('guest')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
