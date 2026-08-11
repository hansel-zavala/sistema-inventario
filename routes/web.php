<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MovimientoController;

Route::middleware(['auth'])->group(function () {

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('categorias', CategoriaController::class);
Route::resource('ubicaciones', UbicacionController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('equipos', EquipoController::class);
Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');

});
require __DIR__.'/auth.php';
