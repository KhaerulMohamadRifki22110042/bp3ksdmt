<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    // ================= TAMPIL DATA =================
    public function index()
    {
        $pelatihans = Pelatihan::orderBy('tanggal_mulai', 'desc')->get();
        return view('pelatihan.index', compact('pelatihans'));
    }

    // ================= FORM TAMBAH =================
    public function create()
    {
        return view('pelatihan.create');
    }

    // ================= SIMPAN DATA =================
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan'   => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Pelatihan::create([
            'nama_pelatihan'  => $request->nama_pelatihan,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('pelatihan.index')
            ->with('success', 'Pelatihan berhasil ditambahkan');
    }

    // ================= FORM EDIT =================
    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        return view('pelatihan.edit', compact('pelatihan'));
    }

    // ================= UPDATE DATA =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelatihan'   => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pelatihan = Pelatihan::findOrFail($id);

        $pelatihan->update([
            'nama_pelatihan'  => $request->nama_pelatihan,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('pelatihan.index')
            ->with('success', 'Pelatihan berhasil diperbarui');
    }

    // ================= HAPUS DATA =================
    public function destroy($id)
    {
        Pelatihan::findOrFail($id)->delete();

        return redirect()->route('pelatihan.index')
            ->with('success', 'Pelatihan berhasil dihapus');
    }

    // ================= LIST PESERTA =================

    public function peserta($id)
{
    $pelatihan = Pelatihan::with('pesertas.user')->findOrFail($id);
    return view('pelatihan.peserta', compact('pelatihan'));
}
}