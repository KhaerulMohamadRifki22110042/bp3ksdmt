<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = ['nama_kegiatan', 'tanggal', 'deskripsi'];

    public function foto()
{
    return $this->hasMany(Foto::class)->orderBy('created_at', 'desc');
}
}

