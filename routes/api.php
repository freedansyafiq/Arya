<?php
use App\Http\Controllers\SppgController;

Route::get('/sppgs', [SppgController::class, 'getAll']);