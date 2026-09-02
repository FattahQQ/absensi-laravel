<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Portal - Pendaftaran Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #0f172a;
        }
        .split-screen {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        /* Sisi Kiri: Branding Korporat Bonafit */
        .brand-side {
            flex: 1;
            background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 60px;
            position: relative;
        }
        .brand-side::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%);
            pointer-events: none;
        }
        /* Sisi Kanan: Form Register */
        .form-side {
            width: 540px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            padding: 10px 14px;
            font-size: 0.95rem;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 4px rgba(15, 23, 42, 0.08);
        }
        .btn-enterprise {
            background-color: #0f172a;
            color: #ffffff;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            transition: all 0.2s;
        }
        .btn-enterprise:hover {
            background-color: #1e293b;
            color: #ffffff;
            transform: translateY(-1px);
        }
        @media (max-width: 992px) {
            .brand-side { display: none; }
            .form-side { width: 100%; height: 100vh; background: #f8f9fa; box-shadow: none; }
        }
    </style>
</head>
<body>

<div class="split-screen">
    <!-- Panel Kiri: Identitas Korporat -->
    <div class="brand-side">
        <div>
            <div class="d-flex align-items-center gap-2 mb-4">
                <div class="bg-primary bg-opacity-25 p-2 rounded-3 text-primary border border-primary border-opacity-50">
                    <i class="bi bi-person-plus-fill fs-4"></i>
                </div>
                <span class="fw-bold tracking-wider fs-5">ENTERPRISE SECURE ID</span>
            </div>
            <h1 class="display-5 fw-bold mb-3 text-white lh-base">Pendaftaran Akun<br>Pegawai & Karyawan.</h1>
            <p class="text-secondary lead fs-6">Daftarkan kredensial resmi Anda untuk mengakses sistem presensi terintegrasi secara aman dari lokasi kerja masing-masing.</p>
        </div>
        <div>
            <hr class="border-secondary opacity-25 mb-4">
            <p class="small text-muted mb-0">&copy; 2026 Remote Workforce Solutions. All rights reserved.</p>
        </div>
    </div>

    <!-- Panel Kanan: Form Pendaftaran -->
    <div class="form-side">
        <div class="login-container">
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1">Registrasi Akun</h3>
                <p class="text-muted small">Lengkapi data diri Anda untuk membuat kredensial baru.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label text-dark small fw-bold">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama sesuai identitas">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label text-dark small fw-bold">Email Korporat / Pribadi</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="form-control @error('email') is-invalid @enderror" placeholder="nama@perusahaan.com">
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label text-dark small fw-bold">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••••••">
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label text-dark small fw-bold">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="••••••••••••">
                    @error('password_confirmation')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-enterprise shadow-sm">
                        Daftarkan Kredensial <i class="bi bi-check-circle ms-1"></i>
                    </button>
                </div>

                <div class="text-center">
                    <small class="text-muted">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-dark">Masuk ke portal</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>