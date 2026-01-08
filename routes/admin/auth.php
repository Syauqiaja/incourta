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

Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});
