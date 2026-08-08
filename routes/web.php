<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CatalogoController;

Route::get('/', function () {
    $dbStatus = [
        'connected' => false,
        'database' => null,
        'error' => null
    ];

    try {
        DB::connection()->getPdo();
        $dbStatus['connected'] = true;
        $dbStatus['database'] = DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        $dbStatus['error'] = $e->getMessage();
    }

    return view('welcome', compact('dbStatus'));
});

Route::resource('catalogos', CatalogoController::class);

