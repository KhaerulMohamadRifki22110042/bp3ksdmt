<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
use App\Models\Nilai;

class Pelatihan extends Model
{
protected $fillable = [
    'nama_pelatihan',
    'tanggal_mulai',
    'tanggal_selesai',
];

    // Relasi ke peserta (A-Z)
    public function pesertas()
    {
        return $this->belongsToMany(Peserta::class, 'pelatihan_peserta')
                    ->withTimestamps()
                    ->orderBy('nama', 'asc');
    }

    // Relasi ke nilai
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
