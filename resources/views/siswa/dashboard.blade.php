@extends('siswa.layouts.app')

@section('title', 'Siswa - Dashboard')

@section('sidebar')
    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
        <ul class="nav flex-column">
            <li class="nav-section-title">MENU UTAMA</li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('siswa.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">AKADEMIK</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark"></i> <span>Nilai Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-check-circle"></i> <span>Presensi Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar2-week"></i> <span>Jadwal Pelajaran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-book"></i> <span>Tugas</span>
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
                    <i class="bi bi-megaphone"></i> <span>Pengumuman</span>
                </a>
            </li>

            <li class="nav-section-title mt-3">TAMBAHAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-pdf"></i> <span>Download Rapor</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-award"></i> <span>Prestasi</span>
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
                    <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard Siswa</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h5>Selamat Datang, {{ $siswa->nama_siswa }}!</h5>
                            <p class="text-muted mb-0">NIS: {{ $siswa->nis }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span
                                class="badge bg-primary fs-6">{{ $siswa->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Informasi Pribadi</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIS:</strong></td>
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIK:</strong></td>
                                    <td>{{ $siswa->nik }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin:</strong></td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Lahir:</strong></td>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir:</strong></td>
                                    <td>{{ $siswa->tanggal_lahir }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Kontak</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $siswa->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. HP:</strong></td>
                                    <td>{{ $siswa->no_hp ?? 'Belum diisi' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat:</strong></td>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
