<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::resource('producto',ProductoController::class)->middleware('auth');
Route::resource('categoria',CategoriaController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [ProductoController::class, 'index'])->name('home')->middleware('auth');
