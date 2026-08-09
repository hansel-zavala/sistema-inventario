<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\EmpleadoController;

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

});
require __DIR__.'/auth.php';
