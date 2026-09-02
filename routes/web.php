<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::get('/', [AttendanceController::class, 'index'])->name('dashboard');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');