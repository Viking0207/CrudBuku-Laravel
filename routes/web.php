<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BukuController::class, 'index']);
Route::post('/buku', [BukuController::class, 'store']);
Route::get('/buku/{id}/edit', [BukuController::class, 'edit']);
Route::put('/buku/{id}', [BukuController::class, 'update']);
Route::delete('/buku/{id}', [BukuController::class, 'destroy']);
