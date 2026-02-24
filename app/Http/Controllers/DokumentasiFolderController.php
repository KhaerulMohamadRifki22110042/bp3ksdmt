<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class DokumentasiFolderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
        ]);

        return redirect()
            ->route('dokumentasi.index')
            ->with('success', 'Folder berhasil ditambahkan');
    }
}
