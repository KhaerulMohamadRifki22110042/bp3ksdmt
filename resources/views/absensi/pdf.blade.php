<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            text-align: center;
            font-weight: bold;
        }

        td {
            text-align: center;
        }

        .left {
            text-align: left;
        }
    </style>
</head>
<body>

<h3>
    REKAP ABSENSI PESERTA<br>
    {{ $pelatihan->nama_pelatihan }}
</h3>

<table>
    <thead>
        {{-- HEADER BARIS 1 --}}
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Jurusan</th>
            <th colspan="{{ $tanggalList->count() }}">Tanggal</th>
        </tr>

        {{-- HEADER BARIS 2 --}}
        <tr>
            @foreach($tanggalList as $tgl)
                <th>
                    {{ \Carbon\Carbon::parse($tgl)->format('d-M-y') }}
                </th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        @foreach($pelatihan->pesertas as $peserta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="left">{{ $peserta->nama }}</td>
                <td class="left">{{ $peserta->jurusan }}</td>

                @foreach($tanggalList as $tgl)
                    @php
                        $absen = $peserta->absensis
                            ->where('tanggal', $tgl)
                            ->first();

                        $kode = '-';
                        if ($absen) {
                            if ($absen->status === 'Hadir') $kode = 'H';
                            elseif ($absen->status === 'Alpha') $kode = 'A';
                            elseif ($absen->status === 'Izin') $kode = 'I';
                        }
                    @endphp
                    <td>{{ $kode }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<p>
    <b>Keterangan:</b><br>
    H = Hadir<br>
    I = Izin<br>
    A = Alpha
</p>

</body>
</html>
