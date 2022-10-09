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
Route::get('/vue', [\App\Http\Controllers\HomeController::class, 'vuePage']);

Route::get('image-cropper',[\App\Http\Controllers\ImageController::class, 'index'])->name('image');
Route::post('image-cropper/upload',[\App\Http\Controllers\ImageController::class, 'upload']);

Route::get('users',[\App\Http\Controllers\UserController::class, 'index']);
Route::post('users-edit',[\App\Http\Controllers\UserController::class, 'edit']);
