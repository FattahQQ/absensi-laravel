<?php

namespace App\Http\Controllers;

use App\Models\AdditionalAttribute;
use Illuminate\Http\Request;

class AdditionalAttributeController extends Controller
{
    public function index()
    {
        $attributes = AdditionalAttribute::latest()->get();
        return view('master.tambahan', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_atribut' => 'required|string|max:255',
            'tipe_data' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        AdditionalAttribute::create($request->all());

        return redirect()->route('master.tambahan')->with('success', 'Atribut tambahan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_atribut' => 'required|string|max:255',
            'tipe_data' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        $attribute = AdditionalAttribute::findOrFail($id);
        $attribute->update($request->all());

        return redirect()->route('master.tambahan')->with('success', 'Atribut tambahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $attribute = AdditionalAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('master.tambahan')->with('success', 'Atribut tambahan berhasil dihapus.');
    }
}