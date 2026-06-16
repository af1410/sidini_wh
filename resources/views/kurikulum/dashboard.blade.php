@extends('admin.layouts.app')

@section('title', 'Kurikulum - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-0">Dashboard Kurikulum</h4>
                <p class="text-muted mb-0">Panel khusus untuk mengelola kurikulum, penilaian, dan materi pembelajaran.</p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Selamat Datang di Dashboard Kurikulum</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Gunakan dashboard ini untuk mengatur standar kurikulum, penilaian, dan materi pembelajaran.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-bookmark fs-1 text-primary me-1"></i>
                        <h6 class="mt-3">Rencana Kurikulum</h6>
                        <p class="text-muted">Buat dan tinjau rencana pembelajaran.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-text fs-1 text-success me-1"></i>
                        <h6 class="mt-3">Penilaian</h6>
                        <p class="text-muted">Kelola penilaian kelas dan bahan ajar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-book-half fs-1 text-warning me-1"></i>
                        <h6 class="mt-3">Materi</h6>
                        <p class="text-muted">Sunting materi pembelajaran sekolah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 border-info">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-info me-1"></i>
                        <h6 class="mt-3">Koordinasi Guru</h6>
                        <p class="text-muted">Sinkronkan standar dengan para guru.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
