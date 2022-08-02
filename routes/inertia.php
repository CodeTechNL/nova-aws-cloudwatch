<?php

use Codetechnl\NovaAwsCloudwatch\Http\Controllers\InertiaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', [InertiaController::class, 'main']);
Route::get('/streams', [InertiaController::class, 'streams']);
Route::get('/stream', [InertiaController::class, 'stream']);
