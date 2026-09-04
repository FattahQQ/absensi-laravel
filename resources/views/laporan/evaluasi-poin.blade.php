<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Evaluasi Poin Disiplin - LSP Kimia Industri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { background-color: #f1f5f9; font-family: 'Inter', sans-serif; color: #1e293b; }
        .page-wrapper { max-width: 1320px; margin: 0 auto; }
        .card-saas { border: none; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05); }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; padding: 12px 14px; }
    </style>
</head>
<body>
    <div class="page-wrapper py-5 px-3">
        <!-- Top Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Laporan Poin Disiplin</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-bar-graph text-primary me-2"></i> Rekapitulasi & Evaluasi Poin Disiplin</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold bg-white">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Filter Month & Year -->
        <div class="card card-saas p-3 mb-4">
            <form method="GET" action="{{ route('reports.discipline') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Pilih Bulan</label>
                    <select name="month" class="form-select">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $selectedMonth == sprintf('%02d', $m) ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Pilih Tahun</label>
                    <select name="year" class="form-select font-mono">
                        @foreach(range(date('Y')-2, date('Y')+1) as $y)
                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-semibold"><i class="bi bi-filter me-1"></i> Tampilkan Laporan</button>
                </div>
            </form>
        </div>

        <!-- Report Table Container -->
        <div class="card card-saas">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
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
                                        <span class="badge {{ $item['total_points'] > 5 ? 'bg-danger' : ($item['total_points'] > 0 ? 'bg-warning text-dark' : 'bg-success') }} font-mono px-3 py-1.5 rounded-2">
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
    </div>
</body>
</html>