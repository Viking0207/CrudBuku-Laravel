<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PembeliController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController::class, 'index']);
Route::post('/buku', [BukuController::class, 'store']);
Route::get('/buku/{id}/edit', [BukuController::class, 'edit']);
Route::put('/buku/{id}', [BukuController::class, 'update']);
Route::delete('/buku/{id}', [BukuController::class, 'destroy']);

Route::get('/pembeli', [PembeliController::class, 'index']);
Route::get('/pembeli/create', [PembeliController::class, 'create']);
Route::post('/pembeli', [PembeliController::class, 'store']);
Route::get('/pembeli/{id}/edit', [PembeliController::class, 'edit']);
Route::put('/pembeli/{id}', [PembeliController::class, 'update']);
Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy']);