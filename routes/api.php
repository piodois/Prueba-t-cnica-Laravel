<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/clientes', [ClienteController::class, 'api']);

// Ruta de prueba
Route::get('/test', function() {
    return response()->json(['message' => 'API funcionando']);
});
