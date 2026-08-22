<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\InsumoHerramientaController;
use App\Http\Controllers\OrdenTallerController;

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
Route::resource('insumos-herramientas', InsumoHerramientaController::class);
Route::post('/insumos-herramientas/{insumoHerramienta}/movimiento', [InsumoHerramientaController::class, 'registrarMovimiento'])->name('insumos-herramientas.movimiento');
Route::resource('ordenes-taller', OrdenTallerController::class)
    ->parameters(['ordenes-taller' => 'ordenTaller']);

});
require __DIR__.'/auth.php';
