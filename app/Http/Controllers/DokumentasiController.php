<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class DokumentasiController extends Controller
{
    // daftar folder kegiatan
    public function index()
    {
        $kegiatans = Kegiatan::withCount('foto')->get();
        return view('dokumentasi.index', compact('kegiatans'));
    }

    // isi folder (foto-foto)
    public function show($id)
    {
        $kegiatan = Kegiatan::with('foto')->findOrFail($id);
        return view('dokumentasi.show', compact('kegiatan'));
    }
}
