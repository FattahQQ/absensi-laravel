<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Master Atribut Tambahan - LSP Kimia Industri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; color: #1e293b; }
        .page-wrapper { max-width: 1320px; margin: 0 auto; }
        .card-saas { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 20px 24px; font-weight: 700; color: #0f172a; font-size: 0.95rem; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .table-saas th { background-color: #f8fafc; color: #64748b; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #f1f5f9; padding: 14px 16px; }
        .btn-warning-custom { background: linear-gradient(135deg, #d97706 0%, #b45309 100%); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25); }
        .btn-warning-custom:hover { color: #fff; opacity: 0.9; }
        .stat-card { border-radius: 16px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); position: relative; overflow: hidden; }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #d97706; }
    </style>
</head>
<body>
    <div class="page-wrapper py-5 px-3">
        <!-- Top Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-warning fw-semibold" aria-current="page">Master Tambahan</li>
                    </ol>
                </nav>
                <h3 class="fw-bold text-dark mb-0"><i class="bi bi-plus-square text-warning me-2"></i> Manajemen Master Atribut Tambahan</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm bg-white">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Alert Notifikasi Sukses -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 2500,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <!-- Stat Card Ringkasan -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Total Atribut Aktif</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">{{ $attributes->where('status', 'Aktif')->count() }} <span class="fs-6 text-muted fw-normal font-sans">Atribut</span></h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 d-flex justify-content-between align-items-center" style="border-left-color: #2563eb;">
                    <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #2563eb;"></div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Sistem Geofencing</span>
                        <h5 class="fw-bold text-primary mb-0 mt-1 fs-6"><i class="bi bi-shield-check me-1"></i> Radius Terproteksi</h5>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-radar"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-4 d-flex justify-content-between align-items-center" style="border-left-color: #059669;">
                    <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #059669;"></div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Akses Kontrol Aturan</span>
                        <h5 class="fw-bold text-success mb-0 mt-1 fs-6">Superadmin Only</h5>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Container -->
        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-2"><i class="bi bi-gear-wide"></i></div>
                    <span class="fw-bold">Pengaturan Kategori & Atribut Tambahan Sistem</span>
                </div>
                <button type="button" class="btn btn-warning-custom text-white" data-bs-toggle="modal" data-bs-target="#addAttributeModal">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Atribut
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Atribut / Parameter</th>
                                <th class="py-3">Tipe Data</th>
                                <th class="py-3 text-start">Keterangan</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attributes as $index => $item)
                                <tr>
                                    <td class="fw-bold text-muted font-mono">{{ $index + 1 }}</td>
                                    <td class="text-start fw-semibold text-dark">{{ $item->nama_atribut }}</td>
                                    <td><span class="font-mono text-secondary badge bg-light border">{{ $item->tipe_data }}</span></td>
                                    <td class="text-start text-secondary small">{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        @if($item->status == 'Aktif')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill font-mono">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-1 rounded-pill font-mono">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <!-- Tombol Edit Modal -->
                                            <button type="button" class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2" data-bs-toggle="modal" data-bs-target="#editAttributeModal{{ $item->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <!-- Tombol Hapus Form -->
                                            <form action="{{ route('master.tambahan.destroy', $item->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2 btn-delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit Atribut -->
                                <div class="modal fade" id="editAttributeModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <form action="{{ route('master.tambahan.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header border-0 pb-0 pt-4 px-4">
                                                    <h5 class="fw-bold text-dark"><i class="bi bi-pencil-square text-primary me-2"></i> Edit Atribut Tambahan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body p-4 text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Nama Atribut / Parameter</label>
                                                        <input type="text" name="nama_atribut" class="form-control" value="{{ $item->nama_atribut }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Tipe Data</label>
                                                        <input type="text" name="tipe_data" class="form-control font-mono" value="{{ $item->tipe_data }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Keterangan</label>
                                                        <textarea name="keterangan" class="form-control" rows="2">{{ $item->keterangan }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="Aktif" {{ $item->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="Nonaktif" {{ $item->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                                                    <button type="button" class="btn btn-light rounded-3 px-3" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-semibold">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-5 text-muted small">Belum ada data atribut tambahan yang tersimpan dalam sistem.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Atribut -->
    <div class="modal fade" id="addAttributeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form action="{{ route('master.tambahan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-plus-circle text-warning me-2"></i> Tambah Atribut Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 text-start">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Atribut / Parameter</label>
                            <input type="text" name="nama_atribut" class="form-control" placeholder="Contoh: Radius Validasi GPS" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Tipe Data</label>
                            <input type="text" name="tipe_data" class="form-control font-mono" placeholder="Contoh: Geofence (Meter)" value="Geofence (Meter)" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Deskripsi parameter atribut sistem..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Status</label>
                            <select name="status" class="form-select">
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-3 px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning text-white rounded-3 px-4 fw-semibold">Simpan Atribut</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest('form');
                Swal.fire({
                    title: 'Hapus Atribut Ini?',
                    text: 'Data parameter sistem yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>