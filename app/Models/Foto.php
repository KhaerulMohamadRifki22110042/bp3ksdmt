<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = ['kegiatan_id', 'nama_file'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
