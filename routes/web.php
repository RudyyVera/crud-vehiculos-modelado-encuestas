<?php

use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/vehiculos');

Route::resource('vehiculos', VehiculoController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->missing(fn () => redirect()->route('vehiculos.index')->with('error', 'El registro no existe o fue eliminado'));
