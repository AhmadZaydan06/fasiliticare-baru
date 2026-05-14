<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Rute Terproteksi (Harus Login)
Route::middleware(['auth'])->group(function () {
    
    // --- RUTE KHUSUS ADMIN ---
    Route::prefix('admin')->name('admin.')->group(function () {
        // Beranda Admin (Kartu Statistik)
        Route::get('/home', [AdminController::class, 'home'])->name('home');
        
        // Dashboard Admin (Tabel & Filter)
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Aksi Data
        Route::post('/aduan/update-status/{id}', [AdminController::class, 'updateStatus'])->name('aduan.updateStatus');
        Route::delete('/aduan/{id}', [AdminController::class, 'destroy'])->name('aduan.destroy');
    });

    // --- RUTE KHUSUS PENGHUNI (USER) ---
    Route::prefix('user')->name('user.')->group(function () {
        // Beranda Penghuni
        Route::get('/home', [UserController::class, 'home'])->name('home');
        
        // Menu Baru (Aduan Baru & Aduan Anda) -
        Route::get('/aduan/create', [UserController::class, 'create'])->name('aduan.create');
        Route::get('/aduan/list', [UserController::class, 'aduanList'])->name('aduan.list');
    });
Route::post('/user/aduan/store', [UserController::class, 'store'])->name('user.aduan.store');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/faq', [UserController::class, 'faq'])->name('user.faq');
});