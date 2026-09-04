<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterUtamaController extends Controller
{
    // Menampilkan data pegawai dengan kondisi awal kosong jika belum ada filter / pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');

        // Jika tidak ada pencarian dan filter belum dipilih, biarkan collection kosong
        if (!$search && !$filter) {
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

            $users = $query->latest()->get();
        }

        $totalPegawai = User::count();
        $totalDivisi = 6;

        return view('master.utama', compact('users', 'totalPegawai', 'totalDivisi', 'search', 'filter'));
    }

    // Tambah pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Edit data pegawai
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'  => 'required|string',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
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