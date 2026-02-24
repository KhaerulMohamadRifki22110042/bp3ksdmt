<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        // urutkan berdasarkan tanggal_mulai terbaru
        $pelatihans = Pelatihan::orderBy('tanggal_mulai', 'desc')->get();
        return view('nilai.index', compact('pelatihans'));
    }

    // ================= FORM INPUT =================
    public function create($pelatihan_id)
    {
        $pelatihan = Pelatihan::with(['pesertas' => function ($q) {
            $q->orderBy('nama', 'asc');
        }])->findOrFail($pelatihan_id);

        return view('nilai.create', compact('pelatihan'));
    }

    // ================= SIMPAN =================
    public function store(Request $request, $pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        $request->validate([
            'interpersonal' => 'required|array',
            'intrapersonal' => 'required|array',
            'organisasi'    => 'required|array',
            'spiritual'     => 'required|array',
        ]);

        foreach ($request->interpersonal as $peserta_id => $value) {
            Nilai::updateOrCreate(
                [
                    'pelatihan_id' => $pelatihan->id,
                    'peserta_id'   => $peserta_id,
                ],
                [
                    'interpersonal' => $request->interpersonal[$peserta_id] ?? 0,
                    'intrapersonal' => $request->intrapersonal[$peserta_id] ?? 0,
                    'organisasi'    => $request->organisasi[$peserta_id] ?? 0,
                    'spiritual'     => $request->spiritual[$peserta_id] ?? 0,
                ]
            );
        }

        return redirect()->route('nilai.index')
            ->with('success', 'Nilai berhasil disimpan');
    }

    // ================= REKAP =================
    public function rekap($pelatihan_id)
    {
        $user = auth()->user();

        // ================= PESERTA =================
        if ($user->role === 'peserta') {
            $peserta = $user->peserta;

            if (!$peserta) {
                abort(403);
            }

            $pelatihan = $peserta->pelatihans()
                ->where('pelatihans.id', $pelatihan_id)
                ->with(['nilais'])
                ->firstOrFail();

            return view('nilai.rekap_peserta', compact('pelatihan', 'peserta'));
        }

        // ================= ADMIN =================
        $pelatihan = Pelatihan::with([
            'pesertas' => function ($q) {
                $q->orderBy('nama', 'asc');
            },
            'pesertas.nilais'
        ])->findOrFail($pelatihan_id);

        return view('nilai.rekap', compact('pelatihan'));
    }

    // ================= PDF =================
    public function pdf($pelatihan_id)
    {
        $user = auth()->user();

        // ================= PDF PESERTA =================
        if ($user->role === 'peserta') {
            $peserta = $user->peserta;

            if (!$peserta) {
                abort(403);
            }

            $pelatihan = $peserta->pelatihans()
                ->where('pelatihans.id', $pelatihan_id)
                ->firstOrFail();

            $nilai = $peserta->nilais()
                ->where('pelatihan_id', $pelatihan_id)
                ->first();

            $pdf = app('dompdf.wrapper')
                ->loadView('nilai.pdf_peserta', compact('pelatihan', 'peserta', 'nilai'))
                ->setPaper('A4', 'portrait');

            return $pdf->download('nilai-saya.pdf');
        }

        // ================= PDF ADMIN =================
        $pelatihan = Pelatihan::with([
            'pesertas' => function ($q) {
                $q->orderBy('nama', 'asc');
            },
            'pesertas.nilais'
        ])->findOrFail($pelatihan_id);

        $pdf = app('dompdf.wrapper')
            ->loadView('nilai.pdf', compact('pelatihan'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('rekap-nilai.pdf');
    }
}