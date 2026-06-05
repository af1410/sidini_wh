@extends('ortu.layouts.app')

@section('title', 'Orang Tua - Dashboard')

@section('sidebar')
    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-section-title">MENU UTAMA</li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('ortu.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MONITORING ANAK</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark"></i> <span>Nilai Anak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-check-circle"></i> <span>Presensi Anak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar2-week"></i> <span>Jadwal Belajar</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">KOMUNIKASI</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-chat-dots"></i> <span>Pesan dari Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-megaphone"></i> <span>Pengumuman Sekolah</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">LAPORAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-pdf"></i> <span>Rapor Anak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-trophy"></i> <span>Prestasi Anak</span>
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
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Dashboard Orang Tua</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Gunakan dashboard ini untuk memantau perkembangan akademik anak Anda.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text fs-1 text-primary"></i>
                        <h6 class="mt-3">Nilai Anak</h6>
                        <p class="text-muted">Lihat nilai harian dan rapor.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                        <h6 class="mt-3">Presensi Anak</h6>
                        <p class="text-muted">Pantau kehadiran anak di sekolah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-dots fs-1 text-warning"></i>
                        <h6 class="mt-3">Pesan Guru</h6>
                        <p class="text-muted">Cek komunikasi dan pengumuman.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-info">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-info"></i>
                        <h6 class="mt-3">Monitoring Anak</h6>
                        <p class="text-muted">Pantau perkembangan akademik dan sosial.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
