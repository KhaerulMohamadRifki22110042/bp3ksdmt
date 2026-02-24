<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peserta;
use App\Models\Pelatihan;


class Nilai extends Model
{
    protected $fillable = [
        'pelatihan_id',
        'peserta_id',
        'interpersonal',
        'intrapersonal',
        'organisasi',
        'spiritual'
    ];
    
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}

