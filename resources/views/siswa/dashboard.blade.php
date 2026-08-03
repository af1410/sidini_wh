@extends('siswa.layouts.app')

@section('title', 'Siswa - Dashboard')

@section('content')

    <style>
        :root {
            --primary-color: #29ab87;
            --secondary-color: #1e7f5f;
            --light-primary: #eefaf6;
        }

        .hero-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 18px;
            color: #fff;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(41, 171, 135, .20);
        }

        .hero-icon {
            font-size: 85px;
            opacity: .15;
        }

        .kelas-badge {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            border-radius: 30px;
            padding: .6rem 1.2rem;
            font-size: .9rem;
        }

        .menu-card {
            border: none;
            border-radius: 15px;
            transition: .3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(41, 171, 135, .18);
        }

        .menu-icon {
            width: 70px;
            height: 70px;
            margin: auto;
            border-radius: 50%;
            background: var(--light-primary);
            color: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
        }

        .section-title {
            font-weight: 600;
            color: #444;
        }
    </style>

    <div class="container-fluid">
        <div class="card hero-card mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-2">
                            Halo, {{ $siswa->nama_siswa }}
                        </h3>
                        <p class="mb-3">
                            Selamat datang di Sistem Digitalisasi Nilai (SIDINI).
                            Gunakan menu berikut untuk melihat nilai, rapor,
                            dan informasi akun Anda.
                        </p>
                        <span class="kelas-badge">
                            <i class="bi bi-mortarboard-fill me-2"></i>
                            {{ $siswa->dataKelas->nama_kelas ?? '-' }}
                        </span>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="bi bi-mortarboard-fill hero-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="section-title mb-0">
                    <i class="bi bi-grid me-2"></i>
                    Menu Utama
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('siswa.nilai.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="menu-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <h5 class="mt-3">
                                        Nilai Saya
                                    </h5>
                                    <p class="text-muted mb-0">
                                        Lihat seluruh nilai dan hasil belajar.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('siswa.raporsaya.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="menu-icon">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <h5 class="mt-3">
                                        Rapor
                                    </h5>
                                    <p class="text-muted mb-0">
                                        Lihat dan cetak rapor semester.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('siswa.profile.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center p-4">
                                    <div class="menu-icon">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <h5 class="mt-3">
                                        Profil
                                    </h5>
                                    <p class="text-muted mb-0">
                                        Lihat informasi akun siswa.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
