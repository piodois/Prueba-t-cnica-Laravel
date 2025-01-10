<?php

use App\Http\Controllers\ClienteController;

Route::get('/clientes', [ClienteController::class, 'api']);
