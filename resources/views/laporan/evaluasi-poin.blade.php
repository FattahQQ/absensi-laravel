<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Evaluasi Poin Disiplin - LSP Kimia Industri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- CDN Chart.js untuk visualisasi grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg-soft: #edf3f8;
            --panel: #ffffff;
            --panel-2: #f8fafc;
            --line: #dfe7f0;
            --text: #111827;
            --muted: #5f7185;
            --primary: #1d4ed8;
            --primary-2: #0f172a;
            --success: #16a34a;
            --info: #0ea5e9;
            --warning: #f4b400;
            --danger: #ef4444;
            --shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(59,130,246,0.08), transparent 25%),
                linear-gradient(180deg, #f3f7fb 0%, #edf3f8 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text);
        }

        .page-wrapper {
            max-width: 1280px;
            margin: 0 auto;
            padding-top: 32px;
            padding-bottom: 48px;
        }

        .kpi-strip {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .kpi-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(248,250,252,1));
            border: 1px solid rgba(148,163,184,0.2);
            border-radius: 18px;
            padding: 18px 20px;
            box-shadow: 0 12px 25px rgba(15,23,42,0.05);
        }

        .kpi-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .kpi-value {
            font-size: clamp(1.4rem, 2vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.05em;
            color: #0f172a;
            line-height: 1.1;
        }

        .kpi-sub {
            font-size: 0.78rem;
            color: #475569;
            margin-top: 6px;
            font-weight: 600;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 20px;
        }

        .title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .title-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(29,78,216,0.12), rgba(14,165,233,0.12));
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: inset 0 0 0 1px rgba(29,78,216,0.08);
        }

        .page-title {
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: #0f172a;
            font-size: clamp(1.7rem, 2.2vw, 2.6rem);
        }

        .btn-back {
            border: 1px solid #dfe7f0;
            background: rgba(255,255,255,0.8);
            color: #0f172a;
            border-radius: 999px;
            padding: 0.8rem 1.2rem;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(15,23,42,0.04);
        }

        .filter-card {
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(148,163,184,0.24);
            border-radius: 20px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
            padding: 20px;
            margin-bottom: 26px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1.2fr;
            gap: 18px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
        }

        .form-select {
            width: 100%;
            height: 54px;
            border-radius: 14px;
            border: 1px solid #dfe7f0;
            background: #ffffff;
            color: var(--text);
            font-weight: 600;
            box-shadow: inset 0 1px 2px rgba(15,23,42,0.02);
        }

        .btn-primary {
            height: 54px;
            width: 100%;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 45%, #0ea5e9 100%);
            color: white;
            font-weight: 700;
            letter-spacing: -0.01em;
            box-shadow: 0 14px 30px rgba(29,78,216,0.28);
        }

        .card-saas {
            background: linear-gradient(180deg, rgba(255,255,255,0.92), rgba(248,250,252,0.96));
            border: 1px solid rgba(148,163,184,0.2);
            border-radius: 20px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
        }

        .panel {
            padding: 22px 22px 18px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .mini-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 1rem;
        }

        .mini-icon.primary { background: rgba(29,78,216,0.1); color: var(--primary); }
        .mini-icon.info { background: rgba(14,165,233,0.1); color: var(--info); }

        .panel-title {
            font-size: 1.02rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text);
            margin: 0;
        }

        .chart-shell {
            height: 270px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px 0 0;
        }

        .legend-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #334155;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .table-wrap {
            margin-top: 26px;
        }

        .table-saas {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-saas thead th {
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
            color: #4b5d72;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.7rem;
            padding: 16px 18px;
            border-bottom: 1px solid #e2e8f0;
            text-align: center;
        }

        .table-saas thead th:first-child {
            border-radius: 18px 0 0 0;
        }

        .table-saas thead th:last-child {
            border-radius: 0 18px 0 0;
        }

        .table-saas tbody td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf2f7;
            color: #1e293b;
            font-size: 0.95rem;
            background: rgba(255,255,255,0.4);
        }

        .table-saas tbody tr:hover td {
            background: rgba(248,250,252,0.9);
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            border-radius: 999px;
            padding: 0.5rem 0.82rem;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .muted-label {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--muted);
        }

        @media (max-width: 991px) {
            .filter-grid, .kpi-strip {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper py-5 px-3">
        <!-- Top Header -->
        <div class="topbar">
            <div class="title-wrap">
                <div class="title-icon"><i class="bi bi-file-earmark-bar-graph"></i></div>
                <div>
                    <nav aria-label="breadcrumb" class="mb-1">
                        <ol class="breadcrumb mb-1" style="margin:0; font-size:0.82rem;">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Laporan Poin Disiplin</li>
                        </ol>
                    </nav>
                    <h1 class="page-title">Rekapitulasi &amp; Evaluasi Poin Disiplin</h1>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Filter Month & Year -->
        <div class="filter-card">
            <form method="GET" action="{{ route('reports.discipline') }}" class="filter-grid align-items-end">
                <div>
                    <label class="field-label">Pilih Bulan</label>
                    <select name="month" class="form-select">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $selectedMonth == sprintf('%02d', $m) ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label">Pilih Tahun</label>
                    <select name="year" class="form-select font-mono">
                        @foreach(range(date('Y')-2, date('Y')+1) as $y)
                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-filter me-1"></i> Tampilkan Laporan</button>
                </div>
            </form>
        </div>

        <div class="kpi-strip">
            <div class="kpi-card">
                <div class="kpi-label">Total pegawai</div>
                <div class="kpi-value">{{ count($reports) }}</div>
                <div class="kpi-sub">Data aktif bulan ini</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Rata-rata telat</div>
                <div class="kpi-value">{{ $reports && $reports->isNotEmpty() ? round($reports->sum(fn ($item) => (int) ($item['total_late'] ?? 0)) / $reports->count(), 0) : 0 }}<span style="font-size:0.9rem; color:#64748b; margin-left:8px;">mnt</span></div>
                <div class="kpi-sub">Durasi keterlambatan</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Potensi insentif</div>
                <div class="kpi-value">{{ $reports && $reports->isNotEmpty() ? max(0, 100 - round($reports->sum(fn ($item) => (int) ($item['incentive_penalty_pct'] ?? 0)) / $reports->count(), 0)) : 100 }}<span style="font-size:0.9rem; color:#64748b; margin-left:8px;">%</span></div>
                <div class="kpi-sub">Rata-rata realisasi</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Status tertinggi</div>
                <div class="kpi-value">{{ $chartData['sp'] >= $chartData['pembinaan'] ? 'SP' : 'Teguran' }}</div>
                <div class="kpi-sub">Dominasi kategori</div>
            </div>
        </div>

        <!-- Section Visualisasi Grafik & Legend Sanksi -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card card-saas panel h-100">
                    <div class="panel-header">
                        <div class="mini-icon primary"><i class="bi bi-pie-chart-fill"></i></div>
                        <h6 class="panel-title">Distribusi Status Kedisiplinan Karyawan</h6>
                    </div>
                    <div class="chart-shell">
                        <canvas id="disciplineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-saas panel h-100">
                    <div class="panel-header">
                        <div class="mini-icon info"><i class="bi bi-info-circle-fill"></i></div>
                        <h6 class="panel-title">Ambang Sanksi</h6>
                    </div>
                    <ul class="legend-list">
                        <li class="legend-item"><span class="legend-dot" style="background:#16a34a;"></span> <span class="badge-pill" style="background:rgba(22,163,74,0.12); color:#15803d;">0 Poin</span> <span>Disiplin Sempurna</span></li>
                        <li class="legend-item"><span class="legend-dot" style="background:#0ea5e9;"></span> <span class="badge-pill" style="background:rgba(14,165,233,0.12); color:#0369a1;">1-5 Poin</span> <span>Teguran Lisan (0%)</span></li>
                        <li class="legend-item"><span class="legend-dot" style="background:#f4b400;"></span> <span class="badge-pill" style="background:rgba(244,180,0,0.12); color:#a16207;">6-10 Poin</span> <span>Pembinaan Atasan (-30%)</span></li>
                        <li class="legend-item"><span class="legend-dot" style="background:#ef4444;"></span> <span class="badge-pill" style="background:rgba(239,68,68,0.12); color:#b91c1c;">11-25 Poin</span> <span>SP I (-40%)</span></li>
                        <li class="legend-item"><span class="legend-dot" style="background:#111827;"></span> <span class="badge-pill" style="background:rgba(17,24,39,0.12); color:#111827;">≥26 Poin</span> <span>SP II &amp; III (-60% s.d -100%)</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Report Table Container -->
        <div class="card card-saas table-wrap">
            <div class="table-responsive">
                <table class="table-saas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-start">Nama Pegawai</th>
                            <th>Terlambat (Menit)</th>
                            <th>Pulang Cepat (Menit)</th>
                            <th>Poin Disiplin</th>
                            <th>Tindak Disiplin</th>
                            <th>Potongan Insentif (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $index => $item)
                            <tr>
                                <td class="font-mono text-muted">{{ $index + 1 }}</td>
                                <td class="text-start fw-semibold text-dark">{{ $item['user']->name }}</td>
                                <td class="font-mono">{{ $item['total_late'] }} mnt</td>
                                <td class="font-mono">{{ $item['total_early_leave'] }} mnt</td>
                                <td>
                                    <span class="badge-pill font-mono {{ $item['total_points'] > 25 ? 'bg-dark text-white' : ($item['total_points'] > 10 ? 'bg-danger text-white' : ($item['total_points'] > 5 ? 'bg-warning text-dark' : ($item['total_points'] > 0 ? 'bg-info text-dark' : 'bg-success text-white'))) }}">
                                        {{ $item['total_points'] }} Poin
                                    </span>
                                </td>
                                <td><span class="badge bg-light text-dark border px-2.5 py-1 rounded-2">{{ $item['action_taken'] }}</span></td>
                                <td>
                                    @if($item['incentive_penalty_pct'] > 0)
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-2.5 py-1 font-mono rounded-2">
                                            -{{ $item['incentive_penalty_pct'] }}%
                                        </span>
                                    @else
                                        <span class="text-muted small font-mono">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-muted">Belum ada data absensi untuk periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script Rendering Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('disciplineChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Sempurna (0 Poin)', 'Teguran Lisan (1-5 Poin)', 'Pembinaan (6-10 Poin)', 'Kena SP (≥11 Poin)'],
                    datasets: [{
                        data: [
                            {{ $chartData['disiplin_tinggi'] ?? 0 }},
                            {{ $chartData['teguran_lisan'] ?? 0 }},
                            {{ $chartData['pembinaan'] ?? 0 }},
                            {{ $chartData['sp'] ?? 0 }}
                        ],
                        backgroundColor: ['#16a34a', '#0284c7', '#d97706', '#dc2626']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '58%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                boxWidth: 10,
                                boxHeight: 10,
                                padding: 16,
                                color: '#334155',
                                font: {
                                    family: 'Inter',
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>