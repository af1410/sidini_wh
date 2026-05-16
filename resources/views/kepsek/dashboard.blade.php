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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Dashboard Kepala Sekolah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Selamat Datang Bapak/Ibu Kepala Sekolah, {{ $kepsek->nama_guru }}!</h5>
                                <p class="text-muted">NIP: {{ $kepsek->nip }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>

                        <hr>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Anda login sebagai <strong>Kepala Sekolah</strong>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pribadi</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ $kepsek->nama_guru }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIP:</strong></td>
                                        <td>{{ $kepsek->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIK:</strong></td>
                                        <td>{{ $kepsek->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $kepsek->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat Lahir:</strong></td>
                                        <td>{{ $kepsek->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir:</strong></td>
                                        <td>{{ $kepsek->tanggal_lahir }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Kontak</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $kepsek->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. HP:</strong></td>
                                        <td>{{ $kepsek->no_hp ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat:</strong></td>
                                        <td>{{ $kepsek->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jabatan:</strong></td>
                                        <td><span
                                                class="badge bg-danger">{{ ucfirst(str_replace('_', ' ', $kepsek->jabatan)) }}</span>
                                        </td>
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
