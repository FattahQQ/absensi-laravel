<?php

namespace App\Services;

use Carbon\Carbon;

class DisciplineService
{
    /**
     * Hitung Poin Disiplin Harian (Sesuai Regulasi PDF LSP Kimia Industri)
     */
    public static function calculateDailyDiscipline(?string $clockIn, ?string $clockOut, string $shiftIn = '08:30:00', string $shiftOut = '17:30:00'): array
    {
        $points = 0;
        $lateMinutes = 0;
        $earlyLeaveMinutes = 0;
        $workDuration = '00:00';
        $notes = [];

        // 1. Cek Kelengkapan Absensi (Scan Masuk / Pulang)
        if (!$clockIn || !$clockOut) {
            $points += 1;
            $notes[] = 'Tidak absen masuk & pulang (1 poin)';
        }

        if ($clockIn) {
            $timeIn = Carbon::parse($clockIn);
            $scheduledIn = Carbon::parse($shiftIn);
            
            // Toleransi Keterlambatan Max 15 Menit (08:45 WIB)
            if ($timeIn->greaterThan($scheduledIn->copy()->addMinutes(15))) {
                $lateMinutes = $scheduledIn->diffInMinutes($timeIn);
                $points += 2;
                $notes[] = "Terlambat masuk ({$lateMinutes} menit)";
            }
        }

        if ($clockIn && $clockOut) {
            $timeIn = Carbon::parse($clockIn);
            $timeOut = Carbon::parse($clockOut);
            
            // Hitung Durasi Jam Kerja Real
            $durationMinutes = $timeIn->diffInMinutes($timeOut);
            $hours = floor($durationMinutes / 60);
            $minutes = $durationMinutes % 60;
            $workDuration = sprintf('%02d:%02d', $hours, $minutes);

            // Cek Jam Kerja Efektif (Minimal 8 Jam / 480 Menit)
            if ($durationMinutes < 480) {
                $points += 5;
                $notes[] = 'Kurang 8 jam kerja (5 poin)';
            }

            // Hitung Menit Pulang Cepat
            $scheduledOut = Carbon::parse($shiftOut);
            if ($timeOut->lessThan($scheduledOut)) {
                $earlyLeaveMinutes = $timeOut->diffInMinutes($scheduledOut);
            }
        }

        return [
            'work_duration' => $workDuration,
            'late_minutes' => $lateMinutes,
            'early_leave_minutes' => $earlyLeaveMinutes,
            'discipline_points' => $points,
            'notes' => implode(' + ', $notes) ?: 'Tepat Waktu',
        ];
    }

    /**
     * Hitung Evaluasi Akumulasi Poin Bulanan & Sanksi Insentif
     */
    public static function evaluateMonthlyPoints(int $totalPoints): array
    {
        if ($totalPoints >= 45) {
            return [
                'action_taken' => 'Teguran Tertulis III (Evaluasi Hubungan Kerja)',
                'incentive_penalty_pct' => 100,
            ];
        } elseif ($totalPoints >= 26) {
            return [
                'action_taken' => 'Teguran Tertulis II',
                'incentive_penalty_pct' => 60,
            ];
        } elseif ($totalPoints >= 11) {
            return [
                'action_taken' => 'Teguran Tertulis I',
                'incentive_penalty_pct' => 40,
            ];
        } elseif ($totalPoints >= 6) {
            return [
                'action_taken' => 'Pembinaan Oleh Atasan',
                'incentive_penalty_pct' => 30,
            ];
        } elseif ($totalPoints >= 1) {
            return [
                'action_taken' => 'Teguran Lisan',
                'incentive_penalty_pct' => 0,
            ];
        }

        return [
            'action_taken' => 'Tidak Ada',
            'incentive_penalty_pct' => 0,
        ];
    }
}