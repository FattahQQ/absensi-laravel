<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Utama - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg-soft: #f3f6fb;
            --panel: #ffffff;
            --panel-2: #f8fafc;
            --line: #e2e8f0;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --warning: #d97706;
            --purple: #8b5cf6;
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
            padding: 26px 28px;
            color: #fff;
            margin-bottom: 26px;
        }
        .crumbs {
            color: rgba(255,255,255,0.75);
            font-size: 0.8rem;
        }
        .crumbs a { color: rgba(255,255,255,0.8); }
        .page-title {
            font-size: clamp(1.7rem, 2vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            margin: 8px 0 0;
        }
        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #e2e8f0;
            font-weight: 700;
        }
        .card-saas {
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--panel);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.04);
        }
        .card-header-saas {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 18px 22px;
            font-weight: 700;
            color: var(--text);
            font-size: 0.95rem;
        }
        .table-saas th {
            background-color: #f8fafc;
            color: var(--muted);
            font-weight: 700;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #edf2f7;
            padding: 14px 16px;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 10px 18px;
            font-size: 0.875rem;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18);
        }
        .btn-primary-custom:hover {
            color: #fff;
            transform: translateY(-1px);
        }
        .btn-soft {
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 10px 16px;
        }
        .search-box { position: relative; }
        .search-box input {
            padding-left: 40px;
            border-radius: 12px;
            border: 1px solid var(--line);
            font-size: 0.875rem;
            background-color: var(--panel-2);
            height: 42px;
        }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 12px;
            color: #94a3b8;
        }
        .stat-card-blue {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-left: 5px solid #2563eb;
        }
        .stat-card-green {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid rgba(22, 163, 74, 0.14);
            border-left: 5px solid #16a34a;
        }
        .stat-card-purple {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
            border: 1px solid rgba(139, 92, 246, 0.18);
            border-left: 5px solid #9333ea;
        }
        .panel-shell {
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 10px 14px;
        }
    </style>
</head>
<body>
    <div class="page-wrapper px-3">

        <div class="top-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <nav aria-label="breadcrumb" class="crumbs">
                    <ol class="breadcrumb mb-2" style="background: transparent; margin: 0; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Master Utama</li>
                    </ol>
                </nav>
                <div class="header-badge"><i class="bi bi-person-gear"></i> Master Data Internal</div>
                <h3 class="page-title"><i class="bi bi-database-fill-check me-2"></i> Manajemen Master Utama Pegawai</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-soft px-3 py-2 fw-semibold shadow-sm border-0 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card card-saas stat-card-blue p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-primary small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Pegawai Aktif</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ $totalPegawai }} <span class="fs-6 text-muted fw-normal font-sans">Personil</span></h3>
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
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ $totalDivisi }} <span class="fs-6 text-muted fw-normal font-sans">Divisi</span></h3>
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

        <div class="card card-saas mb-4 overflow-hidden">
            <div class="card-header-saas d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2"><i class="bi bi-journal-text"></i></div>
                    <span class="fw-bold">Database Induk Pegawai & Organisasi</span>
                </div>

                <form action="{{ route('master.utama') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap">
                    <select name="filter" class="form-select border-1 rounded-3 text-muted fw-medium" style="font-size: 0.875rem; width: auto; min-width: 150px;" onchange="this.form.submit()">
                        <option value="" {{ empty($filter) ? 'selected' : '' }}>-- Filter Role --</option>
                        <option value="semua" {{ ($filter ?? '') == 'semua' ? 'selected' : '' }}>Semua Role</option>
                        <option value="superadmin" {{ ($filter ?? '') == 'superadmin' ? 'selected' : '' }}>Filter: Superadmin</option>
                        <option value="manager" {{ ($filter ?? '') == 'manager' ? 'selected' : '' }}>Filter: Manager</option>
                        <option value="pegawai" {{ ($filter ?? '') == 'pegawai' ? 'selected' : '' }}>Filter: Karyawan / Staff</option>
                    </select>

                    <select name="department" class="form-select border-1 rounded-3 text-muted fw-medium" style="font-size: 0.875rem; width: auto; min-width: 180px;" onchange="this.form.submit()">
                        <option value="" {{ empty($department) ? 'selected' : '' }}>-- Filter Departemen --</option>
                        <option value="semua" {{ ($department ?? '') == 'semua' ? 'selected' : '' }}>Semua Departemen</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ ($department ?? '') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>

                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama / email..." value="{{ $search ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-light border fw-semibold text-secondary rounded-3 px-3 py-2 btn-soft" style="font-size: 0.875rem;">
                        <i class="bi bi-funnel me-1"></i> Terapkan
                    </button>

                    @if(!empty($filter) || !empty($search) || !empty($department))
                        <a href="{{ route('master.utama') }}" class="btn btn-outline-danger fw-semibold rounded-3 px-3 py-2 btn-soft" style="font-size: 0.875rem;" title="Reset Filter">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </a>
                    @endif

                    <a href="{{ route('master.utama.export') }}" class="btn btn-outline-success fw-semibold rounded-3 px-3 py-2 btn-soft" style="font-size: 0.875rem;" title="Export Excel">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </a>

                    <button type="button" class="btn btn-outline-primary fw-semibold rounded-3 px-3 py-2 btn-soft" style="font-size: 0.875rem;" data-bs-toggle="modal" data-bs-target="#importExcelModal" title="Import Excel">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Import Excel
                    </button>

                    <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus me-1"></i> Tambah Data Utama
                    </button>
                </form>
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
                                <tr style="background: rgba(248,250,252,0.15);">
                                    <td class="fw-bold text-muted font-mono">
                                        {{ method_exists($users, 'firstItem') ? $users->firstItem() + $index : $index + 1 }}
                                    </td>
                                    <td class="text-start fw-semibold text-dark">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 34px; height: 34px; background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); font-size: 0.75rem;">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="font-mono text-primary">{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2.5 py-1 rounded-2 fw-medium">
                                            {{ $user->department ?? 'Information Technology' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-opacity-10 border px-3 py-1 rounded-pill 
                                            {{ strtolower($user->role ?? '') == 'superadmin' ? 'bg-success text-success border-success' : 'bg-primary text-primary border-primary' }}">
                                            {{ ucfirst($user->role ?? 'Pegawai') }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1 btn-edit-user" 
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-role="{{ $user->role }}"
                                                data-department="{{ $user->department }}"
                                                title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('master.utama.destroy', $user->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2 btn-delete" title="Hapus"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="bi bi-funnel text-secondary opacity-50 fs-1 mb-2"></i>
                                            <span class="fw-semibold">Data Belum Dimuat / Tidak Ditemukan</span>
                                            <small class="text-muted mt-1">Pilih filter "Semua Role" / "Semua Departemen" atau gunakan kolom pencarian untuk menampilkan data pegawai.</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="small text-muted">
                        Menampilkan <span class="fw-bold text-dark">{{ $users->firstItem() }}</span> sampai <span class="fw-bold text-dark">{{ $users->lastItem() }}</span> dari <span class="fw-bold text-dark">{{ $users->total() }}</span> pegawai
                    </div>
                    <div>
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Edit Global -->
    <div class="modal fade" id="globalEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-pencil-square text-primary me-2"></i> Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="globalEditForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" id="edit_name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email / ID Karyawan</label>
                            <input type="email" id="edit_email" name="email" class="form-control font-mono" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Departemen / Divisi</label>
                            <input type="text" id="edit_department" name="department" class="form-control" placeholder="Contoh: Information Technology">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Hak Akses Sistem (Role)</label>
                            <select id="edit_role" name="role" class="form-select" required>
                                <option value="superadmin">Superadmin</option>
                                <option value="manager">Manager</option>
                                <option value="pegawai">Pegawai / Staff</option>
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
                            <label class="form-label small fw-bold text-muted">Departemen / Divisi</label>
                            <input type="text" name="department" class="form-control" placeholder="Contoh: Information Technology">
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

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-file-earmark-excel text-success me-2"></i> Import Data Pegawai Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('master.utama.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Pilih File Excel / CSV</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                            <div class="form-text mt-2" style="font-size: 0.775rem;">
                                * Format file harus <strong>.xlsx / .csv</strong>. <br>
                                * Pastikan baris pertama berisi header: <code>nama_pegawai</code>, <code>email</code>, <code>role</code>, <code>department</code>, <code>password</code>.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top px-4 py-3">
                        <button type="button" class="btn btn-light border px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4 fw-semibold rounded-3"><i class="bi bi-upload me-1"></i> Unggah & Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logika Modal Edit
            const editModalElement = document.getElementById('globalEditModal');
            const globalModal = new bootstrap.Modal(editModalElement);
            const editForm = document.getElementById('globalEditForm');

            document.querySelectorAll('.btn-edit-user').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');
                    const role = this.getAttribute('data-role');
                    const department = this.getAttribute('data-department');

                    editForm.action = `/master/utama/${id}`;

                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_email').value = email;
                    document.getElementById('edit_role').value = role;
                    document.getElementById('edit_department').value = department || 'Information Technology';

                    globalModal.show();
                });
            });

            // Notifikasi Toast Sukses dari Session Laravel
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
            @endif

            // Konfirmasi Hapus Data dengan SweetAlert2 Modal
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data pegawai ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: '<i class="bi bi-trash me-1"></i> Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-4',
                            confirmButton: 'rounded-3 px-3 py-2',
                            cancelButton: 'rounded-3 px-3 py-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>