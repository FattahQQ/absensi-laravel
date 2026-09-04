<?php

use App\Http\Controllers\AdditionalAttributeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DisciplineReportController;
use App\Http\Controllers\GuardPatrolController;
use App\Http\Controllers\MasterUtamaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
    
    Route::get('/attendance', function () {
        return redirect()->route('dashboard');
    });
    
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:manager,superadmin'])->group(function () {
    Route::get('/manager/approval', [AttendanceController::class, 'approval'])->name('manager.approval');
    Route::get('/manager/report', [AttendanceController::class, 'report'])->name('manager.report');
    
    Route::get('/laporan/today-record', function () {
        return view('laporan.today-record');
    })->name('laporan.today');

    Route::get('/laporan/monthly-report', function () {
        return view('laporan.monthly-report');
    })->name('laporan.monthly');

    Route::get('/laporan/evaluasi-poin', [DisciplineReportController::class, 'index'])->name('reports.discipline');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/users', [AttendanceController::class, 'manageUsers'])->name('superadmin.users');
    
    Route::get('/master/utama', [MasterUtamaController::class, 'index'])->name('master.utama');
    Route::get('/master/utama/export', [MasterUtamaController::class, 'export'])->name('master.utama.export');
    Route::post('/master/utama/import', [MasterUtamaController::class, 'import'])->name('master.utama.import');
    Route::post('/master/utama', [MasterUtamaController::class, 'store'])->name('master.utama.store');
    Route::put('/master/utama/{id}', [MasterUtamaController::class, 'update'])->name('master.utama.update');
    Route::delete('/master/utama/{id}', [MasterUtamaController::class, 'destroy'])->name('master.utama.destroy');

    Route::get('/master/kehadiran', function () {
        return view('master.kehadiran');
    })->name('master.kehadiran');

    Route::get('/master/tambahan', [AdditionalAttributeController::class, 'index'])->name('master.tambahan');
    Route::post('/master/tambahan', [AdditionalAttributeController::class, 'store'])->name('master.tambahan.store');
    Route::put('/master/tambahan/{id}', [AdditionalAttributeController::class, 'update'])->name('master.tambahan.update');
    Route::delete('/master/tambahan/{id}', [AdditionalAttributeController::class, 'destroy'])->name('master.tambahan.destroy');

    Route::get('/master/guard-patrol', [GuardPatrolController::class, 'index'])->name('master.guard-patrol');
    Route::post('/master/guard-patrol', [GuardPatrolController::class, 'store'])->name('master.guard-patrol.store');
    Route::put('/master/guard-patrol/{id}', [GuardPatrolController::class, 'update'])->name('master.guard-patrol.update');
    Route::delete('/master/guard-patrol/{id}', [GuardPatrolController::class, 'destroy'])->name('master.guard-patrol.destroy');

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

    Route::get('/laporan/visitor-capturing', function () {
        return view('laporan.visitor-capturing');
    })->name('laporan.visitor-capturing');
});

require __DIR__.'/auth.php';