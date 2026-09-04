<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MasterUtamaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama langsung ke dashboard absensi (Wajib Login)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Rute Umum yang bisa diakses semua role yang sudah login & terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
    
    // Mencegah error MethodNotAllowed jika URL /attendance diakses via GET
    Route::get('/attendance', function () {
        return redirect()->route('dashboard');
    });
    
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Khusus Manajerial & Superadmin (Approval & Laporan Kehadiran Tim)
Route::middleware(['auth', 'verified', 'role:manager,superadmin'])->group(function () {
    Route::get('/manager/approval', [AttendanceController::class, 'approval'])->name('manager.approval');
    Route::get('/manager/report', [AttendanceController::class, 'report'])->name('manager.report');
    
    // Rute Laporan RealTime Hari Ini & Bulanan
    Route::get('/laporan/today-record', function () {
        return view('laporan.today-record');
    })->name('laporan.today');

    Route::get('/laporan/monthly-report', function () {
        return view('laporan.monthly-report');
    })->name('laporan.monthly');
});

// Rute Khusus Superadmin (Kelola Data Master Karyawan, Menu Master, Transaksi & Laporan)
Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/users', [AttendanceController::class, 'manageUsers'])->name('superadmin.users');
    
    // Rute Lengkap Menu Master (Master Utama dihubungkan ke MasterUtamaController)
    Route::get('/master/utama', [MasterUtamaController::class, 'index'])->name('master.utama');
    Route::get('/master/utama/export', [MasterUtamaController::class, 'export'])->name('master.utama.export');
    Route::post('/master/utama', [MasterUtamaController::class, 'store'])->name('master.utama.store');
    Route::put('/master/utama/{id}', [MasterUtamaController::class, 'update'])->name('master.utama.update');
    Route::delete('/master/utama/{id}', [MasterUtamaController::class, 'destroy'])->name('master.utama.destroy');

    Route::get('/master/kehadiran', function () {
        return view('master.kehadiran');
    })->name('master.kehadiran');

    Route::get('/master/tambahan', function () {
        return view('master.tambahan');
    })->name('master.tambahan');

    Route::get('/master/guard-patrol', function () {
        return view('master.guard-patrol');
    })->name('master.guard-patrol');

    // Rute Lengkap Menu Transaksi
    Route::get('/transaksi/telat-pulang-awal', function () {
        return view('transaksi.telat-pulang-awal');
    })->name('transaksi.telat');

    Route::get('/transaksi/lupa-clock', function () {
        return view('transaksi.lupa-clock');
    })->name('transaksi.lupa');

    Route::get('/transaksi/tidak-hadir', function () {
        return view('transaksi.tidak-hadir');
    })->name('transaksi.tidak-hadir');

    Route::get('/transaksi/lembur', function () {
        return view('transaksi.lembur');
    })->name('transaksi.lembur');

    Route::get('/transaksi/jadwal-sementara', function () {
        return view('transaksi.jadwal-sementara');
    })->name('transaksi.jadwal');

    // Rute Tambahan Laporan Visitor Capturing
    Route::get('/laporan/visitor-capturing', function () {
        return view('laporan.visitor-capturing');
    })->name('laporan.visitor-capturing');
});

require __DIR__.'/auth.php';