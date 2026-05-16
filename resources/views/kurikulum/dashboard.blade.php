@extends('admin.layouts.app')

@section('title', 'Kurikulum - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-0">Dashboard Kurikulum</h4>
                <p class="text-muted mb-0">Selamat datang di panel kurikulum dengan tampilan yang sama seperti admin.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Selamat Datang, {{ $kurikulum->nama_guru }}!</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">NIP/NUPTK: <strong>{{ $kurikulum->nip }}</strong></p>
                        <p class="mb-2">Jabatan: <span
                                class="badge bg-info text-dark">{{ ucfirst($kurikulum->jabatan) }}</span></p>
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Anda login sebagai <strong>Kurikulum</strong> dengan akses khusus untuk pengelolaan kurikulum.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        @if ($kurikulum->gambar)
                            <img src="{{ asset('storage/' . $kurikulum->gambar) }}" alt="Foto Profil"
                                class="img-fluid rounded-circle mb-3"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 100px; height: 100px;">
                                <i class="bi bi-person-circle fs-2 text-muted"></i>
                            </div>
                        @endif
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-outline-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
