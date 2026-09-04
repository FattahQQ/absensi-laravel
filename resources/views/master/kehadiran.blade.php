<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Kehadiran - Enterprise Workforce</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg-soft: #f4f7fb;
            --panel: #ffffff;
            --line: #e2e8f0;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --warning: #d97706;
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
            border-radius: 26px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.18);
            color: #fff;
            padding: 24px 28px;
            margin-bottom: 26px;
        }
        .crumbs { color: rgba(255,255,255,0.72); font-size: 0.8rem; }
        .crumbs a { color: rgba(255,255,255,0.82); }
        .page-title {
            font-size: clamp(1.7rem, 2vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            margin: 10px 0 0;
        }
        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            color: #e2e8f0;
        }
        .card-saas {
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--panel);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.04);
        }
        .card-header-saas { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 18px 22px; font-weight: 700; color: var(--text); font-size: 0.95rem; }
        .table-saas th { background-color: #f8fafc; color: var(--muted); font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #edf2f7; padding: 14px 16px; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .btn-primary-custom { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; border: none; border-radius: 12px; font-weight: 700; padding: 10px 18px; font-size: 0.875rem; box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18); }
        .btn-primary-custom:hover { color: #fff; transform: translateY(-1px); }
        .stat-card-blue { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid rgba(59, 130, 246, 0.15); border-left: 5px solid #2563eb; }
        .stat-card-green { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid rgba(22, 163, 74, 0.14); border-left: 5px solid #16a34a; }
        .stat-card-amber { background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1px solid rgba(217, 119, 6, 0.15); border-left: 5px solid #d97706; }
    </style>
</head>
<body>
    <div class="page-wrapper px-3">

        <div class="top-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <nav aria-label="breadcrumb" class="crumbs">
                    <ol class="breadcrumb mb-2" style="background: transparent; margin: 0; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">Master Kehadiran</li>
                    </ol>
                </nav>
                <div class="header-badge"><i class="bi bi-clock-history"></i> Attendance Rules</div>
                <h3 class="page-title"><i class="bi bi-calendar2-check me-2"></i> Manajemen Master Kehadiran</h3>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-light px-3 py-2 fw-semibold shadow-sm border-0 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Top Widgets / Cards Stat -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4 col-md-6">
                <div class="card card-saas stat-card-blue p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-primary small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Parameter Shift</span>
                        <h3 class="fw-bold text-dark mb-0 mt-1 font-mono">2 <span class="fs-6 text-muted fw-normal font-sans">Shift Aktif</span></h3>
                    </div>
                    <div class="bg-primary text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-saas stat-card-green p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-success small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Status Sistem Waktu</span>
                        <h5 class="fw-bold text-dark mb-0 mt-1 fs-6"><i class="bi bi-check-circle-fill text-success me-1"></i> Sinkron WIB (Asia/Jakarta)</h5>
                    </div>
                    <div class="bg-success text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px;">
                        <i class="bi bi-globe"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-saas stat-card-amber p-4 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-warning small fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em; color: #d97706 !important;">Akses Kontrol Aturan</span>
                        <h5 class="fw-bold text-dark mb-0 mt-1 fs-6"><i class="bi bi-shield-lock-fill text-warning me-1"></i> Superadmin Only</h5>
                    </div>
                    <div class="bg-warning text-white p-3 rounded-4 fs-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px; background-color: #d97706 !important;">
                        <i class="bi bi-lock"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Data Table Container -->
        <div class="card card-saas mb-4">
            <div class="card-header-saas d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2"><i class="bi bi-list-check"></i></div>
                    <span class="fw-bold">Daftar Pengaturan Aturan & Shift Kehadiran</span>
                </div>
                
                <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addShiftModal">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Shift Baru
                </button>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center table-saas">
                        <thead>
                            <tr>
                                <th class="py-3">No</th>
                                <th class="py-3 text-start">Nama Shift / Aturan</th>
                                <th class="py-3">Jam Masuk</th>
                                <th class="py-3">Jam Pulang</th>
                                <th class="py-3">Toleransi Terlambat</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-muted font-mono">1</td>
                                <td class="text-start fw-semibold text-dark">Shift Reguler (Pagi)</td>
                                <td><span class="badge bg-light text-primary border font-mono px-3 py-1.5 rounded-2 fs-6">08:30 WIB</span></td>
                                <td><span class="badge bg-light text-dark border font-mono px-3 py-1.5 rounded-2 fs-6">17:30 WIB</span></td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2.5 py-1 rounded-2 font-mono">15 Menit</span></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-1 rounded-pill">Aktif</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1 btn-edit-shift"
                                            data-id="1" data-name="Shift Reguler (Pagi)" data-in="08:30" data-out="17:30" data-tolerance="15" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="#" method="POST" class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-muted font-mono">2</td>
                                <td class="text-start fw-semibold text-dark">Shift Malam (Security/Ops)</td>
                                <td><span class="badge bg-light text-primary border font-mono px-3 py-1.5 rounded-2 fs-6">20:00 WIB</span></td>
                                <td><span class="badge bg-light text-dark border font-mono px-3 py-1.5 rounded-2 fs-6">04:00 WIB</span></td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-2.5 py-1 rounded-2 font-mono">10 Menit</span></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-1 rounded-pill">Aktif</span></td>
                                <td>
                                    <button class="btn btn-sm btn-light border text-primary px-2.5 py-1 rounded-2 me-1 btn-edit-shift"
                                            data-id="2" data-name="Shift Malam (Security/Ops)" data-in="20:00" data-out="04:00" data-tolerance="10" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="#" method="POST" class="d-inline form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger px-2.5 py-1 rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Shift Baru -->
    <div class="modal fade" id="addShiftModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-clock-fill text-primary me-2"></i> Tambah Parameter Shift Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Shift / Aturan</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Shift Siang Karyawan" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Jam Masuk (WIB)</label>
                                <input type="time" name="time_in" class="form-control font-mono" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Jam Pulang (WIB)</label>
                                <input type="time" name="time_out" class="form-control font-mono" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Toleransi Keterlambatan (Menit)</label>
                            <input type="number" name="tolerance_minutes" class="form-control font-mono" placeholder="15" value="15" required>
                            <small class="text-muted" style="font-size: 0.775rem;">Sesuai Kebijakan: Masuk setelah batas toleransi akan kena poin disiplin.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-top px-4 py-3">
                        <button type="button" class="btn btn-light border px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary-custom px-4">Simpan Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Shift -->
    <div class="modal fade" id="editShiftModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg text-start">
                <div class="modal-header border-bottom px-4 py-3">
                    <h5 class="fw-bold text-dark mb-0 fs-6"><i class="bi bi-pencil-square text-primary me-2"></i> Edit Parameter Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editShiftForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Shift / Aturan</label>
                            <input type="text" id="edit_shift_name" name="name" class="form-control" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Jam Masuk (WIB)</label>
                                <input type="time" id="edit_time_in" name="time_in" class="form-control font-mono" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">Jam Pulang (WIB)</label>
                                <input type="time" id="edit_time_out" name="time_out" class="form-control font-mono" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Toleransi Keterlambatan (Menit)</label>
                            <input type="number" id="edit_tolerance" name="tolerance_minutes" class="form-control font-mono" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal Edit Shift Handler
            const editModalElement = document.getElementById('editShiftModal');
            const editModal = new bootstrap.Modal(editModalElement);

            document.querySelectorAll('.btn-edit-shift').forEach(button => {
                button.addEventListener('click', function () {
                    document.getElementById('edit_shift_name').value = this.getAttribute('data-name');
                    document.getElementById('edit_time_in').value = this.getAttribute('data-in');
                    document.getElementById('edit_time_out').value = this.getAttribute('data-out');
                    document.getElementById('edit_tolerance').value = this.getAttribute('data-tolerance');

                    editModal.show();
                });
            });

            // SweetAlert Konfirmasi Hapus Shift
            document.querySelectorAll('.form-delete').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Shift ini akan dihapus dari sistem master!",
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
                            // this.submit();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>