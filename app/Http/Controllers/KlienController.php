<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;

class KlienController extends Controller
{
    // Tampil semua data klien
    public function index(Request $request)
    {
        $search = $request->get('search');

        $klien = Klien::when($search, function ($query) use ($search) {
            $query->where('nama_klien', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('pages.klien.index', compact('klien', 'search'));
    }

    // Form tambah klien
    public function create()
    {
        return view('pages.klien.create');
    }

    // Simpan data klien baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_klien'      => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'no_telpon'       => 'nullable|string|max:20',
            'alamat'          => 'nullable|string',
            'status'          => 'required|in:Aktif,Tidak Aktif',
            'tanggal_kerjasama' => 'nullable|date',
            'catatan'         => 'nullable|string',
        ]);

        Klien::create($request->all());

        return redirect()->route('klien.index')
                         ->with('success', 'Data klien berhasil ditambahkan!');
    }

    // Form edit klien
    public function edit(Klien $klien)
    {
        return view('pages.klien.edit', compact('klien'));
    }

    // Update data klien
    public function update(Request $request, Klien $klien)
    {
        $request->validate([
            'nama_klien'      => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'email'           => 'nullable|email|max:255',
            'no_telpon'       => 'nullable|string|max:20',
            'alamat'          => 'nullable|string',
            'status'          => 'required|in:Aktif,Tidak Aktif',
            'tanggal_kerjasama' => 'nullable|date',
            'catatan'         => 'nullable|string',
        ]);

        $klien->update($request->all());

        return redirect()->route('klien.index')
                         ->with('success', 'Data klien berhasil diupdate!');
    }

    // Hapus data klien
    public function destroy(Klien $klien)
    {
        $klien->delete();

        return redirect()->route('klien.index')
                         ->with('success', 'Data klien berhasil dihapus!');
    }
}