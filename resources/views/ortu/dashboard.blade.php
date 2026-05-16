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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Dashboard Orang Tua</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Selamat Datang, {{ $ortu->nama_ortu }}!</h5>
                                <p class="text-muted">NIK: {{ $ortu->nik }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pribadi</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ $ortu->nama_ortu }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIK:</strong></td>
                                        <td>{{ $ortu->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $ortu->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat Lahir:</strong></td>
                                        <td>{{ $ortu->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir:</strong></td>
                                        <td>{{ $ortu->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Kontak</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $ortu->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. HP:</strong></td>
                                        <td>{{ $ortu->no_hp ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat:</strong></td>
                                        <td>{{ $ortu->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
