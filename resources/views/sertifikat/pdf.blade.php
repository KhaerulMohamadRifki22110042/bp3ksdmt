<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sertifikat</title>

<style>
@page {
    size: A4 landscape;
    margin: 0;
}

body {
    margin: 0;
    font-family: "Times New Roman", serif;
}

/* Background */
.bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Isi sertifikat */
.container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top: 80px;
}

.logo img {
    width: 90px;
}

/* Judul */
.title {
    font-size: 48px;
    font-weight: bold;
    letter-spacing: 4px;
}

.subtitle {
    font-size: 20px;
    margin-top: -10px;
}

/* Divider */
.divider {
    width: 320px;
    height: 30px;
    background: #222;
    color: #fff;
    margin: 20px auto;
    line-height: 30px;
    border-radius: 20px;
    font-size: 16px;
}

/* Nama */
.nama {
    font-size: 42px;
    font-weight: bold;
    margin: 25px 0;
}

/* Deskripsi */
.deskripsi {
    font-size: 18px;
    width: 75%;
    margin: auto;
    line-height: 1.6;
}

/* Tanda tangan */
.ttd {
    position: absolute;
    bottom: 90px;
    width: 100%;
    text-align: center;
}

.ttd .nama-ttd {
    margin-top: 80px;
    font-weight: bold;
    text-decoration: underline;
}
</style>
</head>

<body>

<!-- BACKGROUND -->
<img src="{{ public_path('images/bgg.png') }}" class="bg">

<div class="container">

    <!-- LOGO -->
    <div class="logo">
        <img src="{{ public_path('logo.png') }}">
    </div>


    <!-- JUDUL -->
    <div class="title">SERTIFIKAT</div>
    <div class="subtitle">Apresiasi</div>

    <!-- DIPERSEMBAHKAN -->
    <div class="divider">Dipersembahkan Untuk</div>

    <!-- NAMA -->
    <div class="nama">{{ $peserta->nama }}</div>

    <div class="deskripsi">
        Telah melakukan Pelatihan {{ $pelatihan->nama_pelatihan }} di Balai Pendidikan dan Pelatihan
        Pembangunan Karakter Sumber Daya Manusia Transportasi, Kementerian Perhubungan
        yang dimulai dari
        <b>{{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}</b>
        sampai dengan
        <b>{{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}</b>.
    </div>

    <div class="ttd">
        <div class="nama-ttd">
            Eko Sudarmanto, M.Pd., M.Mar.E.
        </div>
        <div>Kepala BP3KSDMT</div>
    </div>

</div>

</body>
</html>
