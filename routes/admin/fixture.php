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

Route::prefix('admin/fixture')->name('admin.fixture.')->group(function () {
    Route::get('/', [FixtureController::class, 'index'])->name('index');
});
