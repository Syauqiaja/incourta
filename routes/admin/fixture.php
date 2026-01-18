<?php

use App\Http\Controllers\Admin\FixtureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes - fixture
|--------------------------------------------------------------------------
|
| Here you can define admin routes for the fixture module.
|
*/

Route::prefix('admin/event/{id}/fixture')->name('admin.event.fixture.')->group(function () {
    Route::get('/', [FixtureController::class, 'index'])->name('index')->middleware('permission:read');
    Route::post('/generate', [FixtureController::class, 'generate'])->name('generate')->middleware('permission:create');
});
