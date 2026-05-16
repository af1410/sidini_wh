@extends('admin.layouts.app')

@section('title', 'Admin - Profile')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Profile Admin</h4>
                    <p class="text-muted mb-0">Kelola informasi pribadi dan foto profil Anda.</p>
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        @if ($admin->gambar)
                            <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Foto Profil"
                                class="img-fluid rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle fs-1 text-muted"></i>
                            </div>
                        @endif
                        <h5>{{ $admin->nama_guru }}</h5>
                        <p class="text-muted mb-1">{{ $admin->jabatan }}</p>
                        <span class="badge bg-warning text-dark">{{ $admin->nip }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>{{ $admin->nama_guru }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIP:</strong></td>
                                            <td>{{ $admin->nip }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>NIK:</strong></td>
                                            <td>{{ $admin->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jenis Kelamin:</strong></td>
                                            <td>{{ $admin->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tempat Lahir:</strong></td>
                                            <td>{{ $admin->tempat_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Lahir:</strong></td>
                                            <td>{{ $admin->tanggal_lahir }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $admin->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. HP:</strong></td>
                                            <td>{{ $admin->no_hp ?? 'Belum diisi' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>{{ $admin->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jabatan:</strong></td>
                                            <td><span
                                                    class="badge bg-warning text-dark">{{ ucfirst($admin->jabatan) }}</span>
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
