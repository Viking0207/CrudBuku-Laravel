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
Route::get('/admin/buku', [BukuController::class, 'admin']);
Route::post('/admin/buku', [BukuController::class, 'store']);
Route::get('/admin/buku/{id}/edit', [BukuController::class, 'edit']);
Route::put('/admin/buku/{id}', [BukuController::class, 'update']);
Route::delete('/admin/buku/{id}', [BukuController::class, 'destroy']);

Route::get('/pembeli', [PembeliController::class, 'index']);
Route::get('/pembeli/create', [PembeliController::class, 'create']);
Route::post('/pembeli', [PembeliController::class, 'store']);
Route::get('/pembeli/{id}/edit', [PembeliController::class, 'edit']);
Route::put('/pembeli/{id}', [PembeliController::class, 'update']);
Route::delete('/pembeli/{id}', [PembeliController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index'])->name('admin.userdata.index');    
Route::get('/users/create', [UserController::class, 'create'])->name('admin.userdata.create');
Route::post('/users', [UserController::class, 'store'])->name('admin.userdata.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.userdata.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.userdata.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.userdata.destroy');