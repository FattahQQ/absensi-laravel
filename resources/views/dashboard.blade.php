<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Workforce Dashboard</title>
    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            letter-spacing: -0.01em;
        }
        /* Top Navbar */
        .navbar-saas {
            background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 16px 32px;
            box-shadow: 0 4px 25px rgba(15, 23, 42, 0.12);
        }
        /* Statistik & Kartu */
        .stat-card {
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
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
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.04);
            background: #ffffff;
        }
        .card-header-saas {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 22px 28px;
            font-weight: 700;
            color: #0f172a;
            font-size: 0.95rem;
            letter-spacing: -0.02em;
        }
        .camera-box {
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            background: #f8fafc;
            overflow: hidden;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #475569;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            font-size: 0.925rem;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .btn-saas-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 12px 20px;
            font-size: 0.925rem;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
        }
        .btn-saas-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: #fff;
            transform: translateY(-1px);
        }
        .btn-saas-danger {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 12px 20px;
            font-size: 0.925rem;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.25);
            transition: all 0.2s ease;
        }
        .btn-saas-danger:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            color: #fff;
            transform: translateY(-1px);
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
        .table-saas td {
            padding: 16px;
            vertical-align: middle;
            font-size: 0.9rem;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body>

<!-- Navbar SaaS Enterprise -->
<nav class="navbar navbar-saas d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary bg-opacity-10 text-primary p-2.5 rounded-3 border border-primary border-opacity-25 fs-5 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
            <i class="bi bi-fingerprint"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold text-white tracking-wider" style="font-size: 0.95rem;">HRIS & ATTENDANCE PORTAL</h6>
            <small class="text-secondary" style="font-size: 0.75rem;">Enterprise Workforce Management Suite</small>
        </div>
    </div>
    <div class="d-flex align-items-center gap-4">
        <div class="text-end d-none d-md-block">
            <div class="fw-bold font-mono text-info" style="font-size: 0.95rem;" id="clock">00:00:00</div>
            <small class="text-secondary" id="date" style="font-size: 0.75rem;"></small>
        </div>
        <div class="vr bg-secondary opacity-25"></div>
        <div class="dropdown">
            <button class="btn btn-sm btn-dark dropdown-toggle px-3.5 py-2 rounded-pill border border-secondary border-opacity-50 text-start d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" style="font-size: 0.85rem; font-weight: 500;">
                <i class="bi bi-person-circle text-primary fs-6"></i> {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 small p-2 mt-2">
                <li><h6 class="dropdown-header text-muted text-uppercase" style="font-size: 0.7rem;">Signed in as <br><strong class="text-dark text-lowercase">{{ Auth::user()->email }}</strong></h6></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-semibold rounded-2 py-2"><i class="bi bi-box-arrow-right me-2"></i> Sign Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">

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
        <div class="col-md-4">
            <div class="stat-card blue p-4 d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Rekaman Absen</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ count($attendances) }} <span class="fs-6 text-muted fw-normal font-sans">Sesi</span></h3>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                    <i class="bi bi-journal-check"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card green p-4 d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Status Akun Anda</span>
                    <h5 class="fw-bold text-success mb-0 mt-1 d-flex align-items-center gap-1.5 fs-6"><i class="bi bi-shield-check-fill"></i> Aktif & Terverifikasi</h5>
                </div>
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card purple p-4 d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Lokasi Geo-Tracking</span>
                    <h5 class="fw-bold text-dark mb-0 mt-1 d-flex align-items-center gap-1.5 fs-6"><i class="bi bi-radar text-purple"></i> GPS Terkunci</h5>
                </div>
                <div class="bg-purple bg-opacity-10 p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; color: #7c3aed;">
                    <i class="bi bi-geo-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Workspace Utama: Kamera & Kebijakan -->
    <div class="row g-4 mb-5">
        <!-- Panel Kamera -->
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
                            <span class="text-muted small fw-bold mb-2 d-block" style="font-size: 0.75rem;">LIVE STREAM</span>
                            <div id="my_camera" class="camera-box mx-auto mb-2.5 shadow-sm" style="width:100%; max-width:280px; height:210px;"></div>
                            <button type="button" class="btn btn-sm btn-dark rounded-pill px-3.5 py-1.5 fw-semibold shadow-sm" style="font-size: 0.8rem;" onclick="take_snapshot()">
                                <i class="bi bi-camera me-1"></i> Jepret Wajah
                            </button>
                        </div>
                        <div class="col-6">
                            <span class="text-muted small fw-bold mb-2 d-block" style="font-size: 0.75rem;">HASIL FOTO</span>
                            <div id="results" class="camera-box mx-auto mb-2.5 d-flex align-items-center justify-content-center text-muted shadow-sm" style="width:100%; max-width:280px; height:210px;">
                                <div class="text-center">
                                    <i class="bi bi-image fs-1 d-block text-secondary opacity-50 mb-1"></i>
                                    <span class="small text-muted" style="font-size: 0.8rem;">Belum ada foto</span>
                                </div>
                            </div>
                            <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle me-1"></i>Pastikan pencahayaan cukup</small>
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
                            <label class="form-label">Catatan / Laporan Harian</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Tuliskan ringkasan tugas atau agenda pekerjaan hari ini..."></textarea>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" onclick="setTipe('MASUK')" class="btn btn-saas-primary flex-fill">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Check In (Masuk)
                            </button>
                            <button type="submit" onclick="setTipe('KELUAR')" class="btn btn-saas-danger flex-fill">
                                <i class="bi bi-box-arrow-left me-1"></i> Check Out (Keluar)
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
                            <p class="text-muted small mb-0 lh-base" style="font-size: 0.825rem;">Batas waktu absen masuk adalah pukul 08:00 WIB[cite: 1]. Keterlambatan lebih dari 15 menit akan otomatis tercatat sebagai status terlambat oleh sistem[cite: 1].</p>
                        </div>

                        <div class="p-3.5 bg-light rounded-3 border mb-3">
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.875rem;"><i class="bi bi-person-fill-gear text-success me-1.5"></i> Profil Pengguna Aktif</h6>
                            <ul class="list-unstyled text-muted small mb-0 lh-lg" style="font-size: 0.825rem;">
                                <li><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                                <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                                <li><strong>Hak Akses:</strong> Pegawai (Karyawan)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-dark text-white p-3.5 rounded-3 text-center shadow-sm">
                        <small class="d-block text-secondary text-uppercase fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.08em;">Sistem Keamanan Terpadu</small>
                        <span class="small font-mono text-info" style="font-size: 0.8rem;"><i class="bi bi-lock-fill me-1"></i> Geo-Fencing & Biometric Verified</span>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID');
        document.getElementById('date').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }
    setInterval(updateClock, 1000);
    updateClock();

    Webcam.set({
        width: 280,
        height: 210,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
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