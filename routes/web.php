<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama langsung ke dashboard absensi (Wajib Login)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rute Umum yang bisa diakses semua role yang sudah login & terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Khusus Manajerial & Superadmin (Approval & Laporan Kehadiran Tim)
Route::middleware(['auth', 'verified', 'role:manager,superadmin'])->group(function () {
    Route::get('/manager/approval', [AttendanceController::class, 'approval'])->name('manager.approval');
    Route::get('/manager/report', [AttendanceController::class, 'report'])->name('manager.report');
});

// Rute Khusus Superadmin (Kelola Data Master Karyawan / Pengaturan Sistem)
Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/users', [AttendanceController::class, 'manageUsers'])->name('superadmin.users');
});

require __DIR__.'/auth.php';