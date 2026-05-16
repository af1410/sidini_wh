@extends('admin.layouts.app')

@section('title', 'Edit Guru')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Edit Guru</h4>
                    <p class="text-muted mb-0">Perbarui data guru untuk menjaga informasi tetap akurat.</p>
                </div>
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Guru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.guru.update', $guru->id_guru) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row gy-3">
                        <div class="col-md-4">
                            <label class="form-label">NIP</label>
                            <input type="text" value="{{ $guru->nip }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $guru->nik) }}"
                                class="form-control @error('nik') is-invalid @enderror">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username', $guru->username) }}"
                                class="form-control @error('username') is-invalid @enderror">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Guru</label>
                            <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}"
                                class="form-control @error('nama_guru') is-invalid @enderror">
                            @error('nama_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $guru->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                <option value="">Pilih Jabatan</option>
                                <option value="guru" {{ old('jabatan', $guru->jabatan) == 'guru' ? 'selected' : '' }}>
                                    Guru</option>
                                <option value="admin" {{ old('jabatan', $guru->jabatan) == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="kepala_sekolah"
                                    {{ old('jabatan', $guru->jabatan) == 'kepala_sekolah' ? 'selected' : '' }}>
                                    Kepala Sekolah</option>
                            </select>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
                                class="form-control @error('tempat_lahir') is-invalid @enderror">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $guru->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary">Perbarui Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
