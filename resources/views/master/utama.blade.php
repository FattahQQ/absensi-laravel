<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Utama - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f1f5f9; font-family: 'Inter', sans-serif; color: #1e293b; }
        .page-wrapper { max-width: 1320px; margin: 0 auto; }
        .card-saas { border: none; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05); transition: transform 0.2s; }
        .card-saas:hover { transform: translateY(-2px); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; font-weight: 700; color: #0f172a; font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-primary-custom { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }
        .search-box { position: relative; }
        .search-box input { padding-left: 40px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 0.875rem; background-color: #f8fafc; }
        .search-box i { position: absolute; left: 14px; top: 11px; color: #94a3b8; }
        
        /* Aksen Kartu Statistik Berwarna */
        .stat-card-blue { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-left: 5px solid #2563eb; }
        .stat-card-green { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-left: 5px solid #16a34a; }
        .stat-card-purple { background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); border-left: 5px solid #9333ea; }
    </style>
</head>
<body>
    <div class="page-wrapper py-5 px-3">
        <!-- Alert Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Top Header & Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Master Utama</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-person-gear text-primary me-2"></i> Manajemen Master Utama Pegawai</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm bg-white">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Metric Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card card-saas stat-card-blue p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-primary small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Pegawai Aktif</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ $totalPegawai ?? count($users) }} <span class="fs-6 text-muted fw-normal font-sans">Personil</span></h3>
                    </div>
                    <div class="bg-primary text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-saas stat-card-green p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-success small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Departemen Terdaftar</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ $totalDivisi ?? 6 }} <span class="fs-6 text-muted fw-normal font-sans">Divisi</span></h3>
                    </div>
                    <div class="bg-success text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-saas stat-card-purple p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em; color: #9333ea;">Status Sinkronisasi</span>
                        <h5 class="fw-bold text-dark mb-0 mt-1 fs-6"><i class="bi bi-check-circle-fill text-success me-1"></i> Live Database</h5>
                    </div>
                    <div class="text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px; background-color: #9333ea;">
                        <i class="bi bi-database-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2"><i class="bi bi-journal-text"></i></div>
                    <span class="fw-bold">Database Induk Pegawai & Organisasi</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <form action="{{ route('master.utama') }}" method="GET" class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ $search ?? '' }}" onchange="this.form.submit()">
                    </form>
                    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus me-1"></i> Tambah Data Utama
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Pegawai</th>
                                <th class="py-3">Email / ID</th>
                                <th class="py-3">Departemen</th>
                                <th class="py-3">Status Akses</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr>
                                    <td class="fw-bold text-muted font-mono">{{ $index + 1 }}</td>
                                    <td class="text-start fw-semibold text-dark">{{ $user->name }}</td>
                                    <td class="font-mono text-primary">{{ $user->email }}</td>
                                    <td>Information Technology</td>
                                    <td>
                                        <span class="badge bg-opacity-10 border px-3 py-1 rounded-pill 
                                            {{ strtolower($user->role ?? '') == 'superadmin' ? 'bg-success text-success border-success' : 'bg-primary text-primary border-primary' }}">
                                            {{ ucfirst($user->role ?? 'Pegawai') }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('master.utama.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Pegawai per User -->
                                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                                            <div class="modal-header border-bottom px-4 py-3">
                                                <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-pencil-square text-primary me-2"></i> Edit Data Pegawai</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('master.utama.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body p-4">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Email / ID Karyawan</label>
                                                        <input type="email" name="email" class="form-control font-mono" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Password Baru (Opsional)</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Hak Akses Sistem (Role)</label>
                                                        <select name="role" class="form-select" required>
                                                            <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                                            <option value="pegawai" {{ $user->role == 'pegawai' ? 'selected' : '' }}>Pegawai / Staff</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top px-4 py-3">
                                                    <button type="button" class="btn btn-light border px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary-custom px-4">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted py-4">Data pegawai tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-person-plus-fill text-primary me-2"></i> Tambah Data Induk Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('master.utama.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap pegawai" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email / ID Karyawan</label>
                            <input type="email" name="email" class="form-control font-mono" placeholder="nama@perusahaan.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Login</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password awal" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Hak Akses Sistem (Role)</label>
                            <select name="role" class="form-select" required>
                                <option value="" selected disabled>Pilih Role...</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="manager">Manager</option>
                                <option value="pegawai">Pegawai / Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top px-4 py-3">
                        <button type="button" class="btn btn-light border px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary-custom px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>