<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Foto;

class FotoController extends Controller
{
    // FORM TAMBAH FOTO
    public function create($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('foto.create', compact('kegiatan'));
    }

    // SIMPAN FOTO
    public function store(Request $request, $id)
    {
        $request->validate([
            'foto.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        foreach ($request->file('foto') as $file) {
            $nama = time() . rand(1,999) . '.' . $file->extension();

            // simpan file
$file->storeAs(
    'dokumentasi/'.$kegiatan->id,
    $nama,
    'public'
);

            // simpan ke DB
            Foto::create([
                'kegiatan_id' => $kegiatan->id,
                'nama_file' => $nama
            ]);
        }

        return redirect('/dokumentasi/'.$kegiatan->id)
               ->with('success', 'Foto berhasil ditambahkan');
    }
}
