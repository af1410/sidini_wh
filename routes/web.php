<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\PresensiController as SiswaPresensiController;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilaiController;
use App\Http\Controllers\Siswa\ProfileController as SiswaProfileController;
use App\Http\Controllers\Siswa\RaporSayaController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\KelasMapelController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\OrtuController as AdminOrtuController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\MapelController as AdminMapelController;
use App\Http\Controllers\Admin\RaporController as AdminRaporSiswa;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Admin\ApprovalNilaiController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboard;
use App\Http\Controllers\Kepsek\GuruController as KepsekGuruController;
use App\Http\Controllers\Kepsek\KelasController as KepsekKelasController;
use App\Http\Controllers\Kepsek\ProfileController as KepsekProfileController;
use App\Http\Controllers\Kurikulum\DashboardController as KurikulumDashboard;
use App\Http\Controllers\Ortu\DashboardController as OrtuDashboard;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\TahunAjarController;
use App\Http\Controllers\Guru\NilaiController;
use App\Http\Controllers\Guru\PresensiController as GuruPresensiController;
use App\Http\Controllers\Guru\KelasSayaController;
use App\Http\Controllers\Guru\MapelSayaController;
use App\Http\Controllers\Guru\NilaiFormatifController;
use App\Http\Controllers\Guru\NilaiSumatifController;
use App\Http\Controllers\Guru\NilaiSumatifUjianController;
use App\Http\Controllers\Guru\ProfileController as GuruProfileController;
use App\Http\Controllers\Guru\NilaiAkhirController;
use App\Http\Controllers\Guru\PerlengkapanRaporController;

Route::get('/', function () {
    return redirect()->route('login');
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
    Route::get('/siswa/raporsaya', [RaporSayaController::class, 'index'])->name('siswa.raporsaya.index');
});

// Guru Routes
Route::middleware('is_guru')->group(function () {
    Route::get('/guru/dashboard', [GuruDashboard::class, 'dashboard'])->name('guru.dashboard');

    //nilai
    // Route::get('guru/nilai/', [NilaiController::class, 'index'])->name('guru.nilai.index');
    // Route::get('guru/nilai/{idPembukaan}/detail', [NilaiController::class, 'show'])->name('guru.nilai.show');
    // Route::get('guru/nilai/export', [NilaiController::class, 'exportCsv'])->name('guru.nilai.export');
    // Route::post('guru/nilai/{idPembukaan}/request-approval', [NilaiController::class, 'requestApproval'])->name('guru.nilai.requestApproval');
    // Route::get('guru/nilai/formatif/{idPembukaan}', [NilaiController::class, 'createFormatif'])->name('guru.nilai.formatif.create');
    // Route::post('guru/nilai/formatif', [NilaiController::class, 'storeFormatif'])->name('guru.nilai.formatif.store');
    // Route::get('guru/nilai/sumatif/{idPembukaan}', [NilaiController::class, 'createSumatif'])->name('guru.nilai.sumatif.create');
    // Route::post('guru/nilai/sumatif', [NilaiController::class, 'storeSumatif'])->name('guru.nilai.sumatif.store');
    // Route::get('/guru/presensi', [GuruPresensiController::class, 'index'])->name('guru.presensi.index');
    // Route::post('/guru/presensi/status/{id_siswa}', [GuruPresensiController::class, 'markStatus'])->name('guru.presensi.status');

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
        '/guru/nilai',
        [NilaiSumatifUjianController::class, 'index']
    )->name('guru.nilai.index');

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

    Route::post(
        '/guru/nilai/sumatif-ujian/{id}/request-approval',
        [NilaiSumatifUjianController::class, 'requestApproval']
    )->name('guru.nilai.sumatif_ujian.requestApproval');

    Route::post(
        '/guru/nilai/sumatif-ujian/{id}/request-open',
        [NilaiSumatifUjianController::class, 'requestOpen']
    )->name('guru.nilai.sumatif_ujian.requestOpen');

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

    Route::get(
        '/guru/kelas-saya/perlengkapan_rapor/{id_siswa}',
        [PerlengkapanRaporController::class, 'edit']
    )->name('guru.kelas_saya.lengkapi_rapor');

    Route::put(
        '/guru/kelas-saya/perlengkapan-rapor/{id_siswa}',
        [PerlengkapanRaporController::class, 'update']
    )->name('guru.kelas_saya.lengkapi_rapor.update');


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
    Route::put('/admin/siswa/{siswa}/update-status', [AdminSiswaController::class, 'updateStatus'])->name('admin.siswa.update-status');

    Route::put('/admin/siswa/bulk-status', [AdminSiswaController::class, 'bulkStatus'])->name('admin.siswa.bulk-status');
    Route::resource('/admin/kelas', AdminKelasController::class, ['as' => 'admin', 'parameters' => ['kelas' => 'kelas']])->except(['show']);
    Route::get('admin/kelas/{kelas}/siswa', [AdminKelasController::class, 'siswa'])->name('admin.kelas.siswa');
    Route::get('/admin/kelas/{kelas}/tambah-siswa', [AdminKelasController::class, 'TambahSiswa'])->name('admin.kelas.TambahSiswa');
    Route::post('/admin/kelas/{kelas}/tambah-siswa', [AdminKelasController::class, 'SimpanSiswa'])->name('admin.kelas.SimpanSiswa');
    Route::delete('/admin/kelas/{kelas}/siswa/{siswa}', [AdminKelasController::class, 'HapusSiswa'])->name('admin.kelas.HapusSiswa');
    Route::get('/admin/kelas/{kelas}/siswa/{siswa}/pindah', [AdminKelasController::class, 'PindahSiswa'])->name('admin.kelas.PindahSiswa');
    Route::put('/admin/kelas/{kelas}/siswa/{siswa}/pindah', [AdminKelasController::class, 'UpdatePindahSiswa'])->name('admin.kelas.UpdatePindahSiswa');
    Route::resource('/admin/guru', AdminGuruController::class, ['as' => 'admin'])->except(['show']);
    Route::post('/admin/guru/{guru}/reset-password', [AdminGuruController::class, 'resetPassword'])->name('admin.guru.reset-password');
    Route::put('/admin/guru/{guru}/update-status', [AdminGuruController::class, 'updateStatus'])->name('admin.guru.update-status');
    Route::put('/admin/guru/bulk-status', [AdminGuruController::class, 'bulkStatus'])->name('admin.guru.bulk-status');

    Route::resource('/admin/ortu', AdminOrtuController::class, ['as' => 'admin'])->except(['show']);

    // tahun ajar routes
    Route::resource('/admin/tahun_ajar', TahunAjarController::class, ['as' => 'admin'])->except(['show']);
    Route::post('/admin/tahun_ajar/{tahunAjar}/set-aktif', [TahunAjarController::class, 'setAktif'])->name('admin.tahun_ajar.set-aktif');
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
    Route::post('/penilaian/{id}/bukakembali', [PenilaianController::class, 'bukakembali'])->name('admin.penilaian.bukakembali');
    Route::post('/admin/penilaian/{id}/publish', [PenilaianController::class, 'publish'])->name('admin.penilaian.publish');
    Route::post('/admin/penilaian/bukapenilaian', [PenilaianController::class, 'bukapenilaian'])->name('admin.penilaian.bukapenilaian');
    Route::post('/admin/penilaian/tutuppenilain', [PenilaianController::class, 'tutuppenilain'])->name('admin.penilaian.tutuppenilain');

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

    //Rapor Siswa
    Route::get('/admin/rapor_siswa', [AdminRaporSiswa::class, 'index'])->name('admin.rapor_siswa.index');
    Route::get('/admin/rapor_siswa/{id_kelas}', [AdminRaporSiswa::class, 'show'])->name('admin.rapor_siswa.show');
    Route::get('/admin/rapor_siswa/{id_siswa}/preview', [AdminRaporSiswa::class, 'preview'])->name('admin.rapor_siswa.preview');

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
    Route::get('/kepsek/kelas', [KepsekKelasController::class, 'index'])->name('kepsek.kelas.index');
    Route::get('/kepsek/kelas/{id_kelas}', [KepsekKelasController::class, 'show'])->name('kepsek.kelas.show');
    Route::get('/kepsek/kelas/{id_siswa}/detail-nilai', [KepsekKelasController::class, 'detailNilai'])->name('kepsek.kelas.detailNilai');
    Route::get('/kepsek/rapor_siswa/{id_siswa}/preview', [KepsekKelasController::class, 'preview'])->name('kepsek.rapor_siswa.preview');
    Route::post('/kepsek/rapor_siswa/{id_siswa}/acc', [KepsekKelasController::class, 'acc'])->name('kepsek.rapor_siswa.acc');
    Route::post('/kepsek/rapor_siswa/{id_siswa}/batal-acc', [KepsekKelasController::class, 'batalAcc'])->name('kepsek.rapor_siswa.batalAcc');
    Route::post('/kepsek/rapor-siswa/acc-selected', [KepsekKelasController::class, 'accSelected'])->name('kepsek.rapor_siswa.accSelected');
    Route::post('/kepsek/rapor-siswa/batal-selected', [KepsekKelasController::class, 'batalSelected'])->name('kepsek.rapor_siswa.batalSelected');
    Route::get('/kepsek/guru/index', [KepsekGuruController::class, 'index'])->name('kepsek.guru.index');


    Route::get('/kepsek/profile', [KepsekProfileController::class, 'index'])->name('kepsek.profile.index');
    Route::get('/kepsek/profile/edit', [KepsekProfileController::class, 'edit'])->name('kepsek.profile.edit');
    Route::put('/kepsek/profile', [KepsekProfileController::class, 'update'])->name('kepsek.profile.update');
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
