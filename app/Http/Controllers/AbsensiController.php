<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function pilihPelatihan()
    {
        $pelatihans = Pelatihan::orderBy('nama_pelatihan', 'asc')->get();
        return view('absensi.pilih_pelatihan', compact('pelatihans'));
    }
    public function create($pelatihan_id)
    {
        $pelatihan = Pelatihan::findOrFail($pelatihan_id);

        $pesertas = $pelatihan->pesertas()
            ->orderBy('nama', 'asc')
            ->get();

        $tanggal = now()->toDateString();

        return view('absensi.create', compact('pelatihan', 'pesertas', 'tanggal'));
    }
    public function store(Request $request, $pelatihan_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status'  => 'required|array'
        ]);

        foreach ($request->status as $peserta_id => $status) {
            Absensi::updateOrCreate(
                [
                    'pelatihan_id' => $pelatihan_id,
                    'peserta_id'   => $peserta_id,
                    'tanggal'      => $request->tanggal
                ],
                [
                    'status' => $status
                ]
            );
        }

        return redirect()->route('absensi.pilih')
            ->with('success', 'Absensi berhasil disimpan');
    }
    public function rekap($pelatihan_id)
    {
        $pelatihan = Pelatihan::with([
            'pesertas' => function ($q) {
                $q->orderBy('nama', 'asc');
            },
            'pesertas.absensis' => function ($q) use ($pelatihan_id) {
                $q->where('pelatihan_id', $pelatihan_id);
            }
        ])->findOrFail($pelatihan_id);

        $tanggalList = Absensi::where('pelatihan_id', $pelatihan_id)
            ->select('tanggal')
            ->distinct()
            ->orderBy('tanggal', 'asc')
            ->pluck('tanggal');

        return view('absensi.rekap', compact('pelatihan', 'tanggalList'));
    }

    public function pdf($pelatihan_id)
    {
        $pelatihan = Pelatihan::with([
            'pesertas' => function ($q) {
                $q->orderBy('nama', 'asc');
            },
            'pesertas.absensis' => function ($q) use ($pelatihan_id) {
                $q->where('pelatihan_id', $pelatihan_id);
            }
        ])->findOrFail($pelatihan_id);

        $tanggalList = Absensi::where('pelatihan_id', $pelatihan_id)
            ->select('tanggal')
            ->distinct()
            ->orderBy('tanggal', 'asc')
            ->pluck('tanggal');

        $pdf = app('dompdf.wrapper')
            ->loadView('absensi.pdf', compact('pelatihan', 'tanggalList'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('rekap-absensi-' . $pelatihan->nama_pelatihan . '.pdf');
    }
}
