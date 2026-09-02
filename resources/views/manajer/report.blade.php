@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header & Action Button Dropdown -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Rekap Absensi Kehadiran</h4>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Kembali</a>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal">Set Filter Laporan</a></li>
                    <li><a class="dropdown-item" href="#" onclick="window.print()">Cetak Halaman Ini</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Informasi Area & Periode -->
    <div class="card mb-3 p-3 bg-light border-0 shadow-sm">
        <p class="mb-1"><strong>Area :</strong> LSP Kimia Industri</p>
        <p class="mb-1"><strong>Departemen :</strong> LSP Kimia Industri</p>
        <p class="mb-0"><strong>Periode :</strong> {{ $startDate }} s/d {{ $endDate }}</p>
    </div>

    <!-- Tabel Matriks Kehadiran -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Foto VL</th>
                        <th>Rentang Tanggal ({{ $startDate }} s/d {{ $endDate }})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="text-start fw-semibold">{{ $user->name }}</td>
                        <td>
                            @php
                                $lastAttendance = $user->attendances->last();
                            @endphp
                            @if($lastAttendance && $lastAttendance->foto)
                                <img src="{{ asset('storage/' . $lastAttendance->foto) }}" width="40" height="40" class="rounded-circle object-fit-cover border" alt="Foto">
                            @else
                                <span class="badge bg-secondary">No Photo</span>
                            @endif
                        </td>
                        <td>
                            @if($user->attendances->count() > 0)
                                <span class="badge bg-success">Hadir: {{ $user->attendances->count() }} Sesi</span>
                                <div class="small text-muted mt-1">Terakhir: {{ $lastAttendance->tanggal ?? '-' }} ({{ $lastAttendance->waktu ?? '-' }})</div>
                            @else
                                <span class="badge bg-danger">Tidak Hadir / Alpha</span>
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

<!-- Modal Filter Laporan -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('manager.report') }}" method="GET" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="filterModalLabel">Set Filter Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Lanjut</button>
            </div>
        </form>
    </div>
</div>
@endsection