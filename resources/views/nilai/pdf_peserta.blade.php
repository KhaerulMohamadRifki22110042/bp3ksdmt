<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nilai Saya</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .left {
            text-align: left;
        }

        .footer {
            margin-top: 25px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Nilai Pelatihan</h2>
        <p><strong>{{ $pelatihan->nama_pelatihan }}</strong></p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d M Y') }}</p>
    </div>

    <table>
        <tr>
            <th width="30%">Nama Peserta</th>
            <td class="left">{{ $peserta->nama }}</td>
        </tr>
    </table>

    <br>

    <table>
        <thead>
            <tr>
                <th>Interpersonal</th>
                <th>Intrapersonal</th>
                <th>Organisasi</th>
                <th>Spiritual</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $nilai->interpersonal ?? '-' }}</td>
                <td>{{ $nilai->intrapersonal ?? '-' }}</td>
                <td>{{ $nilai->organisasi ?? '-' }}</td>
                <td>{{ $nilai->spiritual ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y') }}
    </div>

</body>
</html>