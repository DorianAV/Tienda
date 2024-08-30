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
    Route::get('/trashed/producto', [ProductoController::class, 'trashed'])->name('producto.trashed');
    Route::post('/trashed/producto/restore/{producto}', [ProductoController::class, 'restore'])->name('producto.restore');
    Route::delete('/trashed/producto/delete/{producto}', [ProductoController::class, 'forceDelete'])->name('producto.forceDelete');
    Route::get('/trashed/categoria', [CategoriaController::class, 'trashed'])->name('categoria.trashed');
    Route::post('/trashed/categoria/restore/{categoria}', [CategoriaController::class, 'restore'])->name('categoria.restore');
    Route::delete('/trashed/categoria/delete/{categoria}', [CategoriaController::class, 'forceDelete'])->name('categoria.forceDelete');
    Route::get('/producto/stock/{producto}', [ProductoController::class, 'stock'])->name('producto.stock');
    Route::patch('/producto/update-stock/{producto}', [ProductoController::class, 'updateStock'])->name('producto.updateStock');
    Route::get('/home', [ProductoController::class, 'index'])->name('home');
});
