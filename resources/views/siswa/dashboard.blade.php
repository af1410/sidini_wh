@extends('siswa.layouts.app')

@section('title', 'Siswa - Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-8">
                            <h5>Selamat Datang di Dashboard Siswa</h5>
                            <p class="text-muted mb-0">Cek nilai, presensi, jadwal, dan pengumuman sekolah di sini.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span
                                class="badge bg-primary fs-6">{{ $siswa->dataKelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-file-earmark-text fs-1 text-primary me-1"></i>
                                    <h6 class="mt-3">Nilai Saya</h6>
                                    <p class="text-muted">Lihat ringkasan nilai terbaru.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('siswa.presensi.index') }}" class="text-decoration-none">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center">
                                        <i class="bi bi-check2-square fs-1 text-success me-1"></i>
                                        <h6 class="mt-3">Presensi</h6>
                                        <p class="text-muted">Cek kehadiran harian Anda.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100 border-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-calendar3 fs-1 text-warning me-1"></i>
                                    <h6 class="mt-3">Jadwal</h6>
                                    <p class="text-muted">Lihat jadwal pelajaran kelas Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100 border-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-megaphone fs-1 text-info me-1"></i>
                                    <h6 class="mt-3">Pengumuman</h6>
                                    <p class="text-muted">Pantau informasi sekolah terbaru.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
