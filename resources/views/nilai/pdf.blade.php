<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nilai Pelatihan</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td.nama {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>Rekap Nilai Pelatihan</h2>
        <p><strong>{{ $pelatihan->nama_pelatihan }}</strong></p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d M Y') }}</p>
    </div>

    <!-- TABEL NILAI -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Peserta</th>
                <th>Interpersonal</th>
                <th>Intrapersonal</th>
                <th>Organisasi</th>
                <th>Spiritual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelatihan->pesertas as $p)
                @php $n = $p->nilais->first(); @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="nama">{{ $p->nama }}</td>
                    <td>{{ $n->interpersonal ?? '-' }}</td>
                    <td>{{ $n->intrapersonal ?? '-' }}</td>
                    <td>{{ $n->organisasi ?? '-' }}</td>
                    <td>{{ $n->spiritual ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y') }}
    </div>

</body>
</html>
