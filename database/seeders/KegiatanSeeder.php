<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        Kegiatan::create([
            'nama_kegiatan' => 'Pelatihan Laravel',
            'tanggal' => '2026-02-08',
            'deskripsi' => 'Pelatihan dasar Laravel'
        ]);

        Kegiatan::create([
            'nama_kegiatan' => 'Workshop Web',
            'tanggal' => '2026-02-10',
            'deskripsi' => 'Workshop pengembangan web'
        ]);
    }
}
