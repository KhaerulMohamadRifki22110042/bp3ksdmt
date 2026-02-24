<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    // =====================================================
    // 🔹 ADMIN SECTION
    // =====================================================

    // List semua pelatihan
    public function index()
    {
        // gunakan tanggal_mulai untuk urutan
        $pelatihans = Pelatihan::orderBy('tanggal_mulai', 'desc')->get();
        return view('sertifikat.index', compact('pelatihans'));
    }

    // List semua peserta dalam pelatihan (ADMIN)
    public function peserta($pelatihan_id)
    {
        $pelatihan = Pelatihan::with('pesertas')
            ->findOrFail($pelatihan_id);

        return view('sertifikat.peserta', compact('pelatihan'));
    }

    // Download sertifikat (ADMIN)
    public function pdf($pelatihan_id, $peserta_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        // 🔐 Pastikan peserta memang terdaftar di pelatihan
        $peserta = $pelatihan->pesertas()
            ->where('pesertas.id', $peserta_id)
            ->firstOrFail();

        $pdf = app('dompdf.wrapper')
            ->loadView('sertifikat.pdf', compact('pelatihan', 'peserta'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat-' . $peserta->nama . '.pdf');
    }

    // =====================================================
    // 🔹 PESERTA SECTION
    // =====================================================

    // Tampilkan sertifikat milik peserta sendiri
    public function show($pelatihan_id)
    {
        $user = auth()->user();

        if ($user->role !== 'peserta') {
            abort(403, 'Akses ditolak');
        }

        $peserta = $user->peserta;

        if (!$peserta) {
            abort(403, 'Data peserta tidak ditemukan');
        }

        // 🔐 Pastikan peserta terdaftar di pelatihan
        $pelatihan = $peserta->pelatihans()
            ->where('pelatihans.id', $pelatihan_id)
            ->firstOrFail();

        return view('sertifikat.show-peserta', compact('pelatihan', 'peserta'));
    }

    // Download sertifikat milik sendiri (PESERTA)
    public function downloadPeserta($pelatihan_id)
    {
        $user = auth()->user();

        if ($user->role !== 'peserta') {
            abort(403, 'Akses ditolak');
        }

        $peserta = $user->peserta;

        if (!$peserta) {
            abort(403, 'Data peserta tidak ditemukan');
        }

        // 🔐 Validasi relasi
        $pelatihan = $peserta->pelatihans()
            ->where('pelatihans.id', $pelatihan_id)
            ->firstOrFail();

        $pdf = app('dompdf.wrapper')
            ->loadView('sertifikat.pdf', compact('pelatihan', 'peserta'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat-' . $peserta->nama . '.pdf');
    }
}