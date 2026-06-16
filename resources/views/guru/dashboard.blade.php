@extends('guru.layouts.app')

@section('title', 'Guru - Dashboard')

@section('sidebar')
    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="bi bi-chevron-left me-1"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-section-title">MENU UTAMA</li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                    <i class="bi bi-speedometer2 me-1"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MANAJEMEN SISWA</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-people me-1"></i> <span>Daftar Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.nilai.index') }}">
                    <i class="bi bi-file-earmark-text me-1"></i> <span>Input Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.presensi.index') }}">
                    <i class="bi bi-check-circle me-1"></i> <span>Presensi Siswa</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MANAJEMEN KELAS</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar2-week me-1"></i> <span>Jadwal Mengajar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-book me-1"></i> <span>Materi Pembelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-clipboard-check me-1"></i> <span>Tugas & Ujian</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">LAPORAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart me-1"></i> <span>Laporan Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-pdf me-1"></i> <span>Rapor Siswa</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard Guru</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-8">
                            <h5>Selamat Datang di Dashboard Guru</h5>
                            <p class="text-muted mb-0">Gunakan menu ini untuk mengelola nilai dan presensi siswa.</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-success fs-6">{{ ucfirst($guru->jabatan) }}</span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-pencil-square fs-1 text-primary me-1"></i>
                                    <h6 class="mt-3">Input Nilai</h6>
                                    <p class="text-muted">Tambahkan nilai formatif dan sumatif siswa.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-success">
                                <div class="card-body text-center">
                                    <i class="bi bi-check2-square fs-1 text-success me-1"></i>
                                    <h6 class="mt-3">Presensi</h6>
                                    <p class="text-muted">Kelola kehadiran harian siswa Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-warning">
                                <div class="card-body text-center">
                                    <i class="bi bi-file-earmark-medical fs-1 text-warning me-1"></i>
                                    <h6 class="mt-3">Laporan Nilai</h6>
                                    <p class="text-muted">Pantau riwayat dan status penilaian.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
