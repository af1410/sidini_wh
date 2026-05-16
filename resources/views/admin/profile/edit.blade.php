@extends('admin.layouts.app')

@section('title', 'Edit Profile Admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Edit Profile Admin</h4>
                    <p class="text-muted mb-0">Perbarui informasi pribadi dan foto profil Anda.</p>
                </div>
                <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Form Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIP</label>
                                    <input type="text" value="{{ $admin->nip }}" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="text" value="{{ $admin->nik }}" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Guru</label>
                                    <input type="text" name="nama_guru" value="{{ old('nama_guru', $admin->nama_guru) }}"
                                        class="form-control @error('nama_guru') is-invalid @enderror">
                                    @error('nama_guru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $admin->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $admin->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $admin->tempat_lahir) }}"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $admin->tanggal_lahir) }}"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" name="no_hp" value="{{ old('no_hp', $admin->no_hp) }}"
                                        class="form-control @error('no_hp') is-invalid @enderror">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $admin->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Foto Profil</label>
                                    <div class="d-flex gap-3">
                                        <div style="flex: 0 0 150px;" id="preview-wrapper">
                                            @if ($admin->gambar)
                                                <img src="{{ asset('storage/' . $admin->gambar) }}" alt="Foto Profil"
                                                    class="img-fluid rounded" id="preview-image"
                                                    style="max-width: 100%; height: auto;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="width: 100%; aspect-ratio: 1; min-height: 150px;">
                                                    <i class="bi bi-image fs-1 text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div style="flex: 1;">
                                            <input type="file" name="gambar" id="gambar-input"
                                                data-image-preview="#preview-image"
                                                data-image-preview-wrapper="#preview-wrapper"
                                                class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                                            <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                            @error('gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Semua Perubahan</button>
                                <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('gambar-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (!previewImage) {
                        // Jika belum ada preview-image, buat div baru
                        const container = document.querySelector('[style*="flex: 0 0 150px"]');
                        container.innerHTML = '<img src="' + event.target.result +
                            '" alt="Preview" class="img-fluid rounded" id="preview-image" style="max-width: 100%; height: auto;">';
                    } else {
                        previewImage.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
