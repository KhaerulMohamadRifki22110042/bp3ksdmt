<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelatihan;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Sertifikat;

class Peserta extends Model
{
    protected $fillable = [
        'nama',
        'jurusan',
        'user_id'
    ];

    // 🔥 Relasi ke user (login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔥 Relasi ke pelatihan (pivot table)
    public function pelatihans()
    {
        return $this->belongsToMany(Pelatihan::class, 'pelatihan_peserta')
                    ->withTimestamps();
    }

    // Relasi ke absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    // Relasi ke nilai
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Relasi ke sertifikat
    public function sertifikats()
    {
        return $this->hasMany(Sertifikat::class);
    }
}
