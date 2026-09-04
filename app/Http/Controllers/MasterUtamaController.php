<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MasterUtamaController extends Controller
{
    // Menampilkan data pegawai dengan filter role, departemen, dan kata kunci pencarian
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $filter     = $request->input('filter');
        $department = $request->input('department');

        // Mengambil daftar departemen unik yang ada di database untuk dropdown filter
        $departments = User::whereNotNull('department')
                           ->where('department', '!=', '')
                           ->select('department')
                           ->distinct()
                           ->pluck('department');

        // Jika tidak ada pencarian dan semua filter belum dipilih, biarkan collection kosong
        if (!$search && !$filter && !$department) {
            $users = collect();
        } else {
            $query = User::query();

            // Saring berdasarkan pencarian kata kunci nama/email
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // Saring berdasarkan filter role (jika bukan 'semua')
            if ($filter && $filter !== 'semua') {
                $query->where('role', $filter);
            }

            // Saring berdasarkan filter departemen dinamis (jika bukan 'semua')
            if ($department && $department !== 'semua') {
                $query->where('department', $department);
            }

            // Gunakan paginate(10) dan appends agar query string tetap terbawa saat navigasi halaman
            $users = $query->latest()->paginate(10)->appends($request->all());
        }

        $totalPegawai = User::count();
        $totalDivisi  = $departments->count() ?: 6;

        return view('master.utama', compact('users', 'totalPegawai', 'totalDivisi', 'search', 'filter', 'department', 'departments'));
    }

    // Export data pegawai ke file Excel (.xlsx)
    public function export()
    {
        return Excel::download(new UsersExport, 'data_pegawai_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    // Import data pegawai dari file Excel (.xlsx / .csv)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data pegawai berhasil di-import dari Excel!');
    }

    // Tambah pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6',
            'role'       => 'required|string',
            'department' => 'nullable|string|max:255',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'department' => $request->department ?? 'Information Technology',
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Edit data pegawai
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'       => 'required|string',
            'department' => 'nullable|string|max:255',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role,
            'department' => $request->department,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // Hapus pegawai
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data pegawai berhasil dihapus!');
    }
}