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

Route::get('/gaz_in', [App\Http\Controllers\HomeController::class, 'gaz_in'])->name('gaz_in');
Route::get('/diesel_in', [App\Http\Controllers\HomeController::class, 'diesel_in'])->name('diesel_in');
Route::get('/gaz_out', [App\Http\Controllers\HomeController::class, 'gaz_out'])->name('gaz_out');
Route::post('/gaz_del', [App\Http\Controllers\DocsController::class, 'gaz_del'])->name('gaz_del');
Route::post('/fuel_add', [App\Http\Controllers\HomeController::class, 'fuel_add'])->name('fuel_add');
Route::get('/svod_gsm', [App\Http\Controllers\DocsController::class, 'createSvodGsm'])->name('svod_gsm');
Route::get('/sprav_mons_view', [App\Http\Controllers\DocsController::class, 'sprav_mons_view'])->name('sprav_mons_view');
Route::post('/sprav_mons', [App\Http\Controllers\DocsController::class, 'sprav_mons'])->name('sprav_mons');
Route::post('/mons_plan', [App\Http\Controllers\DocsController::class, 'mons_plan'])->name('mons_plan');
Route::get('/mons_plan_view', [App\Http\Controllers\DocsController::class, 'mons_plan_view'])->name('mons_plan_view');
Route::get('/getstatus/{day}', [App\Http\Controllers\DocsController::class, 'getstatus'])->name('getstatus');
Route::get('/notes_view', [App\Http\Controllers\NotesController::class, 'notes_view'])->name('notes_view');
Route::post('/add_note', [App\Http\Controllers\NotesController::class, 'create_note'])->name('add_note');
Route::get('/notes', [App\Http\Controllers\NotesController::class, 'get_notes'])->name('notes');
