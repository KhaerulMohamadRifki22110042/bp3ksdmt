<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PelatihanPesertaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\DokumentasiFolderController;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/home', [DashboardController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| PROFILE (AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| MASTER DATA (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Peserta
    Route::resource('peserta', PesertaController::class);

    // Pelatihan
    Route::resource('pelatihan', PelatihanController::class);

    // Tambah peserta ke pelatihan (pivot)
    Route::get('pelatihan/{id}/peserta', 
        [PelatihanPesertaController::class, 'create'])
        ->name('pelatihan.peserta.create');

    Route::post('pelatihan/{id}/peserta', 
        [PelatihanPesertaController::class, 'store'])
        ->name('pelatihan.peserta.store');

});

/*
|--------------------------------------------------------------------------
| ABSENSI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/absensi', 
        [AbsensiController::class, 'pilihPelatihan'])
        ->name('absensi.pilih');

    Route::get('/absensi/{pelatihan}', 
        [AbsensiController::class, 'create'])
        ->name('absensi.create');

    Route::post('/absensi/{pelatihan}', 
        [AbsensiController::class, 'store'])
        ->name('absensi.store');

    Route::get('/absensi/{pelatihan}/rekap', 
        [AbsensiController::class, 'rekap'])
        ->name('absensi.rekap');

    Route::get('/absensi/{pelatihan}/pdf', 
        [AbsensiController::class, 'pdf'])
        ->name('absensi.pdf');

});

/*
|--------------------------------------------------------------------------
| NILAI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/nilai', 
        [NilaiController::class, 'index'])
        ->name('nilai.index');

    Route::get('/nilai/{pelatihan}', 
        [NilaiController::class, 'create'])
        ->name('nilai.create');

    Route::post('/nilai/{pelatihan}', 
        [NilaiController::class, 'store'])
        ->name('nilai.store');

    Route::get('/nilai/{pelatihan}/rekap', 
        [NilaiController::class, 'rekap'])
        ->name('nilai.rekap');

    Route::get('/nilai/{pelatihan}/pdf', 
        [NilaiController::class, 'pdf'])
        ->name('nilai.pdf');

});

/*
|--------------------------------------------------------------------------
| SERTIFIKAT
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| SERTIFIKAT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // ================= ADMIN =================

    Route::get('/admin/sertifikat', 
        [SertifikatController::class, 'index'])
        ->name('sertifikat.index');

    Route::get('/admin/sertifikat/{pelatihan}', 
        [SertifikatController::class, 'peserta'])
        ->name('sertifikat.peserta');

    Route::get('/admin/sertifikat/{pelatihan}/{peserta}/pdf', 
        [SertifikatController::class, 'pdf'])
        ->name('sertifikat.pdf');

    // ================= PESERTA =================

    Route::get('/sertifikat/{pelatihan}', 
        [SertifikatController::class, 'show'])
        ->name('sertifikat.show');

    Route::get('/sertifikat/{pelatihan}/download', 
        [SertifikatController::class, 'downloadPeserta'])
        ->name('sertifikat.downloadPeserta');

});


/*
|--------------------------------------------------------------------------
| DOKUMENTASI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dokumentasi', 
        [DokumentasiController::class, 'index'])
        ->name('dokumentasi.index');

    Route::get('/dokumentasi/{id}', 
        [DokumentasiController::class, 'show'])
        ->name('dokumentasi.show');

    Route::post('/dokumentasi/folder', 
        [DokumentasiFolderController::class, 'store'])
        ->name('dokumentasi.folder.store');

    Route::get('/kegiatan/{id}/foto/create', 
        [FotoController::class, 'create'])
        ->name('foto.create');

    Route::post('/kegiatan/{id}/foto', 
        [FotoController::class, 'store'])
        ->name('foto.store');

});

/*
|--------------------------------------------------------------------------
| PESERTA - DAFTAR PELATIHAN (TIDAK BENTROK LAGI)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/daftar-pelatihan', 
        [PesertaController::class, 'daftarPelatihan'])
        ->name('peserta.pelatihan');

    Route::post('/daftar-pelatihan/{id}', 
        [PesertaController::class, 'storePelatihan'])
        ->name('peserta.pelatihan.daftar');

});

Route::get('/pelatihan/{id}/peserta', [PelatihanController::class, 'peserta'])
    ->name('pelatihan.peserta');
require __DIR__ . '/auth.php';
