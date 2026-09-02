<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Menampilkan halaman dashboard beserta riwayat absensi
    public function index()
    {
        $attendances = Attendance::latest()->get();
        return view('dashboard', compact('attendances'));
    }

    // Menyimpan data absensi (Masuk / Keluar) dengan GPS, Foto, dan Catatan
    public function store(Request $request)
    {
        $request->validate([
            'tipe'      => 'required|in:MASUK,KELUAR',
            'latitude'  => 'required',
            'longitude' => 'required',
            'foto'      => 'required',
        ]);

        $today = Carbon::today()->toDateString();
        
        // Validasi agar tidak bisa Absen Masuk 2x di hari yang sama
        if ($request->tipe === 'MASUK') {
            $alreadyCheckedIn = Attendance::where('user_id', 1)
                ->where('tanggal', $today)
                ->where('tipe', 'MASUK')
                ->exists();

            if ($alreadyCheckedIn) {
                return redirect()->back()->with('error', 'Anda sudah melakukan Absen Masuk hari ini!');
            }
        }

        $now = Carbon::now();
        $jamMasukBatas = Carbon::createFromTimeString('08:00:00');

        // Penentuan status absensi
        if ($request->tipe === 'MASUK') {
            $status = $now->gt($jamMasukBatas) ? 'Terlambat' : 'Tepat Waktu';
        } else {
            $status = 'Selesai';
        }

        // Dekode dan simpan gambar selfie dari format Base64
        $imgData = $request->foto;
        $imageParts = explode(";base64,", $imgData);
        $imageTypeAux = explode("image/", $imageParts[0]);
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        
        $fileName = 'absensi_' . time() . '.' . $imageType;
        Storage::disk('public')->put('foto_absensi/' . $fileName, $imageBase64);

        // Simpan data absensi ke database
        Attendance::create([
            'user_id'   => 1, // Default user sementara
            'tipe'      => $request->tipe,
            'tanggal'   => $now->toDateString(),
            'waktu'     => $now->toTimeString(),
            'status'    => $status,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'foto'      => 'foto_absensi/' . $fileName,
            'catatan'   => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Absensi ' . $request->tipe . ' berhasil dicatat!');
    }
}