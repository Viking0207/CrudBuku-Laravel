<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard user biasa, hanya untuk user yang sudah login dan status 'user'
Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');

// Dashboard admin, hanya untuk admin yang sudah login dan status 'admin'
Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');


Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

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