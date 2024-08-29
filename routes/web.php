<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('auth.login');
});
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('producto', ProductoController::class);
    Route::resource('categoria', CategoriaController::class);
    Route::get('/producto/stock/{producto}', [ProductoController::class, 'stock'])->name('producto.stock');
    Route::patch('/producto/update-stock/{producto}', [ProductoController::class, 'updateStock'])->name('producto.updateStock');
    Route::get('/home', [ProductoController::class, 'index'])->name('home');
});
