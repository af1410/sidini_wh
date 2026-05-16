@extends('admin.layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-0">Dashboard Admin</h4>
                <p class="text-muted mb-0">Selamat datang di panel administrasi sistem digitalisasi nilai.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Selamat Datang, {{ $admin->nama_guru }}!</h5>
                    </div>
                    <div class="card-body">
                        {{-- Tambahkan pendididkan, univ, sama jurusan --}}
                        <p class="mb-2">NIP/NUPTK: <strong>{{ $admin->nip }}</strong></p>
                        <p class="mb-2">Jabatan: <span
                                class="badge bg-warning text-dark">{{ ucfirst($admin->jabatan) }}</span></p>
                        <div class="alert alert-info mt-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Anda login sebagai <strong>Administrator</strong> dengan akses penuh ke sistem.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        @if ($admin->gambar)
                            <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Foto Profil"
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
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
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Kontak & Alamat</h5>
                        </div>
                        <div class="card-body">
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
                                        <td><span class="badge bg-warning text-dark">{{ ucfirst($admin->jabatan) }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
