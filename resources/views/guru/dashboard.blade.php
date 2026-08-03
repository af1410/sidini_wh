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
    @php
        $idGuru = auth()->guard('guru')->user()->id_guru;

        $punyaKelas = \App\Models\Kelas::where('id_guru', $idGuru)->exists();
        $punyaMapel = \App\Models\GuruMapel::where('id_guru', $idGuru)->exists();
    @endphp

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
        }

        .hero-card h3 {
            font-weight: 700;
        }

        .hero-badge {
            background: rgba(255, 255, 255, .2);
            color: #fff;
            border-radius: 30px;
            padding: .45rem 1rem;
            font-size: .9rem;
        }

        .hero-icon {
            font-size: 90px;
            opacity: .15;
        }

        .menu-card {
            border: none;
            border-radius: 16px;
            transition: .3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
        }

        .menu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(41, 171, 135, .18);
        }

        .menu-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--light-primary);
            color: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            font-size: 30px;
        }

        .menu-title {
            font-weight: 600;
            color: #333;
        }

        .menu-desc {
            font-size: .9rem;
            color: #777;
        }
    </style>

    <div class="container-fluid">

        <div class="mb-4">
            <h3 class="fw-bold">Dashboard</h3>
        </div>

        <div class="card hero-card shadow-sm mb-4">
            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="mb-2">
                            Selamat Datang
                        </h3>

                        <p class="mb-3">
                            Gunakan menu berikut untuk mengelola nilai, presensi, dan aktivitas pembelajaran.
                        </p>

                        <span class="hero-badge">
                            @if ($punyaKelas)
                                Wali Kelas
                            @else
                                {{ ucfirst($guru->jabatan) }}
                            @endif
                        </span>

                    </div>

                    <div class="col-md-4 text-end d-none d-md-block">

                        <i class="bi bi-mortarboard-fill hero-icon"></i>

                    </div>

                </div>

            </div>
        </div>

        <div class="row g-4">

            @if ($punyaMapel)
                <div class="col-md-4">
                    <a href="{{ route('guru.mapel.index') }}" class="text-decoration-none">

                        <div class="card menu-card h-100">

                            <div class="card-body text-center p-4">

                                <div class="menu-icon">
                                    <i class="bi bi-book"></i>
                                </div>

                                <h5 class="menu-title mt-3">
                                    Mata Pelajaran Saya
                                </h5>

                                <div class="menu-desc">
                                    Kelola mata pelajaran yang Anda ampu.
                                </div>

                            </div>

                        </div>

                    </a>
                </div>
            @endif

            @if ($punyaKelas)
                <div class="col-md-4">
                    <a href="{{ route('guru.kelas.index') }}" class="text-decoration-none">

                        <div class="card menu-card h-100">

                            <div class="card-body text-center p-4">

                                <div class="menu-icon">
                                    <i class="bi bi-building"></i>
                                </div>

                                <h5 class="menu-title mt-3">
                                    Kelas Saya
                                </h5>

                                <div class="menu-desc">
                                    Lihat data kelas yang menjadi wali kelas.
                                </div>

                            </div>

                        </div>

                    </a>
                </div>
            @endif

            <div class="col-md-4">
                <a href="{{ route('guru.profile.edit') }}" class="text-decoration-none">

                    <div class="card menu-card h-100">

                        <div class="card-body text-center p-4">

                            <div class="menu-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>

                            <h5 class="menu-title mt-3">
                                Profil
                            </h5>

                            <div class="menu-desc">
                                Kelola informasi akun dan profil Anda.
                            </div>

                        </div>

                    </div>

                </a>
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
