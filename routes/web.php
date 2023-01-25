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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/des', [App\Http\Controllers\HomeController::class, 'des'])->name('des');
Route::post('/des/add_time', [App\Http\Controllers\HomeController::class, 'add_time'])->name('add_time');

Route::get('/doc', [App\Http\Controllers\DocsController::class, 'index'])->name('doc');
Route::get('/test', [App\Http\Controllers\DocsController::class, 'test'])->name('test');