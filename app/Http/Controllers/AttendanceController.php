<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
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

    // Menyimpan data absensi (Masuk / Keluar) dengan GPS, Foto, dan Hitung Poin Disiplin
    public function store(Request $request)
    {
        $request->validate([
            'tipe'      => 'required|in:MASUK,KELUAR',
            'latitude'  => 'required',
            'longitude' => 'required',
            'foto'      => 'required',
        ]);

        $now = Carbon::now();
        $today = $now->toDateString();
        $userId = auth()->id() ?? 1; // Menggunakan ID user yang sedang login, fallback ke 1 jika belum
        
        // Validasi agar tidak bisa Absen Masuk 2x di hari yang sama
        if ($request->tipe === 'MASUK') {
            $alreadyCheckedIn = Attendance::where('user_id', $userId)
                ->where('tanggal', $today)
                ->where('tipe', 'MASUK')
                ->exists();

            if ($alreadyCheckedIn) {
                return redirect()->back()->with('error', 'Anda sudah melakukan Absen Masuk hari ini!');
            }
        }

        // Aturan jam masuk standar (08.30) dengan toleransi 15 menit (batas 08.45)
        $standardStart = '08:30:00';
        $lateLimit = '08:45:00';
        $currentTime = $now->format('H:i:s');
        
        $lateMinutes = 0;
        $disciplinePoints = 0;
        $violationNote = null;

        // Penentuan status dan perhitungan poin jika MASUK
        if ($request->tipe === 'MASUK') {
            if ($currentTime > $lateLimit) {
                $status = 'Terlambat';
                // Hitung selisih menit keterlambatan dari jam 08:30:00
                $lateMinutes = Carbon::parse($standardStart)->diffInMinutes($now);
                $disciplinePoints = 2; // Terlambat masuk kerja = 2 poin
                $violationNote = 'Terlambat masuk kerja (>15 menit)';
            } else {
                $status = 'Tepat Waktu';
                $violationNote = 'Tepat Waktu';
            }
        } else {
            $status = 'Selesai';
            $violationNote = 'Absen Pulang';
        }

        // Dekode dan simpan gambar selfie dari format Base64
        $imgData = $request->foto;
        $imageParts = explode(";base64,", $imgData);
        $imageTypeAux = explode("image/", $imageParts[0]);
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        
        $fileName = 'absensi_' . time() . '.' . $imageType;
        Storage::disk('public')->put('foto_absensi/' . $fileName, $imageBase64);

        // Simpan data absensi beserta parameter disiplin ke database
        Attendance::create([
            'user_id'           => $userId,
            'tipe'              => $request->tipe,
            'tanggal'           => $today,
            'waktu'             => $currentTime,
            'status'            => $status,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'foto'              => 'foto_absensi/' . $fileName,
            'catatan'           => $request->catatan,
            'late_minutes'      => $lateMinutes,
            'discipline_points' => $disciplinePoints,
            'violation_note'    => $violationNote,
        ]);

        return redirect()->back()->with('success', 'Absensi ' . $request->tipe . ' berhasil dicatat!');
    }

    // Fungsi untuk Rekapitulasi & Evaluasi Poin Disiplin Bulanan (Akses Manajer / Superadmin)
    public function approval(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Ambil data rekap absensi dan total poin per user pada bulan tersebut
        $rekapAbsensi = Attendance::with('user')
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->selectRaw('user_id, SUM(discipline_points) as total_points, COUNT(*) as total_hadir')
            ->groupBy('user_id')
            ->get();

        // Evaluasi sanksi & potongan insentif berdasarkan total poin
        $evaluasiKaryawan = $rekapAbsensi->map(function ($item) {
            $points = $item->total_points;
            
            if ($points >= 45) {
                $tindakan = 'Teguran Tertulis III (Evaluasi hubungan kerja)';
                $potonganInsentif = '100%';
            } elseif ($points >= 26) {
                $tindakan = 'Teguran Tertulis II';
                $potonganInsentif = '60%';
            } elseif ($points >= 11) {
                $tindakan = 'Teguran Tertulis I';
                $potonganInsentif = '40%';
            } elseif ($points >= 6) {
                $tindakan = 'Pembinaan oleh atasan';
                $potonganInsentif = '30%';
            } elseif ($points >= 1) {
                $tindakan = 'Teguran lisan';
                $potonganInsentif = '0% (NA)';
            } else {
                $tindakan = 'Tepat Waktu / Disiplin';
                $potonganInsentif = '0%';
            }

            $item->tindakan = $tindakan;
            $item->potongan_insentif = $potonganInsentif;
            return $item;
        });

        return view('manager.approval', compact('evaluasiKaryawan', 'month', 'year'));
    }

    // Fungsi untuk Menampilkan Rekapitulasi Matriks Absensi (RealTime Today Record / Report)
    public function report(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(7)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        
        // Ambil data user beserta relasi absensinya berdasarkan range tanggal
        $users = User::with(['attendances' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }])->get();

        // Diperbaiki menjadi manajer.report sesuai struktur folder view kamu
        return view('manajer.report', compact('users', 'startDate', 'endDate'));
    }
}