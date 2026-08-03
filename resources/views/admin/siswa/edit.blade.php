@extends('admin.layouts.app')

@section('title', 'Edit Siswa')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Edit Siswa</h4>
                    </div>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.siswa.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim', $siswa->nim) }}"
                                class="form-control @error('nim') is-invalid @enderror">
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $siswa->nik) }}"
                                class="form-control @error('nik') is-invalid @enderror">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                                class="form-control @error('nisn') is-invalid @enderror">
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                class="form-control @error('nama_siswa') is-invalid @enderror">
                            @error('nama_siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                                class="form-control @error('tempat_lahir') is-invalid @enderror">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $siswa->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">UID Kartu</label>
                            <input type="text" name="uid_kartu" value="{{ old('uid_kartu', $siswa->uid_kartu) }}"
                                class="form-control @error('uid_kartu') is-invalid @enderror">
                            @error('uid_kartu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text"
                                name="asal_sekolah"
                                value="{{ old('asal_sekolah', $siswa->asal_sekolah ?? '') }}"
                                class="form-control @error('asal_sekolah') is-invalid @enderror"
                                placeholder="Contoh: MTs Wasilatul Huda">
                            @error('asal_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $siswa->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Catatan:</strong> Username otomatis di-sinkronkan dari NIM siswa. Password tidak dapat
                        diubah dari form ini.
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary"><i class="bi bi-floppy-fill me-1"></i> Simpan</button>
                    </div>
                </form>
                <form action="{{ route('admin.siswa.reset-password', $siswa->id_siswa) }}" method="POST" class="mt-2"
                    onsubmit="return confirm('Reset password Siswa menjadi NIM?');">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Password ke NIM
                    </button>
                </form>
            </div>
        </div>
    </div>

    @php
        $toastMessage = session('success') ?? session('error');
        $toastType = session('error') ? 'danger' : 'success';
    @endphp

    @if ($toastMessage)
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
            <div id="appToast" class="toast align-items-center text-white bg-{{ $toastType }} border-0"
                role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3500">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $toastMessage }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('appToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
@endsection
