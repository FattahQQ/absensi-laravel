<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Menampilkan halaman dashboard beserta riwayat absensi
    public function index()
    {
        $attendances = Attendance::latest()->get();
        return view('dashboard', compact('attendances'));
    }

    // Menyimpan data absensi (Masuk / Keluar)
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:MASUK,KELUAR',
        ]);

        $now = Carbon::now();
        $jamMasukBatas = Carbon::createFromTimeString('08:00:00');

        // Penentuan status absensi
        if ($request->tipe === 'MASUK') {
            $status = $now->gt($jamMasukBatas) ? 'Terlambat' : 'Tepat Waktu';
        } else {
            $status = 'Selesai';
        }

        Attendance::create([
            'user_id' => 1, // Default user sementara
            'tipe'    => $request->tipe,
            'tanggal' => $now->toDateString(),
            'waktu'   => $now->toTimeString(),
            'status'  => $status,
        ]);

        return redirect()->back()->with('success', 'Absensi ' . $request->tipe . ' berhasil dicatat!');
    }
}