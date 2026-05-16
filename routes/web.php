<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\KelasMapelController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\MapelController as AdminMapelController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboard;
use App\Http\Controllers\Kurikulum\DashboardController as KurikulumDashboard;
use App\Http\Controllers\Ortu\DashboardController as OrtuDashboard;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Guru\NilaiController;
use App\Http\Controllers\Guru\PresensiController as GuruPresensiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Siswa Routes
Route::middleware('is_siswa')->group(function () {
    Route::get('/siswa/dashboard', [SiswaDashboard::class, 'dashboard'])->name('siswa.dashboard');
});

// Guru Routes
Route::middleware('is_guru')->group(function () {
    Route::get('/guru/dashboard', [GuruDashboard::class, 'dashboard'])->name('guru.dashboard');

    //nilai
    Route::get('guru/nilai/', [NilaiController::class, 'index'])->name('guru.nilai.index');
    Route::get('guru/nilai/{idPembukaan}/detail', [NilaiController::class, 'show'])->name('guru.nilai.show');
    Route::post('guru/nilai/{idPembukaan}/request-approval', [NilaiController::class, 'requestApproval'])->name('guru.nilai.requestApproval');
    Route::get('guru/nilai/formatif/{idPembukaan}', [NilaiController::class, 'createFormatif'])->name('guru.nilai.formatif.create');
    Route::post('guru/nilai/formatif', [NilaiController::class, 'storeFormatif'])->name('guru.nilai.formatif.store');
    Route::get('guru/nilai/sumatif/{idPembukaan}', [NilaiController::class, 'createSumatif'])->name('guru.nilai.sumatif.create');
    Route::post('guru/nilai/sumatif', [NilaiController::class, 'storeSumatif'])->name('guru.nilai.sumatif.store');
    Route::get('/guru/presensi', [GuruPresensiController::class, 'index'])->name('guru.presensi.index');
    Route::post('/guru/presensi/status/{id_siswa}', [GuruPresensiController::class, 'markStatus'])->name('guru.presensi.status');
});

// Admin Routes
Route::middleware('is_admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/siswa', AdminSiswaController::class, ['as' => 'admin'])->except(['show']);
    Route::resource('/admin/kelas', AdminKelasController::class, ['as' => 'admin', 'parameters' => ['kelas' => 'kelas']])->except(['show']);
    Route::resource('/admin/guru', AdminGuruController::class, ['as' => 'admin'])->except(['show']);
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
