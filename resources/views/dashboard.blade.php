<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">Sistem Absensi Online</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title mb-3">Tombol Presensi</h5>
                <form action="{{ route('attendance.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="tipe" value="MASUK">
                    <button type="submit" class="btn btn-primary me-2">Absen Masuk</button>
                </form>

                <form action="{{ route('attendance.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="tipe" value="KELUAR">
                    <button type="submit" class="btn btn-danger">Absen Keluar</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Riwayat Absensi</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="badge {{ $item->tipe == 'MASUK' ? 'bg-success' : 'bg-secondary' }}">{{ $item->tipe }}</span></td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->waktu }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">Belum ada data absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>