<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Remote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">Sistem Absensi Jarak Jauh (WFH/Remote)</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6 mb-3">
                        <h5>Kamera Live Selfie</h5>
                        <div id="my_camera" class="mx-auto border rounded mb-2" style="width:320px; height:240px;"></div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="take_snapshot()">Ambil Foto Selfie</button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Hasil Foto</h5>
                        <div id="results" class="border rounded mx-auto" style="width:320px; height:240px; display:flex; align-items:center; justify-content:center;">
                            <span class="text-muted">Belum ada foto</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('attendance.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="foto" id="foto">
                    <input type="hidden" name="tipe" id="tipe_absensi" value="MASUK">

                    <div class="mb-3">
                        <label class="form-label">Lokasi Anda (GPS):</label>
                        <input type="text" id="location_display" class="form-control text-primary fw-bold" readonly value="Mendeteksi lokasi...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan / Laporan Kegiatan (Opsional):</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tulis catatan pekerjaan harian..."></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" onclick="setTipe('MASUK')" class="btn btn-primary me-2">Absen Masuk</button>
                        <button type="submit" onclick="setTipe('KELUAR')" class="btn btn-danger">Absen Keluar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Riwayat Absensi Jarak Jauh</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Tipe</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Peta Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" width="60" class="rounded">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><span class="badge {{ $item->tipe == 'MASUK' ? 'bg-success' : 'bg-secondary' }}">{{ $item->tipe }}</span></td>
                                <td>{{ $item->tanggal }} <br><small class="text-muted">{{ $item->waktu }}</small></td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->catatan ?? '-' }}</td>
                                <td>
                                    @if($item->latitude)
                                        <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="btn btn-sm btn-outline-info">Lihat Peta</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3">Belum ada data absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
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
            alert("Browser kamu tidak mendukung Geolocation GPS.");
        }
    </script>
</body>
</html>