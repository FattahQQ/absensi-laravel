<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ijin Tidak Hadir Masuk - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: #1e293b; }
        .card-saas { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; font-weight: 700; color: #0f172a; font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-custom { background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-danger fw-semibold" aria-current="page">Ijin Tidak Hadir</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-person-slash text-danger me-2"></i> Transaksi Pengajuan Cuti & Sakit / Ijin</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-2"><i class="bi bi-calendar-x"></i></div>
                    <span class="fw-bold">Daftar Pengajuan Cuti, Sakit, dan Ijin Absen</span>
                </div>
                <button type="button" class="btn btn-custom text-white"><i class="bi bi-plus-lg me-1"></i> Buat Pengajuan Baru</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Pegawai</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Rentang Tanggal</th>
                                <th class="py-3 text-start">Keterangan / Lampiran</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted font-mono">1</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Rafli</td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill">Sakit (Medical)</span></td>
                                <td class="font-mono small">02 Sep 2026 s/d 04 Sep 2026</td>
                                <td class="text-start text-secondary small">Lampiran Surat Dokter RSUD Terlampir.</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Disetujui</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2"><i class="bi bi-trash"></i></button>
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