@extends('kepsek.layouts.app')
@section('title', 'Dashboard Kepala Sekolah')
@section('content')
    <style>
        .hero-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 18px;
            color: #fff;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(41, 171, 135, .20);
        }

        .hero-icon {
            font-size: 90px;
            opacity: .15;
        }

        .stat-card {
            border: none;
            border-top: 4px solid var(--primary-color);
            border-radius: 15px;
            transition: .3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(220, 53, 69, .18);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--light-primary);
            color: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
        }

        .menu-card {
            border: none;
            border-radius: 15px;
            transition: .3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(220, 53, 69, .18);
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

        .info-card {
            border: none;
            border-left: 5px solid var(--primary-color);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }
    </style>
    <div class="container-fluid">
        <div class="card hero-card mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold">
                            Selamat Datang,
                            {{ $kepsek->nama_guru }}
                        </h3>
                        <p class="mb-0">
                            Pantau proses persetujuan rapor siswa, data guru, data kelas, dan perkembangan akademik sekolah melalui Sistem Informasi Akademik.
                        </p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="bi bi-person-workspace hero-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Total Guru
                            </small>
                            <h2 class="fw-bold mb-0">
                                {{ $totalGuru }}
                            </h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Total Siswa
                            </small>
                            <h2 class="fw-bold mb-0">
                                {{ $totalSiswa }}
                            </h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Total Kelas
                            </small>
                            <h2 class="fw-bold mb-0">
                                {{ $totalKelas }}
                            </h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="section-title mb-0">
                    Menu Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('kepsek.kelas.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center">
                                    <div class="menu-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h6 class="mt-3 fw-semibold">
                                        Data Kelas
                                    </h6>
                                    <small class="text-muted">
                                        Lihat seluruh data kelas.
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('kepsek.guru.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center">
                                    <div class="menu-icon">
                                        <i class="bi bi-person-video3"></i>
                                    </div>
                                    <h6 class="mt-3 fw-semibold">
                                        Data Guru
                                    </h6>
                                    <small class="text-muted">
                                        Lihat data seluruh guru.
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('kepsek.kelas.index') }}" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center">
                                    <div class="menu-icon">
                                        <i class="bi bi-patch-check"></i>
                                    </div>
                                    <h6 class="mt-3 fw-semibold">
                                        Persetujuan Rapor
                                    </h6>
                                    <small class="text-muted">
                                        Melakukan persetujuan rapor siswa.
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-md-3">
                        <a href="#" class="text-decoration-none">
                            <div class="card menu-card h-100">
                                <div class="card-body text-center">
                                    <div class="menu-icon">
                                        <i class="bi bi-bar-chart-line"></i>
                                    </div>
                                    <h6 class="mt-3 fw-semibold">
                                        Laporan Akademik
                                    </h6>
                                    <small class="text-muted">
                                        Melihat laporan perkembangan akademik.
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="card info-card mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-info-circle me-2 text-danger"></i>
                    Informasi Sistem
                </h5>
                <p class="mb-2">
                    <strong>Sistem Informasi Akademik</strong>
                </p>
                <p class="mb-2 text-muted">
                    Dashboard Kepala Sekolah
                </p>
                <small class="text-muted">
                    Dashboard Kepala Sekolah digunakan untuk memantau data guru, data kelas, proses persetujuan rapor, serta perkembangan akademik siswa secara terintegrasi melalui Sistem Informasi Akademik.
                </small>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: '{{ session('success') }}',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endsection
