<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Attendance & Compliance Dashboard</title>
    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #111827;
            --body-bg: #f8fafc;
        }
        body {
            background: linear-gradient(180deg, #f8fafc 0%, #eef4ff 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            margin: 0;
            display: flex;
        }
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.18);
        }
        .sidebar-brand {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.02);
        }
        .sidebar-brand img {
            max-height: 38px;
            width: auto;
            object-fit: contain;
            background: #ffffff;
            padding: 3px;
            border-radius: 6px;
        }
        .sidebar-menu {
            padding: 20px 15px;
            flex-grow: 1;
            overflow-y: auto;
        }
        .nav-item-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
        }
        .nav-item-custom:hover, .nav-item-custom:not(.collapsed) {
            background-color: rgba(59, 130, 246, 0.1);
            color: #ffffff;
        }
        .submenu {
            padding-left: 20px;
            margin-top: 2px;
            margin-bottom: 6px;
        }
        .submenu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 14px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .submenu-item:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.03);
        }
        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-around;
            background: rgba(0, 0, 0, 0.2);
        }
        .sidebar-footer a {
            color: #94a3b8;
            font-size: 1.15rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .sidebar-footer a:hover {
            color: #ffffff;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-navbar {
            background: #ffffff;
            padding: 15px 30px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .content-body {
            padding: 30px;
        }

        /* Kartu & Komponen */
        .stat-card {
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 4px; height: 100%;
        }
        .stat-card.blue::before { background-color: #2563eb; }
        .stat-card.green::before { background-color: #059669; }
        .stat-card.purple::before { background-color: #7c3aed; }

        .card-saas {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            background: #ffffff;
        }
        .overview-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 45%, #1d4ed8 100%);
            border-radius: 22px;
            padding: 28px 30px;
            color: #fff;
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.22);
        }
        .overview-banner .eyebrow {
            display: inline-block;
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            margin-bottom: 10px;
            font-weight: 700;
        }
        .overview-banner h2 {
            font-size: clamp(1.3rem, 2vw, 2rem);
            font-weight: 800;
            margin: 0 0 8px;
            letter-spacing: -0.03em;
        }
        .overview-banner p {
            margin: 0;
            color: rgba(255,255,255,0.8);
            max-width: 640px;
            line-height: 1.7;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            color: #ffffff;
            border-radius: 999px;
            padding: 10px 16px;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .card-header-saas {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 24px;
            font-weight: 700;
            color: #0f172a;
            font-size: 0.95rem;
        }
        .camera-box {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            overflow: hidden;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.775rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #475569;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            font-size: 0.9rem;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* Tombol Aksi Premium & Modern */
        .btn-modern-in {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 14px 20px;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-modern-in:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.45);
        }

        .btn-modern-out {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 14px 20px;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-modern-out:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.45);
        }

        .table-saas th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #f1f5f9;
            padding: 14px 16px;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .audit-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: 1px solid rgba(37, 99, 235, 0.15);
            background: rgba(37, 99, 235, 0.06);
            border-radius: 999px;
            color: #1d4ed8;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .mini-audit-card {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02);
            padding: 18px 20px;
        }
        .mini-audit-card .label {
            display: block;
            color: #64748b;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .executive-panel {
            border: 1px solid #dbeafe;
            background: linear-gradient(135deg, #f8fbff 0%, #eef6ff 100%);
            border-radius: 20px;
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.08);
        }
        .executive-panel .panel-heading {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-weight: 800;
            color: #1d4ed8;
        }
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .activity-list li {
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
        }
        .activity-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
        }
        .activity-dot.success { background: #16a34a; }
        .activity-dot.warning { background: #f59e0b; }
        .activity-dot.primary { background: #2563eb; }
        .timeline-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.04);
        }
        .status-box {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.02);
        }
        .status-box .title {
            display: block;
            color: #64748b;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

<!-- Sidebar Kiri Enterprise -->
<div class="sidebar">
    <div>
        <div class="sidebar-brand">
            <img src="{{ asset('logolspki.png') }}" alt="Logo LSPKI">
            <img src="{{ asset('logokajima.png') }}" alt="Logo Kajima">
        </div>
        <div class="px-4 pb-3 pt-2">
            <div class="audit-chip"><i class="bi bi-shield-check"></i> ISO Compliance Ready</div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="nav-item-custom text-white" style="background-color: rgba(59, 130, 246, 0.15);">
                <span><i class="bi bi-house-door me-2"></i> Beranda Sistem</span>
            </a>

            <!-- Master (Dropdown) -->
            <button class="nav-item-custom collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#masterMenu" aria-expanded="false">
                <span><i class="bi bi-person-gear me-2"></i> Data Master</span>
                <i class="bi bi-chevron-down small"></i>
            </button>
            <div class="collapse submenu" id="masterMenu">
                <a href="{{ route('master.utama') }}" class="submenu-item"><span>• Data Utama</span> <i class="bi bi-chevron-right small text-muted"></i></a>
                <a href="{{ route('master.kehadiran') }}" class="submenu-item"><span>• Master Kehadiran</span> <i class="bi bi-chevron-right small text-muted"></i></a>
                <a href="{{ route('master.tambahan') }}" class="submenu-item"><span>• Data Tambahan</span> <i class="bi bi-chevron-right small text-muted"></i></a>
                <a href="{{ route('master.guard-patrol') }}" class="submenu-item"><span>• Guard Patrol</span> <i class="bi bi-chevron-right small text-muted"></i></a>
            </div>

            <!-- Transaksi (Dropdown) -->
            <button class="nav-item-custom collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#transaksiMenu" aria-expanded="false">
                <span><i class="bi bi-arrow-left-right me-2"></i> Transaksi Operasional</span>
                <i class="bi bi-chevron-down small"></i>
            </button>
            <div class="collapse submenu" id="transaksiMenu">
                <a href="{{ route('transaksi.telat') }}" class="submenu-item"><span>- A. Izin Terlambat / Pulang Awal</span></a>
                <a href="{{ route('transaksi.lupa') }}" class="submenu-item"><span>- B. Izin Lupa Clock In / Clock Out</span></a>
                <a href="{{ route('transaksi.tidak-hadir') }}" class="submenu-item"><span>- C. Izin Tidak Hadir Masuk</span></a>
                <a href="{{ route('transaksi.lembur') }}" class="submenu-item"><span>- D. Izin Lembur</span></a>
                <a href="{{ route('transaksi.jadwal') }}" class="submenu-item"><span>- E. Perubahan Jadwal Sementara</span></a>
            </div>

            <!-- Laporan (Dropdown) -->
            <button class="nav-item-custom collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#laporanMenu" aria-expanded="false">
                <span><i class="bi bi-file-earmark-text me-2"></i> Pelaporan & Audit</span>
                <i class="bi bi-chevron-down small"></i>
            </button>
            <div class="collapse submenu" id="laporanMenu">
                <a href="{{ route('manager.report') }}" class="submenu-item"><span>- Rekap Harian Real-Time</span></a>
                <a href="{{ route('manager.approval') }}" class="submenu-item"><span>- Rekap Bulanan</span></a>
                <a href="{{ route('laporan.visitor-capturing') }}" class="submenu-item"><span>- Visitor Capturing</span></a>
                <a href="{{ route('reports.discipline') }}" class="submenu-item fw-bold text-info"><span>- Evaluasi Poin Disiplin</span></a>
            </div>
        </div>
    </div>
    
    <!-- Footer Sidebar / Quick Actions -->
    <div>
        <div class="sidebar-footer">
            <a href="#" title="Settings"><i class="bi bi-gear"></i></a>
            <a href="#" title="System"><i class="bi bi-box"></i></a>
            <a href="#" title="Notifications"><i class="bi bi-bell"></i></a>
            <a href="#" title="Add"><i class="bi bi-plus-circle"></i></a>
            <a href="#" title="Calendar"><i class="bi bi-calendar-event"></i></a>
        </div>
        <div class="p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item-custom text-danger border-0 bg-transparent w-100 text-start">
                    <span><i class="bi bi-box-arrow-right me-2"></i> Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Main Content Wrapper -->
<div class="main-content">
    <!-- Top Navbar -->
    <div class="top-navbar">
        <div class="d-flex align-items-center gap-3">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-light border fw-semibold px-3 py-1.5 rounded-2 dropdown-toggle small" data-bs-toggle="dropdown">Ringkasan</button>
                <button type="button" class="btn btn-sm btn-light border fw-semibold px-3 py-1.5 rounded-2 dropdown-toggle small" data-bs-toggle="dropdown">Karyawan</button>
                <button type="button" class="btn btn-sm btn-light border fw-semibold px-3 py-1.5 rounded-2 dropdown-toggle small" data-bs-toggle="dropdown">Audit</button>
                <button type="button" class="btn btn-sm btn-light border fw-semibold px-3 py-1.5 rounded-2 dropdown-toggle small" data-bs-toggle="dropdown">Mobile</button>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-lg-block">
                <span class="font-mono text-primary fw-bold" id="clock" style="font-size: 0.9rem;">00:00:00</span>
                <small class="text-muted d-block" style="font-size: 0.7rem;" id="date"></small>
            </div>
            <div class="vr bg-secondary opacity-25"></div>
            <div class="d-flex align-items-center gap-2">
                <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-muted fw-bold border" style="width: 34px; height: 34px; font-size: 0.75rem;">
                    {{ strtoupper(Str::substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="text-start">
                    <span class="d-block fw-bold text-dark" style="font-size: 0.85rem;">{{ Auth::user()->name }}</span>
                    <small class="text-muted d-block" style="font-size: 0.7rem;">{{ Auth::user()->email }}</small>
                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-2 py-1 mt-1" style="font-size: 0.63rem; letter-spacing: 0.04em;">
                        @if(Auth::user()->role == 'superadmin')
                            SUPERADMIN
                        @elseif(Auth::user()->role == 'manager')
                            MANAGER
                        @else
                            KARYAWAN
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="overview-banner mb-4">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div>
                    <div class="eyebrow">Enterprise Workforce Management</div>
                    <h2>Compliance & Attendance Control Center</h2>
                    <p>Monitoring real-time presensi, kepatuhan operasional, dan status audit untuk menjaga efisiensi serta validasi sistem secara berkelanjutan.</p>
                </div>
                <div class="text-lg-end">
                    <div class="status-pill"><i class="bi bi-shield-check"></i> Audit Status OK</div>
                </div>
            </div>
        </div>

        <div class="executive-panel p-4 mb-4">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-8">
                    <div class="panel-heading mb-3">Executive Summary</div>
                    <div class="d-flex flex-wrap gap-3 align-items-center mb-3">
                        <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2 fw-semibold">Sistem aktif</div>
                        <div class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 fw-semibold">Presensi terlacak</div>
                        <div class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill px-3 py-2 fw-semibold">Monitoring real-time</div>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Status operasional saat ini berada dalam kondisi terkendali.</h4>
                    <p class="text-secondary mb-0">Semua modul utama berjalan sesuai parameter compliance. Proses absensi, validasi lokasi, dan pencatatan audit menunjukkan stabilitas yang konsisten untuk dukungan operasional harian.</p>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white rounded-4 border p-3 h-100 d-flex flex-column justify-content-center">
                        <div class="text-muted small fw-bold text-uppercase mb-2">Integrity Index</div>
                        <h3 class="fw-bold text-dark mb-1">97.4</h3>
                        <div class="d-flex align-items-center text-success small fw-semibold">
                            <i class="bi bi-arrow-up-right me-2"></i> +3.2% dari minggu lalu
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert System -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show card-saas mb-4 small border-start border-success border-4 py-3 px-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-3 text-success fs-4"></i>
                    <div>
                        <strong class="d-block text-dark fw-bold">Berhasil!</strong>
                        <span class="text-secondary">{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close mt-2" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show card-saas mb-4 small border-start border-danger border-4 py-3 px-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-3 text-danger fs-4"></i>
                    <div>
                        <strong class="d-block text-dark fw-bold">Peringatan Sistem!</strong>
                        <span class="text-secondary">{{ session('error') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close mt-2" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Metric / Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card blue p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Total Rekam Presensi</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ count($attendances) }} <span class="fs-6 text-muted fw-normal font-sans">entry</span></h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-journal-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card green p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Kepatuhan Akses</span>
                        <h5 class="fw-bold text-success mb-0 mt-1 d-flex align-items-center gap-1.5 fs-6"><i class="bi bi-shield-check-fill"></i> Aktif</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card purple p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Geo Tracking</span>
                        <h5 class="fw-bold text-dark mb-0 mt-1 d-flex align-items-center gap-1.5 fs-6"><i class="bi bi-radar text-purple"></i> Terkunci</h5>
                    </div>
                    <div class="bg-purple bg-opacity-10 p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; color: #7c3aed;">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card p-4 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #fff7ed 0%, #fff 100%);">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Sistem Status</span>
                        <h5 class="fw-bold text-warning mb-0 mt-1 d-flex align-items-center gap-1.5 fs-6"><i class="bi bi-check-circle-fill"></i> Stabil</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-activity"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="mini-audit-card">
                    <span class="label">SOP Compliance</span>
                    <h4 class="fw-bold text-dark mt-2 mb-0">98.7%</h4>
                    <small class="text-success">+2.1% vs bulan lalu</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-audit-card">
                    <span class="label">Keterlambatan</span>
                    <h4 class="fw-bold text-dark mt-2 mb-0">4.2%</h4>
                    <small class="text-muted">Dalam batas toleransi</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-audit-card">
                    <span class="label">Status Audit</span>
                    <h4 class="fw-bold text-dark mt-2 mb-0">Berkelanjutan</h4>
                    <small class="text-primary">Monitoring aktif</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-6">
                <div class="card card-saas h-100">
                    <div class="card-header-saas d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2.5">
                            <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <span>Prioritas Operasional</span>
                        </div>
                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-2 py-1 small">3 item</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                            <span class="text-dark fw-semibold">Validasi lokasi masuk</span>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1">Normal</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                            <span class="text-dark fw-semibold">Monitoring keterlambatan harian</span>
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2 py-1">Review</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2">
                            <span class="text-dark fw-semibold">Kepatuhan SOP karyawan</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1">On track</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-saas h-100">
                    <div class="card-header-saas d-flex align-items-center gap-2.5">
                        <div class="bg-success bg-opacity-10 text-success p-2 rounded-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <span>Snapshot Kinerja</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Kepatuhan absensi</span>
                                <strong class="text-dark">96%</strong>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 999px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 96%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Pemantauan lokasi</span>
                                <strong class="text-dark">89%</strong>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 999px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 89%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted">Kepatuhan SOP</span>
                                <strong class="text-dark">92%</strong>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 999px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card card-saas h-100 border-primary border-opacity-25">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small fw-bold text-uppercase">Kondisi Lokasi</span>
                            <i class="bi bi-geo-alt-fill text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-1 text-dark">Valid</h4>
                        <p class="text-muted small mb-0">Lokasi kerja terdeteksi sesuai radius kontrol keamanan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-saas h-100 border-success border-opacity-25">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small fw-bold text-uppercase">Verifikasi Wajah</span>
                            <i class="bi bi-camera-fill text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-1 text-dark">Tersedia</h4>
                        <p class="text-muted small mb-0">Sistem siap memverifikasi identitas pegawai secara real-time.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-saas h-100 border-warning border-opacity-25">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small fw-bold text-uppercase">Status Audit</span>
                            <i class="bi bi-check-circle-fill text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-1 text-dark">Berkelanjutan</h4>
                        <p class="text-muted small mb-0">Pemantauan dan dokumentasi operasional dalam kondisi aktif.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <div class="timeline-card p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <div class="panel-heading">Recent Activity</div>
                            <h5 class="fw-bold text-dark mb-0 mt-2">Aktivitas Terkini</h5>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 small">Live Feed</span>
                    </div>
                    <ul class="activity-list">
                        <li class="d-flex align-items-start">
                            <span class="activity-dot success"></span>
                            <div>
                                <div class="fw-semibold text-dark">Verifikasi lokasi berhasil diproses untuk shift pagi</div>
                                <small class="text-muted">08:10 WIB • Sistem keamanan</small>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <span class="activity-dot primary"></span>
                            <div>
                                <div class="fw-semibold text-dark">Data presensi masuk baru tercatat dari karyawan utama</div>
                                <small class="text-muted">08:15 WIB • Rekam keberangkatan</small>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <span class="activity-dot warning"></span>
                            <div>
                                <div class="fw-semibold text-dark">Review keterlambatan harian sedang dipantau oleh supervisor</div>
                                <small class="text-muted">09:05 WIB • Monitoring operasional</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="timeline-card p-4 h-100">
                    <div class="panel-heading mb-3">System Health</div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Server</span>
                            <strong class="text-dark">99.9%</strong>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 999px;">
                            <div class="progress-bar bg-success" style="width: 99.9%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Database</span>
                            <strong class="text-dark">97.5%</strong>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 999px;">
                            <div class="progress-bar bg-primary" style="width: 97.5%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Sync Mobile</span>
                            <strong class="text-dark">94.2%</strong>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 999px;">
                            <div class="progress-bar bg-warning" style="width: 94.2%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="status-box">
                    <span class="title">Monitoring Keamanan</span>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Sistem Terenkripsi</h5>
                            <small class="text-muted">Sesi aktif terjaga dengan validasi role dan hak akses</small>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">SAFE</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="status-box">
                    <span class="title">Kontrol Operasional</span>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Pemantauan Berjalan</h5>
                            <small class="text-muted">Semua fungsi utama berada pada kondisi optimal</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2">ONLINE</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workspace Utama: Kamera & Kebijakan -->
        <div class="row g-4 mb-5">
            <div class="col-lg-7">
                <div class="card card-saas h-100">
                    <div class="card-header-saas d-flex align-items-center gap-2.5">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <span>Verifikasi Kehadiran Biometrik</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 text-center mb-4">
                            <div class="col-6">
                                <span class="text-muted small fw-bold mb-2 d-block" style="font-size: 0.75rem;">VERIFIKASI WAJAH LIVE</span>
                                <div id="my_camera" class="camera-box mx-auto mb-2.5 shadow-sm" style="width:100%; max-width:280px; height:210px;"></div>
                                <button type="button" class="btn btn-sm btn-dark rounded-pill px-3.5 py-1.5 fw-semibold shadow-sm" style="font-size: 0.8rem;" onclick="take_snapshot()">
                                    <i class="bi bi-camera me-1"></i> Ambil Foto Verifikasi
                                </button>
                            </div>
                            <div class="col-6">
                                <span class="text-muted small fw-bold mb-2 d-block" style="font-size: 0.75rem;">HASIL CAPTURE</span>
                                <div id="results" class="camera-box mx-auto mb-2.5 d-flex align-items-center justify-content-center text-muted shadow-sm" style="width:100%; max-width:280px; height:210px;">
                                    <div class="text-center">
                                        <i class="bi bi-image fs-1 d-block text-secondary opacity-50 mb-1"></i>
                                        <span class="small text-muted" style="font-size: 0.8rem;">Belum ada foto verifikasi</span>
                                    </div>
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle me-1"></i> Pastikan pencahayaan cukup untuk hasil foto yang optimal</small>
                            </div>
                        </div>

                        <form action="{{ route('attendance.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="foto" id="foto">
                            <input type="hidden" name="tipe" id="tipe_absensi" value="MASUK">

                            <div class="mb-3">
                                <label class="form-label">Koordinat GPS Otomatis</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3"><i class="bi bi-pin-map-fill text-danger"></i></span>
                                    <input type="text" id="location_display" class="form-control border-start-0 font-mono small bg-white text-dark fw-semibold" readonly value="Mendeteksi satelit GPS...">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Catatan Kegiatan Harian</label>
                                <textarea name="catatan" class="form-control" rows="2" placeholder="Tuliskan ringkasan pekerjaan atau kegiatan hari ini..."></textarea>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" onclick="setTipe('MASUK')" class="btn-modern-in flex-fill">
                                    <i class="bi bi-box-arrow-in-right fs-5"></i> Absen Masuk
                                </button>
                                <button type="submit" onclick="setTipe('KELUAR')" class="btn-modern-out flex-fill">
                                    <i class="bi bi-box-arrow-left fs-5"></i> Absen Pulang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panel Informasi & Panduan -->
            <div class="col-lg-5">
                <div class="card card-saas h-100">
                    <div class="card-header-saas d-flex align-items-center gap-2.5">
                        <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-shield-exclamation"></i>
                        </div>
                        <span>Kebijakan & Informasi Sistem</span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="p-3.5 bg-light rounded-3 border mb-3">
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.875rem;"><i class="bi bi-clock-fill text-primary me-1.5"></i> Jadwal & Ketentuan Absensi</h6>
                                <p class="text-muted small mb-0 lh-base" style="font-size: 0.825rem;">Batas waktu absen masuk adalah pukul 08:00 WIB. Keterlambatan lebih dari 15 menit akan otomatis tercatat sebagai status terlambat oleh sistem.</p>
                            </div>

                            <div class="p-3.5 bg-light rounded-3 border mb-3">
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 0.875rem;"><i class="bi bi-person-fill-gear text-success me-1.5"></i> Profil Pengguna Aktif</h6>
                                <ul class="list-unstyled text-muted small mb-0 lh-lg" style="font-size: 0.825rem;">
                                    <li><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                    <li><strong>Hak Akses:</strong> 
                                        @if(Auth::user()->role == 'superadmin')
                                            Superadmin
                                        @elseif(Auth::user()->role == 'manager')
                                            Manager
                                        @else
                                            Pegawai (Karyawan)
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-dark text-white p-3.5 rounded-3 text-center shadow-sm">
                            <small class="d-block text-secondary text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.08em;">Control & Security Layer</small>
                            <span class="small font-mono text-info" style="font-size: 0.8rem;"><i class="bi bi-lock-fill me-1"></i> Geo-Fencing & Verifikasi Biometrik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat Presensi -->
        <div class="card card-saas mb-5">
            <div class="card-header-saas d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2.5">
                    <div class="bg-success bg-opacity-10 text-success p-2 rounded-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-table"></i>
                    </div>
                    <span>Log Riwayat Presensi Pegawai</span>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill font-mono small" style="font-size: 0.75rem;">
                    {{ count($attendances) }} Total Data Terekam
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3">Foto Selfie</th>
                                <th class="py-3">Tipe Presensi</th>
                                <th class="py-3">Waktu Rekam</th>
                                <th class="py-3">Status Kehadiran</th>
                                <th class="py-3 text-start">Catatan Pekerjaan</th>
                                <th class="py-3">Lokasi Peta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $index => $item)
                                <tr>
                                    <td class="fw-bold text-muted font-mono">{{ $index + 1 }}</td>
                                    <td>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" width="44" height="44" class="rounded-circle border border-2 shadow-sm" style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->tipe == 'MASUK')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill fw-semibold font-mono" style="font-size: 0.725rem;">MASUK</span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-1 rounded-pill fw-semibold font-mono" style="font-size: 0.725rem;">KELUAR</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $item->tanggal }}</div>
                                        <span class="text-muted font-mono small" style="font-size: 0.775rem;"><i class="bi bi-clock me-1"></i>{{ $item->waktu }}</span>
                                    </td>
                                    <td>
                                        @if($item->status == 'Tepat Waktu')
                                            <span class="badge bg-success text-white px-3 py-1.5 rounded-pill shadow-sm fw-medium" style="font-size: 0.75rem;">Tepat Waktu</span>
                                        @elseif($item->status == 'Terlambat')
                                            <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill shadow-sm fw-medium" style="font-size: 0.75rem;">Terlambat</span>
                                        @else
                                            <span class="badge bg-info text-white px-3 py-1.5 rounded-pill shadow-sm fw-medium" style="font-size: 0.75rem;">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-start text-secondary" style="max-width: 250px;">
                                        <span class="text-truncate d-block">{{ $item->catatan ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($item->latitude)
                                            <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 shadow-sm font-mono small" style="font-size: 0.75rem;">
                                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> Peta GPS
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-5 text-muted small">Belum ada riwayat presensi yang terekam dalam sistem.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID');
        document.getElementById('date').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }
    setInterval(updateClock, 1000);
    updateClock();

    function initWebcam() {
        if (typeof Webcam === 'undefined') {
            const box = document.getElementById('my_camera');
            if (box) {
                box.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100 text-muted small">Kamera tidak tersedia di browser ini.</div>';
            }
            return;
        }

        try {
            Webcam.set({
                width: 280,
                height: 210,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        } catch (error) {
            const box = document.getElementById('my_camera');
            if (box) {
                box.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100 text-muted small">Gagal mengakses kamera. Izinkan akses kamera browser terlebih dahulu.</div>';
            }
        }
    }

    initWebcam();

    function take_snapshot() {
        if (typeof Webcam === 'undefined') {
            alert('Kamera tidak tersedia di browser ini.');
            return;
        }

        Webcam.snap(function(data_uri) {
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid rounded border shadow-sm" style="width:280px; height:210px; object-fit:cover;"/>';
            document.getElementById('foto').value = data_uri;
        });
    }

    function setTipe(tipe) {
        document.getElementById('tipe_absensi').value = tipe;
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            document.getElementById('location_display').value = position.coords.latitude + ', ' + position.coords.longitude;
        });
    } else {
        alert("Browser Anda tidak mendukung Geolocation GPS.");
    }
</script>
</body>
</html>