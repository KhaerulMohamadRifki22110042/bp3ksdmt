<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PelatihanPesertaController extends Controller
{
    public function create($pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);
        $pesertas  = Peserta::all();

        return view('pelatihan_peserta.create', compact('pelatihan', 'pesertas'));
    }

    public function store(Request $request, $pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        $pelatihan->pesertas()->sync($request->peserta_id);

        return redirect()->route('pelatihan.index')
            ->with('success', 'Peserta berhasil didaftarkan ke pelatihan');
    }
}
