<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'pelatihan_id',
        'peserta_id',
        'tanggal',
        'status'
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
