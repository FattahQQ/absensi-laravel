@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb" class="small text-muted mb-2">
                <ol class="breadcrumb mb-0" style="background: transparent; padding: 0; margin: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Rekap Absensi Kehadiran</li>
                </ol>
            </nav>
            <h4 class="fw-bold mb-0">Rekap Absensi Kehadiran</h4>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-light border rounded-pill px-3 py-2 fw-semibold">Kembali</a>
            <div class="btn-group">
                <button type="button" class="btn btn-primary rounded-pill px-3 py-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal">Set Filter Laporan</a></li>
                    <li><a class="dropdown-item" href="#" onclick="window.print()">Cetak Halaman Ini</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 100%); color: white;">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="small fw-bold text-uppercase text-white-50 mb-1">Area</div>
                <div class="fw-semibold">LSP Kimia Industri</div>
            </div>
            <div class="col-md-4">
                <div class="small fw-bold text-uppercase text-white-50 mb-1">Departemen</div>
                <div class="fw-semibold">LSP Kimia Industri</div>
            </div>
            <div class="col-md-4">
                <div class="small fw-bold text-uppercase text-white-50 mb-1">Periode</div>
                <div class="fw-semibold">{{ $startDate }} s/d {{ $endDate }}</div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mb-0" style="border-collapse: separate; border-spacing: 0;">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3 text-start">Nama</th>
                        <th class="py-3">Foto VL</th>
                        <th class="py-3">Rentang Tanggal ({{ $startDate }} s/d {{ $endDate }})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td class="fw-bold text-muted font-mono">{{ $user->id }}</td>
                        <td class="text-start fw-semibold text-dark">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 34px; height: 34px; background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%); font-size: 0.75rem;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $lastAttendance = $user->attendances->last();
                            @endphp
                            @if($lastAttendance && $lastAttendance->foto)
                                <img src="{{ asset('storage/' . $lastAttendance->foto) }}" width="42" height="42" class="rounded-circle object-fit-cover border border-2 shadow-sm" alt="Foto">
                            @else
                                <span class="badge bg-secondary rounded-pill">No Photo</span>
                            @endif
                        </td>
                        <td>
                            @if($user->attendances->count() > 0)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Hadir: {{ $user->attendances->count() }} Sesi</span>
                                <div class="small text-muted mt-2">Terakhir: {{ $lastAttendance->tanggal ?? '-' }} ({{ $lastAttendance->waktu ?? '-' }})</div>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill">Tidak Hadir / Alpha</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-muted py-4">Belum ada data karyawan atau absensi pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('manager.report') }}" method="GET" class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" id="filterModalLabel">Set Filter Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Range Tanggal</label>
                    <div class="input-group">
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        <span class="input-group-text">s/d</span>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Departemen</label>
                    <select name="departemen" class="form-select">
                        <option value="LSP Kimia Industri">LSP Kimia Industri</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light border rounded-3 px-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4">Lanjut</button>
            </div>
        </form>
    </div>
</div>
@endsection