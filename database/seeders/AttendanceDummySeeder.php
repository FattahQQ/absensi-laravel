<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AttendanceDummySeeder extends Seeder
{
    public function run(): void
    {
        // Daftar nama acak untuk simulasi 100 karyawan
        $firstNames = ['Budi', 'Siti', 'Ahmad', 'Dewi', 'Joko', 'Rina', 'Eko', 'Sari', 'Agus', 'Wati', 'Doni', 'Lilis', 'Ferry', 'Anisa', 'Rian'];
        $lastNames = ['Santoso', 'Rahayu', 'Saputra', 'Lestari', 'Hidayat', 'Kusuma', 'Pratama', 'Wulandari', 'Setiawan', 'Ningsih'];

        // Buat 100 akun karyawan dummy jika belum ada
        for ($i = 1; $i <= 100; $i++) {
            $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)] . ' ' . $i;
            $email = 'karyawan' . $i . '@lspkimia.com';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password123'),
                    'role' => 'karyawan'
                ]
            );

            // Simulasi absensi acak selama 20 hari kerja di bulan Agustus 2026
            $startDate = Carbon::create(2026, 8, 1);
            for ($day = 0; $day < 20; $day++) {
                $currentDate = $startDate->copy()->addDays($day);
                
                // Lewati akhir pekan (Sabtu/Minggu)
                if ($currentDate->isWeekend()) {
                    continue;
                }

                // Acak status kedatangan karyawan dengan variasi pelanggaran
                $randomCondition = rand(1, 100);
                
                if ($randomCondition <= 50) {
                    // 50% Tepat Waktu (0 poin)
                    $time = '08:15:00';
                    $status = 'Tepat Waktu';
                    $lateMinutes = 0;
                    $points = 0;
                    $note = 'Tepat Waktu';
                } elseif ($randomCondition <= 80) {
                    // 30% Terlambat (>15 menit, kena 2 poin)
                    $time = '09:10:00';
                    $status = 'Terlambat';
                    $lateMinutes = 40;
                    $points = 2; 
                    $note = 'Terlambat masuk kerja (>15 menit)';
                } elseif ($randomCondition <= 95) {
                    // 15% Tidak memenuhi 8 jam kerja (5 poin)[cite: 1]
                    $time = '08:20:00';
                    $status = 'Pulang Cepat / Kurang Jam';
                    $lateMinutes = 0;
                    $points = 5;
                    $note = 'Tidak memenuhi 8 jam kerja tanpa izin';
                } else {
                    // 5% Alpha / Tanpa Keterangan (10 poin)[cite: 1]
                    // Untuk kasus alpha, kita buat record dengan poin 10 atau lewati tapi catat
                    $time = '00:00:00';
                    $status = 'Alpha';
                    $lateMinutes = 0;
                    $points = 10;
                    $note = 'Alpha (tidak hadir tanpa keterangan)';
                }

                Attendance::create([
                    'user_id' => $user->id,
                    'tipe' => 'MASUK',
                    'tanggal' => $currentDate->toDateString(),
                    'waktu' => $time,
                    'status' => $status,
                    'latitude' => '-6.5950',
                    'longitude' => '106.8166',
                    'foto' => 'foto_absensi/dummy.jpg',
                    'catatan' => $note,
                    'late_minutes' => $lateMinutes,
                    'discipline_points' => $points,
                    'violation_note' => $note,
                ]);
            }
        }
    }
}