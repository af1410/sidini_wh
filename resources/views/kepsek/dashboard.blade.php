@extends('kepsek.layouts.app')

@section('title', 'Kepala Sekolah - Dashboard')

@section('sidebar')
    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-section-title">MENU UTAMA</li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('kepsek.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MONITORING AKADEMIK</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart"></i> <span>Statistik Akademik</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-trophy"></i> <span>Prestasi Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-check-circle"></i> <span>Laporan Presensi</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MANAJEMEN GURU</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-badge"></i> <span>Data Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar2-week"></i> <span>Jadwal Mengajar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-award"></i> <span>Penilaian Guru</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">LAPORAN KEPEMIMPINAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i> <span>Laporan Tahunan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-pdf"></i> <span>Rapor Akhir</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-graph-up"></i> <span>Analisis Data</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Dashboard Kepala Sekolah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-8">
                                <h5>Selamat Datang di Dashboard Kepala Sekolah</h5>
                                <p class="text-muted mb-0">Pantau kinerja akademik dan agenda sekolah di sini.</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Anda login sebagai <strong>Kepala Sekolah</strong>. Pantau kinerja akademik dan agenda sekolah
                            di sini.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-bar-chart fs-1 text-primary"></i>
                        <h6 class="mt-3">Statistik Akademik</h6>
                        <p class="text-muted">Lihat ringkasan performa sekolah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-success"></i>
                        <h6 class="mt-3">Data Guru</h6>
                        <p class="text-muted">Kelola informasi guru dan jadwal mengajar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text fs-1 text-warning"></i>
                        <h6 class="mt-3">Laporan Tahunan</h6>
                        <p class="text-muted">Buka laporan evaluasi tahunan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-danger">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up fs-1 text-danger"></i>
                        <h6 class="mt-3">Analisis Data</h6>
                        <p class="text-muted">Analisis hasil dan perkembangan sekolah.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
