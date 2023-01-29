<?php

use App\Http\Controllers\Tools\ServerResponseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'tools'], function () {

    // Show routes
    Route::get('/server-response', [ServerResponseController::class, 'show'])->name('tools.show.server_response');

    // Run routes
    Route::get('/run/server-response', [ServerResponseController::class, 'run'])->name('tools.run.server_response');

});
