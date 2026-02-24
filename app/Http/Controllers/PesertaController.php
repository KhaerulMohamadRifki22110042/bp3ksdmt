<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::with('pelatihans')->orderBy('nama')->get();
        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        $pelatihans = Pelatihan::orderBy('nama_pelatihan')->get();
        return view('peserta.create', compact('pelatihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required',
            'jurusan'      => 'required',
            'pelatihan_id' => 'required|exists:pelatihans,id'
        ]);

        $peserta = Peserta::create([
            'nama'    => $request->nama,
            'jurusan' => $request->jurusan
        ]);

        $peserta->pelatihans()->sync([$request->pelatihan_id]);

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peserta = Peserta::with('pelatihans')->findOrFail($id);
        $pelatihans = Pelatihan::orderBy('nama_pelatihan')->get();

        return view('peserta.edit', compact('peserta', 'pelatihans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required',
            'jurusan'      => 'required',
            'pelatihan_id' => 'required|exists:pelatihans,id'
        ]);

        $peserta = Peserta::findOrFail($id);

        $peserta->update([
            'nama'    => $request->nama,
            'jurusan' => $request->jurusan
        ]);

        $peserta->pelatihans()->sync([$request->pelatihan_id]);

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->pelatihans()->detach();
        $peserta->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Peserta berhasil dihapus');
    }

    // =============================
    // OPSI A - PESERTA DAFTAR SENDIRI
    // =============================

    public function daftarPelatihan()
    {
        $pelatihans = Pelatihan::latest()->get();

        $peserta = Peserta::where('user_id', Auth::id())->first();

        if (!$peserta) {
            return redirect()->route('dashboard')
                ->with('error', 'Data peserta belum tersedia.');
        }

        return view('peserta.pelatihan', compact('pelatihans', 'peserta'));
    }

    public function storePelatihan($id)
    {
        $peserta = Peserta::where('user_id', Auth::id())->first();

        if (!$peserta) {
            return back()->with('error', 'Data peserta tidak ditemukan.');
        }

        if (!$peserta->pelatihans()->where('pelatihan_id', $id)->exists()) {
            $peserta->pelatihans()->attach($id);
        }

        return back()->with('success', 'Berhasil daftar pelatihan!');
    }
}
