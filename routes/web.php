<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\PresensiController as SiswaPresensiController;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilaiController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\KelasMapelController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\OrtuController as AdminOrtuController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\MapelController as AdminMapelController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\ApprovalNilaiController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboard;
use App\Http\Controllers\Kurikulum\DashboardController as KurikulumDashboard;
use App\Http\Controllers\Ortu\DashboardController as OrtuDashboard;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Guru\NilaiController;
use App\Http\Controllers\Guru\PresensiController as GuruPresensiController;
use App\Http\Controllers\Guru\KelasSayaController;
use App\Http\Controllers\Guru\MapelSayaController;
use App\Http\Controllers\Guru\NilaiFormatifController;
use App\Http\Controllers\Guru\NilaiSumatifController;
use App\Http\Controllers\Guru\NilaiSumatifUjianController;
use App\Http\Controllers\Guru\ProfileController as GuruProfileController;
use App\Http\Controllers\Guru\NilaiAkhirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Siswa Routes
Route::middleware('is_siswa')->group(function () {
    Route::get('/siswa/dashboard', [SiswaDashboard::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/nilai/index', [SiswaNilaiController::class, 'index'])->name('siswa.nilai.index');
    Route::get('/siswa/presensi', [SiswaPresensiController::class, 'index'])->name('siswa.presensi.index');
    Route::get('/siswa/profile', [SiswaProfileController::class, 'index'])->name('siswa.profile.index');
    Route::get('/siswa/profile/edit', [SiswaProfileController::class, 'edit'])->name('siswa.profile.edit');
    Route::put('/siswa/profile', [SiswaProfileController::class, 'update'])->name('siswa.profile.update');
    // student nilai details and export
});

// Guru Routes
Route::middleware('is_guru')->group(function () {
    Route::get('/guru/dashboard', [GuruDashboard::class, 'dashboard'])->name('guru.dashboard');

    //nilai
    Route::get('guru/nilai/', [NilaiController::class, 'index'])->name('guru.nilai.index');
    Route::get('guru/nilai/{idPembukaan}/detail', [NilaiController::class, 'show'])->name('guru.nilai.show');
    Route::get('guru/nilai/export', [NilaiController::class, 'exportCsv'])->name('guru.nilai.export');
    Route::post('guru/nilai/{idPembukaan}/request-approval', [NilaiController::class, 'requestApproval'])->name('guru.nilai.requestApproval');
    Route::get('guru/nilai/formatif/{idPembukaan}', [NilaiController::class, 'createFormatif'])->name('guru.nilai.formatif.create');
    Route::post('guru/nilai/formatif', [NilaiController::class, 'storeFormatif'])->name('guru.nilai.formatif.store');
    Route::get('guru/nilai/sumatif/{idPembukaan}', [NilaiController::class, 'createSumatif'])->name('guru.nilai.sumatif.create');
    Route::post('guru/nilai/sumatif', [NilaiController::class, 'storeSumatif'])->name('guru.nilai.sumatif.store');
    Route::get('/guru/presensi', [GuruPresensiController::class, 'index'])->name('guru.presensi.index');
    Route::post('/guru/presensi/status/{id_siswa}', [GuruPresensiController::class, 'markStatus'])->name('guru.presensi.status');

    //kelas_saya
    Route::get('guru/kelas_saya', [KelasSayaController::class, 'index'])
        ->name('guru.kelas.index');
    Route::get('guru/kelas_saya/rapor', [KelasSayaController::class, 'raporIndex'])
        ->name('guru.kelas.rapor.index');
    Route::get('guru/kelas_saya/rapor/all', [KelasSayaController::class, 'downloadAllRapor'])
        ->name('guru.kelas.rapor.download_all');
    Route::get('guru/kelas_saya/rapor/{id_siswa}', [KelasSayaController::class, 'raporPdf'])
        ->name('guru.kelas.rapor.pdf');
    Route::get('guru/kelas_saya/rapor/{id_siswa}/download', [KelasSayaController::class, 'raporPdfDownload'])
        ->name('guru.kelas.rapor.download');

    //mapel_saya
    Route::get('guru/mapel_saya', [MapelSayaController::class, 'index'])
        ->name('guru.mapel.index');
    Route::get('guru/mapel_saya/{id_mapel}', [MapelSayaController::class, 'show'])
        ->name('guru.mapel.show');

    //nilai formatif
    Route::get(
        'guru/nilai-formatif/{id_kelas}/{id_mapel}',
        [NilaiFormatifController::class, 'show']
    )->name('guru.nilai_formatif.show');

    Route::post(
        'guru/nilai-formatif/store',
        [NilaiFormatifController::class, 'store']
    )->name('guru.nilai_formatif.store');

    Route::get(
        'guru/nilai-formatif/{id}/bab-baru',
        [NilaiFormatifController::class, 'tambahBab']
    )->name('guru.nilai_formatif.tambah_bab');

    Route::get(
        'guru/nilai-formatif/{id}/bab/{bab}/pertemuan-baru',
        [NilaiFormatifController::class, 'tambahPertemuan']
    )->name('guru.nilai_formatif.tambah_pertemuan');

    //Nilai Sumatif
    Route::get(
        'guru/nilai-sumatif/{id_kelas}/{id_mapel}',
        [NilaiSumatifController::class, 'show']
    )->name('guru.nilai_sumatif.show');

    Route::post(
        'guru/nilai-sumatif/store',
        [NilaiSumatifController::class, 'store']
    )->name('guru.nilai_sumatif.store');

    Route::post(
        '/guru/nilai-sumatif/{id_kelas}/{id_mapel}/tambah-bab',
        [NilaiSumatifController::class, 'tambahBab']
    )->name('guru.nilai_sumatif.tambah_bab');

    Route::get(
        '/nilai-sumatif/export/{id_kelas}/{id_mapel}',
        [NilaiSumatifController::class, 'export']
    )->name('guru.nilai_sumatif.export');

    //sumatif ujian
    Route::get(
        '/guru/nilai/sumatif-ujian/{id}',
        [NilaiSumatifUjianController::class, 'create']
    )->name('guru.nilai.sumatif_ujian.create');

    Route::post(
        '/guru/nilai/sumatif-ujian',
        [NilaiSumatifUjianController::class, 'store']
    )->name('guru.nilai.sumatif_ujian.store');

    Route::get(
        '/guru/nilai/sumatif-ujian/{id}/show',
        [NilaiSumatifUjianController::class, 'show']
    )->name('guru.nilai.sumatif_ujian.show');

    //nilai akhir
    Route::get(
        '/guru/nilai-akhir/{id_kelas}/{id_mapel}',
        [NilaiAkhirController::class, 'show']
    )->name('guru.nilai_akhir.show');
    Route::get(
        '/guru/nilai-akhir/{id_kelas}/{id_mapel}/export',
        [NilaiAkhirController::class, 'exportExcel']
    )->name('guru.nilai_akhir.export');
    Route::post(
        '/guru/nilai-akhir/{id_kelas}/{id_mapel}/store',
        [NilaiAkhirController::class, 'store']
    )->name('guru.nilai_akhir.store');

    //profile

    Route::get('/guru/profile', [GuruProfileController::class, 'index'])->name('guru.profile.index');
    Route::get('/guru/profile/edit', [GuruProfileController::class, 'edit'])->name('guru.profile.edit');
    Route::put('/guru/profile', [GuruProfileController::class, 'update'])->name('guru.profile.update');
});

// Admin Routes
Route::middleware('is_admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/siswa', AdminSiswaController::class, ['as' => 'admin'])->except(['show']);
    Route::post('/admin/siswa/{siswa}/reset-password', [AdminSiswaController::class, 'resetPassword'])->name('admin.siswa.reset-password');
    Route::resource('/admin/kelas', AdminKelasController::class, ['as' => 'admin', 'parameters' => ['kelas' => 'kelas']])->except(['show']);
    Route::resource('/admin/guru', AdminGuruController::class, ['as' => 'admin'])->except(['show']);
    Route::post('/admin/guru/{guru}/reset-password', [AdminGuruController::class, 'resetPassword'])->name('admin.guru.reset-password');
    Route::resource('/admin/ortu', AdminOrtuController::class, ['as' => 'admin'])->except(['show']);
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    //penilaian routes 
    Route::get('/admin/penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian.index');
    Route::get('/admin/penilaian/create', [PenilaianController::class, 'create'])->name('admin.penilaian.create');
    Route::post('/admin/penilaian', [PenilaianController::class, 'store'])->name('admin.penilaian.store');
    Route::get('/admin/penilaian/{id}', [PenilaianController::class, 'show'])->name('admin.penilaian.show');
    Route::get('/admin/penilaian/{id}/edit', [PenilaianController::class, 'edit'])->name('admin.penilaian.edit');
    Route::put('/admin/penilaian/{id}', [PenilaianController::class, 'update'])->name('admin.penilaian.update');
    Route::delete('/admin/penilaian/{id}', [PenilaianController::class, 'destroy'])->name('admin.penilaian.destroy');
    Route::post('/admin/penilaian/approve/{id}', [PenilaianController::class, 'approve'])->name('admin.penilaian.approve');
    Route::post('/admin/penilaian/tolak/{id}', [PenilaianController::class, 'tolak'])->name('admin.penilaian.tolak');

    //mapel
    Route::get('/admin/mapel', [AdminMapelController::class, 'index'])->name('admin.mapel.index');
    Route::get('/admin/mapel/create', [AdminMapelController::class, 'create'])->name('admin.mapel.create');
    Route::post('/admin/mapel', [AdminMapelController::class, 'store'])->name('admin.mapel.store');
    Route::get('/admin/mapel/{id}/edit', [AdminMapelController::class, 'edit'])->name('admin.mapel.edit');
    Route::put('/admin/mapel/{id}', [AdminMapelController::class, 'update'])->name('admin.mapel.update');
    Route::delete('/admin/mapel/{id}', [AdminMapelController::class, 'destroy'])->name('admin.mapel.destroy');

    // presensi routes
    Route::get('/admin/presensi', [PresensiController::class, 'index'])->name('admin.presensi.index');
    Route::post('/admin/presensi/scan', [PresensiController::class, 'scan'])->name('admin.presensi.scan');

    // kelas-mapel routes
    Route::get('/admin/kelas/{id_kelas}/mapel', [KelasMapelController::class, 'index'])->name('admin.kelas.mapel.index');
    Route::put('/admin/kelas/{id_kelas}/mapel', [KelasMapelController::class, 'update'])->name('admin.kelas.mapel.update');

    //notifikasi
    Route::get(
        '/admin/approval',
        [ApprovalNilaiController::class, 'index']
    )->name('admin.approval.index');

    Route::post(
        '/admin/approval/{id}/approve',
        [ApprovalNilaiController::class, 'approve']
    )->name('admin.approval.approve');

    Route::post(
        '/admin/approval/{id}/reject',
        [ApprovalNilaiController::class, 'reject']
    )->name('admin.approval.reject');
});

// Kepsek Routes
Route::middleware('is_kepsek')->group(function () {
    Route::get('/kepsek/dashboard', [KepsekDashboard::class, 'dashboard'])->name('kepsek.dashboard');
});

// Kurikulum Routes
Route::middleware('is_kurikulum')->group(function () {
    Route::get('/kurikulum/dashboard', [KurikulumDashboard::class, 'dashboard'])->name('kurikulum.dashboard');
});

// Ortu Routes
Route::middleware('is_ortu')->group(function () {
    Route::get('/ortu/dashboard', [OrtuDashboard::class, 'dashboard'])->name('ortu.dashboard');
});

Route::view(
    '/fitur-belum-tersedia',
    'errors.fitur-belum-tersedia'
)->name('fitur.belum_tersedia');

Route::fallback(function () {
    return response()->view(
        'errors.fitur-belum-tersedia',
        [],
        404
    );
});
