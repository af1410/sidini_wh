@extends('admin.layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Tambah Siswa</h4>
                    <p class="text-muted mb-0">Isi data siswa baru dengan lengkap dan benar.</p>
                </div>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Siswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim') }}"
                                class="form-control @error('nim') is-invalid @enderror">
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}"
                                class="form-control @error('nama_siswa') is-invalid @enderror">
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenim_kelamin" class="form-control @error('jenim_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenim_kelamin') === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenim_kelamin') === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenim_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                class="form-control @error('tempat_lahir') is-invalid @enderror">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="form-control @error('username') is-invalid @enderror">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">UID Kartu</label>
                            <input type="text" name="uid_kartu" value="{{ old('uid_kartu') }}"
                                class="form-control @error('uid_kartu') is-invalid @enderror">
                            @error('uid_kartu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kelas</label>
                            <select name="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelasOptions as $option)
                                    <option value="{{ $option->id_kelas }}"
                                        {{ old('id_kelas') === $option->id_kelas ? 'selected' : '' }}>
                                        {{ $option->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Angkatan</label>
                            <select name="angkatan" class="form-control @error('angkatan') is-invalid @enderror">
                                <option value="">Pilih Angkatan</option>
                                @foreach ($angkatanOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ old('angkatan') === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('angkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password</label>
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
                        <button class="btn btn-success">Simpan Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
