@extends('guru.layouts.app')

@section('title', 'Guru - Dashboard')

@section('sidebar')
    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-section-title">MENU UTAMA</li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MANAJEMEN SISWA</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-people"></i> <span>Daftar Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i> <span>Input Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-check-circle"></i> <span>Presensi Siswa</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">MANAJEMEN KELAS</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar2-week"></i> <span>Jadwal Mengajar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-book"></i> <span>Materi Pembelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-clipboard-check"></i> <span>Tugas & Ujian</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">LAPORAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart"></i> <span>Laporan Nilai</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-pdf"></i> <span>Rapor Siswa</span>
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
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h5>Selamat Datang, {{ $guru->nama_guru }}!</h5>
                            <p class="text-muted mb-0">NIP: {{ $guru->nip }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="badge bg-success fs-6">{{ ucfirst($guru->jabatan) }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Informasi Pribadi</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $guru->nama_guru }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIP:</strong></td>
                                    <td>{{ $guru->nip }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIK:</strong></td>
                                    <td>{{ $guru->nik }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin:</strong></td>
                                    <td>{{ $guru->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Lahir:</strong></td>
                                    <td>{{ $guru->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir:</strong></td>
                                    <td>{{ $guru->tanggal_lahir }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Kontak</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $guru->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. HP:</strong></td>
                                    <td>{{ $guru->no_hp ?? 'Belum diisi' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat:</strong></td>
                                    <td>{{ $guru->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jabatan:</strong></td>
                                    <td><span class="badge bg-secondary">{{ ucfirst($guru->jabatan) }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
