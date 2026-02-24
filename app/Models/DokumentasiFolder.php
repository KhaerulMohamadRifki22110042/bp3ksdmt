<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiFolder extends Model
{
    protected $table = 'dokumentasi_folders';
    protected $fillable = ['nama_folder'];
}

