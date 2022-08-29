<?php

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

Route::post('/generate', [\App\Http\Controllers\QrController::class, 'QrGenerator']);
Route::get('/chat', [\App\Http\Controllers\HomeController::class, 'showChat']);
Route::get('/view-message', [\App\Http\Controllers\HomeController::class, 'viewMessage']);
