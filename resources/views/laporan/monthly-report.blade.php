<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RealTime Monthly Report - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: #1e293b; }
        .card-saas { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; font-weight: 700; color: #0f172a; font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-custom { background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-success fw-semibold" aria-current="page">RealTime Monthly Report</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-file-earmark-bar-graph text-success me-2"></i> Rekapitulasi Laporan Kehadiran Bulanan</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-2"><i class="bi bi-calendar3"></i></div>
                    <span class="fw-bold">Akumulasi Absensi Periode September 2026</span>
                </div>
                <button type="button" class="btn btn-custom text-white"><i class="bi bi-file-earmark-excel me-1"></i> Export Excel / PDF</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Pegawai</th>
                                <th class="py-3">Hadir</th>
                                <th class="py-3">Terlambat</th>
                                <th class="py-3">Cuti / Sakit</th>
                                <th class="py-3">Total Kehadiran</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted font-mono">1</td>
                                <td class="text-start fw-semibold text-dark">Abdul Fattah</td>
                                <td><span class="text-success fw-bold">20 Hari</span></td>
                                <td><span class="text-warning fw-bold">1 Hari</span></td>
                                <td><span class="text-secondary fw-bold">0 Hari</span></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border px-3 py-1 rounded-pill font-mono">95%</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2" title="Detail"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">2</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Tegar Septian</td>
                                <td><span class="text-success fw-bold">19 Hari</span></td>
                                <td><span class="text-warning fw-bold">2 Hari</span></td>
                                <td><span class="text-secondary fw-bold">0 Hari</span></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border px-3 py-1 rounded-pill font-mono">90%</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2" title="Detail"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">3</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Rafli Alamsyah</td>
                                <td><span class="text-success fw-bold">18 Hari</span></td>
                                <td><span class="text-warning fw-bold">0 Hari</span></td>
                                <td><span class="text-secondary fw-bold">3 Hari</span></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border px-3 py-1 rounded-pill font-mono">85%</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2" title="Detail"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>