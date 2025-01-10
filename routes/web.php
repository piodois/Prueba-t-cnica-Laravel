<?php

use App\Http\Controllers\ClienteController;

Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
