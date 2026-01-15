<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes - admin
|--------------------------------------------------------------------------
|
| Here you can define admin routes for the admin module.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware(['permission:read']);
    
    // Upload routes
    Route::post('/upload/image', [UploadController::class, 'uploadImage'])->name('upload.image');
    Route::delete('/upload/image', [UploadController::class, 'deleteImage'])->name('upload.delete');
});
