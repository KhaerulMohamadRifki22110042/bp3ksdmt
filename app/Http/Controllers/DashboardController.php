<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Peserta;
use App\Models\Nilai;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelatihan = Pelatihan::count();
        $totalPeserta   = Peserta::count();
        $totalNilai     = Nilai::count();

        $pelatihanTerbaru = Pelatihan::orderBy('tanggal_mulai', 'desc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalPelatihan',
            'totalPeserta',
            'totalNilai',
            'pelatihanTerbaru'
        ));
    }
}