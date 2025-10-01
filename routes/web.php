<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Change Password Routes (accessible to all authenticated users)
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password.update');
    
    // Home route that redirects based on role
    Route::get('/home', function () {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('absensi.index');
        }
    })->name('home');
    
    // Admin-only absensi management routes (must be before resource routes)
    Route::middleware('admin')->group(function () {
        Route::post('/absensi/reset-auto-increment', [AbsensiController::class, 'resetAutoIncrement'])->name('absensi.reset-auto-increment');
        Route::post('/absensi/delete-all', [AbsensiController::class, 'deleteAll'])->name('absensi.delete-all');
    });
    
    // Absensi routes (accessible to both admin and employee)
    Route::resource('absensi', AbsensiController::class);
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard for admin
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
    
    // Additional Karyawan management routes (must be before resource routes)
    Route::post('/karyawan/reset-auto-increment', [KaryawanController::class, 'resetAutoIncrement'])->name('karyawan.reset-auto-increment');
    Route::post('/karyawan/delete-all', [KaryawanController::class, 'deleteAll'])->name('karyawan.delete-all');
    
    // CRUD Karyawan (admin only)
    Route::resource('karyawan', KaryawanController::class);
});
