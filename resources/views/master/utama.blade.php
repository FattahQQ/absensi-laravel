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
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: #1e293b; }
        .card-saas { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; font-weight: 700; color: #0f172a; font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-primary-custom { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }
        .search-box { position: relative; }
        .search-box input { padding-left: 40px; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 0.875rem; }
        .search-box i { position: absolute; left: 14px; top: 11px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="container py-5">
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
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Metric Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card card-saas p-3.5 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Total Pegawai Aktif</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1 font-mono">48 <span class="fs-6 text-muted fw-normal font-sans">Personil</span></h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-saas p-3.5 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Departemen Terdaftar</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1 font-mono">6 <span class="fs-6 text-muted fw-normal font-sans">Divisi</span></h4>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-saas p-3.5 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Status Sinkronisasi</span>
                        <h5 class="fw-bold text-success mb-0 mt-1 fs-6"><i class="bi bi-check-circle-fill me-1"></i> Live Database</h5>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Cari nama atau NIK...">
                    </div>
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
                                <th class="py-3">ID / NIK</th>
                                <th class="py-3">Departemen</th>
                                <th class="py-3">Status Akses</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted font-mono">1</td>
                                <td class="text-start fw-semibold text-dark">Abdul Fattah</td>
                                <td class="font-mono text-primary">EMP-001</td>
                                <td>Information Technology</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Superadmin</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">2</td>
                                <td class="text-start fw-semibold text-dark">Muhammad Tegar Septian</td>
                                <td class="font-mono text-primary">EMP-002</td>
                                <td>Operational & Security</td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-1 rounded-pill">Manager</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-person-plus-fill text-primary me-2"></i> Tambah Data Induk Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama lengkap pegawai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nomor Induk Karyawan (NIK)</label>
                            <input type="text" class="form-control font-mono" placeholder="Contoh: EMP-003">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Departemen / Divisi</label>
                            <select class="form-select">
                                <option selected>Pilih Departemen...</option>
                                <option>Information Technology</option>
                                <option>Operational & Security</option>
                                <option>Human Resources</option>
                                <option>Finance & Accounting</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Hak Akses Sistem (Role)</label>
                            <select class="form-select">
                                <option selected>Pilih Role...</option>
                                <option>Superadmin</option>
                                <option>Manager</option>
                                <option>Pegawai / Staff</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top px-4 py-3">
                    <button type="button" class="btn btn-light border px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary-custom px-4">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>