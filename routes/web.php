<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\KategoriController;

// HALAMAN PUBLIK
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/cek-status', [PendaftaranController::class, 'cekStatus'])
    ->name('pendaftaran.cek');

Route::post('/cek-status', [PendaftaranController::class, 'hasilStatus'])
    ->name('pendaftaran.hasil');

// LOGIN ADMIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// DETAIL KELAS
Route::get('/kelas/{id}', [KelasController::class, 'show'])
    ->name('kelas.detail');

// PENDAFTARAN KELAS
Route::post('/kelas/{id}/daftar', [PendaftaranController::class, 'store'])
    ->name('kelas.daftar');

// HALAMAN ADMIN
Route::middleware('auth')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Kelola Kelas
    Route::get('/kelas', [AdminKelasController::class, 'index'])
        ->name('admin.kelas');

    // Kelola Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('admin.pendaftaran');
    
    Route::get('/kelas/create', [AdminKelasController::class, 'create'])
    ->name('admin.kelas.create');

    Route::put('/kelas/{id}', [AdminKelasController::class, 'update'])
    ->name('admin.kelas.update');

    Route::get('/kelas/{id}/edit', [AdminKelasController::class, 'edit'])
    ->name('admin.kelas.edit');

    Route::delete('/kelas/{id}', [AdminKelasController::class, 'destroy'])
    ->name('admin.kelas.destroy');

    Route::post('/kelas', [AdminKelasController::class, 'store'])
    ->name('admin.kelas.store');

    Route::patch('/pendaftaran/{id}/status',
    [PendaftaranController::class, 'updateStatus']
    )->name('admin.pendaftaran.updateStatus');

    // Kelola Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('admin.kategori');

    Route::get('/kategori/create', [KategoriController::class, 'create'])
        ->name('admin.kategori.create');

    Route::post('/kategori', [KategoriController::class, 'store'])
        ->name('admin.kategori.store');

    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])
        ->name('admin.kategori.edit');

    Route::put('/kategori/{id}', [KategoriController::class, 'update'])
        ->name('admin.kategori.update');

    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])
        ->name('admin.kategori.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});