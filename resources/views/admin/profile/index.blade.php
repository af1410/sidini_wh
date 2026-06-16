@extends('admin.layouts.app')

@section('title', 'Admin - Profile')

@section('content')
    <div class="container-fluid">

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Profil Admin</h3>
                <p class="text-muted mb-0">
                    Kelola informasi pribadi dan foto profil Anda.
                </p>
            </div>

            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-1"></i>
                Edit Profil
            </a>
        </div>

        <div class="row g-4">

            {{-- Card Profil --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm overflow-hidden">

                    <div style="background-color: var(--primary-color);height:100px;"></div>

                    <div class="card-body text-center mt-n5">

                        @if ($admin->gambar)
                            <img src="{{ asset('storage/' . $admin->gambar) }}"
                                class="rounded-circle border border-4 border-white shadow" width="140" height="140"
                                style="object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-light border border-4 border-white shadow d-flex align-items-center justify-content-center mx-auto"
                                style="width:140px;height:140px;">
                                <i class="bi bi-person-fill text-secondary me-1" style="font-size:4rem;"></i>
                            </div>
                        @endif

                        <h4 class="mt-3 mb-1 fw-bold">
                            {{ $admin->nama_guru }}
                        </h4>

                        <span class="badge bg-warning text-dark px-3 py-2">
                            {{ ucfirst($admin->jabatan) }}
                        </span>

                        <div class="mt-3">
                            <small class="text-muted d-block">NIP</small>
                            <strong>{{ $admin->nip }}</strong>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Informasi Pribadi --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">

                    <div class="card-header">

                        <h5 class="fw-bold mb-0"><i class="bi bi-person-vcard me-2"></i> Informasi Pribadi</h5>

                    </div>


                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i> Nama Lengkap
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->nama_guru }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-credit-card me-1"></i> NIK
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->nik }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-gender-ambiguous me-1"></i>
                                        Jenis Kelamin
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->jenis_kelamin }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        Tempat Lahir
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->tempat_lahir }}
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        Tanggal Lahir
                                    </small>
                                    <div class="fw-semibold">
                                        {{ \Carbon\Carbon::parse($admin->tanggal_lahir)->translatedFormat('d F Y') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-envelope me-1"></i>
                                        Email
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->email }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-telephone me-1"></i>
                                        No. HP
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->no_hp ?? 'Belum diisi' }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-house me-1"></i>
                                        Alamat
                                    </small>
                                    <div class="fw-semibold">
                                        {{ $admin->alamat }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
