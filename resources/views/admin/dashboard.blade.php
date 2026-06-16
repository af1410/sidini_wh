@extends('admin.layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-0">Dashboard Admin</h4>
                <p class="text-muted mb-0">Halaman kontrol utama untuk mengelola data penilaian, guru, siswa, dan sistem
                    sekolah.</p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Selamat Datang di Dashboard Admin</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Gunakan menu di bawah untuk mengelola data penilaian, guru, siswa, dan sistem sekolah.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-text fs-1 text-primary me-1"></i>
                        <h6 class="mt-3">Kelola Penilaian</h6>
                        <a href="{{ route('admin.penilaian.index') }}" class="stretched-link text-decoration-none"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-book fs-1 text-success me-1"></i>
                        <h6 class="mt-3">Mata Pelajaran</h6>
                        <a href="{{ route('admin.mapel.index') }}" class="stretched-link text-decoration-none"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-warning me-1"></i>
                        <h6 class="mt-3">Data Guru & Siswa</h6>
                        <a href="#" class="stretched-link text-decoration-none"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-gear fs-1 text-danger me-1"></i>
                        <h6 class="mt-3">Pengaturan Sistem</h6>
                        <a href="#" class="stretched-link text-decoration-none"></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
