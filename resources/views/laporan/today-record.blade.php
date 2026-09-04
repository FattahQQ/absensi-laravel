<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RealTime Today Record - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bg-soft: #f4f7fb;
            --panel: #ffffff;
            --line: #e2e8f0;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --text: #0f172a;
            --muted: #64748b;
        }

        body {
            background: linear-gradient(180deg, #f5f7fb 0%, #eef4ff 100%);
            font-family: 'Inter', sans-serif;
            color: var(--text);
        }
        .page-wrapper {
            max-width: 1320px;
            margin: 0 auto;
            padding-top: 38px;
            padding-bottom: 48px;
        }
        .top-hero {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.96) 0%, rgba(30, 64, 175, 0.97) 45%, rgba(37, 99, 235, 0.88) 100%);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 26px;
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.18);
            color: #fff;
            padding: 24px 28px;
            margin-bottom: 26px;
        }
        .crumbs { color: rgba(255,255,255,0.74); font-size: 0.8rem; }
        .crumbs a { color: rgba(255,255,255,0.82); }
        .page-title { font-size: clamp(1.7rem, 2vw, 2.5rem); font-weight: 800; letter-spacing: -0.04em; margin: 10px 0 0; }
        .header-badge {
            display: inline-flex; align-items: center; gap: 8px; padding: 9px 14px; border-radius: 999px;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 700; color: #e2e8f0;
        }
        .card-saas { border: 1px solid var(--line); border-radius: 18px; background: var(--panel); box-shadow: 0 10px 28px rgba(15, 23, 42, 0.04); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 18px 22px; font-weight: 700; color: var(--text); font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: var(--muted); font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #edf2f7; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-custom { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; border: none; border-radius: 12px; font-weight: 700; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18); }
    </style>
</head>
<body>
    <div class="page-wrapper px-3">
        <div class="top-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <nav aria-label="breadcrumb" class="crumbs">
                    <ol class="breadcrumb mb-2" style="background: transparent; margin: 0; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">RealTime Today Record</li>
                    </ol>
                </nav>
                <div class="header-badge"><i class="bi bi-graph-up-arrow"></i> Live Attendance</div>
                <h3 class="page-title"><i class="bi bi-activity me-2"></i> Laporan Rekaman Kehadiran Hari Ini (RealTime)</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-light px-3 py-2 fw-semibold shadow-sm border-0 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2"><i class="bi bi-table"></i></div>
                    <span class="fw-bold">Log Absensi Live Pegawai Hari Ini</span>
                </div>
                <button type="button" class="btn btn-custom"><i class="bi bi-arrow-clockwise me-1"></i> Refresh Data</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Pegawai</th>
                                <th class="py-3">Tipe</th>
                                <th class="py-3">Jam Masuk/Keluar</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-start">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted font-mono">1</td>
                                <td class="text-start fw-semibold text-dark">Abdul Fattah</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border px-3 py-1 rounded-pill font-mono">MASUK</span></td>
                                <td class="font-mono text-dark fw-bold">07:55:12 WIB</td>
                                <td><span class="badge bg-success text-white px-3 py-1.5 rounded-pill">Tepat Waktu</span></td>
                                <td class="text-start text-secondary small">Masuk kerja tepat waktu pagi ini.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">2</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Tegar Septian</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border px-3 py-1 rounded-pill font-mono">MASUK</span></td>
                                <td class="font-mono text-dark fw-bold">08:14:30 WIB</td>
                                <td><span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill">Terlambat</span></td>
                                <td class="text-start text-secondary small">Kendaraan sempat mengalami kendala teknis.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">3</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Rafli Alamsyah</td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger border px-3 py-1 rounded-pill font-mono">IZIN</span></td>
                                <td class="font-mono text-dark fw-bold">-</td>
                                <td><span class="badge bg-info text-white px-3 py-1.5 rounded-pill">Sakit</span></td>
                                <td class="text-start text-secondary small">Melampirkan surat keterangan dokter.</td>
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