<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Remote Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .camera-box {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }
        .badge-status {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <!-- Header Banner -->
    <div class="hero-header mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-person-workspace me-2"></i>Sistem Absensi Remote</h3>
            <p class="mb-0 opacity-75">Selamat datang, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})</p>
        </div>
        <div class="text-end">
            <h5 class="fw-bold mb-1" id="clock">00:00:00</h5>
            <small id="date" class="opacity-75 d-block mb-2"></small>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Alert System -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show card-custom mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show card-custom mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Attendance Form Card -->
    <div class="card card-custom mb-5">
        <div class="card-body p-4">
            <h5 class="fw-bold text-dark mb-4"><i class="bi bi-camera me-2 text-primary"></i>Ambil Presensi Hari Ini</h5>
            
            <div class="row g-4 text-center">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 d-flex flex-column justify-content-between align-items-center">
                        <span class="fw-semibold text-secondary mb-2">Live Webcam</span>
                        <div id="my_camera" class="camera-box mx-auto mb-3" style="width:320px; height:240px;"></div>
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="take_snapshot()">
                            <i class="bi bi-camera-fill me-1"></i> Jepret Selfie
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100 d-flex flex-column justify-content-between align-items-center">
                        <span class="fw-semibold text-secondary mb-2">Preview Foto</span>
                        <div id="results" class="camera-box mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:320px; height:240px;">
                            <span class="text-muted"><i class="bi bi-image fs-1 d-block"></i> Belum Ada Foto</span>
                        </div>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Pastikan wajah terlihat jelas</small>
                    </div>
                </div>
            </div>

            <form action="{{ route('attendance.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="foto" id="foto">
                <input type="hidden" name="tipe" id="tipe_absensi" value="MASUK">

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>Lokasi Presensi (GPS)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-pin-map text-primary"></i></span>
                            <input type="text" id="location_display" class="form-control bg-white fw-semibold text-dark" readonly value="Mendeteksi lokasi GPS...">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-semibold text-secondary"><i class="bi bi-journal-text me-1 text-info"></i>Laporan / Catatan Kegiatan</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tuliskan aktivitas atau tugas yang diselesaikan..."></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-3 mt-4">
                    <button type="submit" onclick="setTipe('MASUK')" class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Absen Masuk
                    </button>
                    <button type="submit" onclick="setTipe('KELUAR')" class="btn btn-danger btn-lg px-4 rounded-3 shadow-sm">
                        <i class="bi bi-box-arrow-left me-1"></i> Absen Keluar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance History Table Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Presensi Saya</h5>
            <span class="badge bg-primary rounded-pill">{{ count($attendances) }} Data</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="py-3">No</th>
                            <th class="py-3">Foto</th>
                            <th class="py-3">Tipe</th>
                            <th class="py-3">Tanggal & Waktu</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Catatan</th>
                            <th class="py-3">Peta Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $item)
                            <tr>
                                <td class="fw-bold">{{ $index + 1 }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" width="50" height="50" class="rounded-circle border border-2 shadow-sm" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->tipe == 'MASUK')
                                        <span class="badge bg-success-subtle text-success badge-status border border-success-subtle">MASUK</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary badge-status border border-secondary-subtle">KELUAR</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $item->tanggal }}</div>
                                    <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $item->waktu }}</small>
                                </td>
                                <td>
                                    @if($item->status == 'Tepat Waktu')
                                        <span class="badge bg-success text-white badge-status">{{ $item->status }}</span>
                                    @elseif($item->status == 'Terlambat')
                                        <span class="badge bg-warning text-dark badge-status">{{ $item->status }}</span>
                                    @else
                                        <span class="badge bg-info text-white badge-status">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-start" style="max-width: 200px;">
                                    <span class="text-truncate d-block">{{ $item->catatan ?? '-' }}</span>
                                </td>
                                <td>
                                    @if($item->latitude)
                                        <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">
                                            <i class="bi bi-geo-alt me-1"></i> Peta
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-4 text-muted">Belum ada data presensi terekam.</td>
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
    // Live Clock Script
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID');
        document.getElementById('date').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Webcam Setup
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid rounded"/>';
            document.getElementById('foto').value = data_uri;
        });
    }

    function setTipe(tipe) {
        document.getElementById('tipe_absensi').value = tipe;
    }

    // Geolocation API
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            document.getElementById('location_display').value = position.coords.latitude + ', ' + position.coords.longitude;
        });
    } else {
        alert("Browser kamu tidak mendukung Geolocation GPS.");
    }
</script>
</body>
</html>