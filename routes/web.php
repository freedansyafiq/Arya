<?php

use App\Http\Controllers\SppgController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SppgController::class, 'map'])->name('map');
Route::get('/data', [SppgController::class, 'index'])->name('data');
Route::get('/map', [SppgController::class, 'map'])->name('map');
Route::get('/statistik', [SppgController::class, 'statistik'])->name('statistik');
Route::get('/api/sppgs', [SppgController::class, 'getAll'])->name('sppgs.all');
