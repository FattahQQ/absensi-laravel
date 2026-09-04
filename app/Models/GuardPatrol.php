<?php

namespace App\Http\Controllers;

use App\Models\GuardPatrol;
use Illuminate\Http\Request;

class GuardPatrolController extends Controller
{
    public function index()
    {
        $checkpoints = GuardPatrol::latest()->get();
        return view('master.guard-patrol', compact('checkpoints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_checkpoint' => 'required|string|max:255',
            'kode_qr' => 'required|string|max:100|unique:guard_patrols',
            'jadwal_patroli' => 'required|string|max:100',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        GuardPatrol::create($request->all());

        return redirect()->route('master.guard-patrol')->with('success', 'Checkpoint patroli berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_checkpoint' => 'required|string|max:255',
            'kode_qr' => 'required|string|max:100|unique:guard_patrols,kode_qr,' . $id,
            'jadwal_patroli' => 'required|string|max:100',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        $checkpoint = GuardPatrol::findOrFail($id);
        $checkpoint->update($request->all());

        return redirect()->route('master.guard-patrol')->with('success', 'Checkpoint patroli berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $checkpoint = GuardPatrol::findOrFail($id);
        $checkpoint->delete();

        return redirect()->route('master.guard-patrol')->with('success', 'Checkpoint patroli berhasil dihapus.');
    }
}