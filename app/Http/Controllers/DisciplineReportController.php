<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Services\DisciplineService;
use Illuminate\Http\Request;

class DisciplineReportController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));

        // Ambil semua pegawai beserta data absensi pada bulan & tahun terpilih
        $users = User::with(['attendances' => function ($query) use ($selectedMonth, $selectedYear) {
            $query->whereMonth('tanggal', $selectedMonth)
                  ->whereYear('tanggal', $selectedYear);
        }])->get();

        $reports = $users->map(function ($user) {
            $totalPoints = $user->attendances->sum('discipline_points');
            $totalLate = $user->attendances->sum('late_minutes');
            $totalEarlyLeave = $user->attendances->sum('early_leave_minutes');

            // Evaluasi berdasarkan sanksi bulanan PDF Kebijakan
            $evaluation = DisciplineService::evaluateMonthlyPoints($totalPoints);

            return [
                'user' => $user,
                'total_points' => $totalPoints,
                'total_late' => $totalLate,
                'total_early_leave' => $totalEarlyLeave,
                'action_taken' => $evaluation['action_taken'],
                'incentive_penalty_pct' => $evaluation['incentive_penalty_pct'],
                'attendances' => $user->attendances,
            ];
        });

        // Agregasi statistik untuk Grafik Chart.js
        $chartData = [
            'disiplin_tinggi' => $reports->where('total_points', 0)->count(),
            'teguran_lisan'   => $reports->whereBetween('total_points', [1, 5])->count(),
            'pembinaan'       => $reports->whereBetween('total_points', [6, 10])->count(),
            'sp'              => $reports->where('total_points', '>=', 11)->count(),
        ];

        // Memanggil view laporan/evaluasi-poin.blade.php
        return view('laporan.evaluasi-poin', compact('reports', 'selectedMonth', 'selectedYear', 'chartData'));
    }
}