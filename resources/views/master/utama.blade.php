<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Utama - Enterprise Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
        .card-saas { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1"><i class="bi bi-person-gear text-primary me-2"></i> Pengelolaan Master Utama</h3>
                <p class="text-muted small mb-0">Kelola data master dan pengaturan parameter utama sistem di sini.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm px-3 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card card-saas p-4">
            <div class="text-center py-5">
                <i class="bi bi-folder2-open text-primary opacity-50 display-4 mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Modul Master Utama Aktif</h5>
                <p class="text-muted small">Halaman ini berhasil diakses dan diamankan dengan hak akses Superadmin.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>