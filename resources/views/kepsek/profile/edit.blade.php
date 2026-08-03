@extends('kepsek.layouts.app')

@section('title', 'Edit Profile Kepsek')

@section('content')

    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Edit Profile Kepsek</h3>
                <p class="text-muted mb-0">
                    Perbarui informasi pribadi dan keamanan akun Anda.
                </p>
            </div>

            <a href="{{ route('kepsek.profile.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <form action="{{ route('kepsek.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- Profile Card -->
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm overflow-hidden">

                        <div style="background-color: var(--primary-color);height:100px"></div>

                        <div class="card-body text-center mt-n5">

                            <div id="preview-wrapper">

                                @if ($kepsek->gambar)
                                    <img src="{{ asset('storage/' . $kepsek->gambar) }}" id="preview-image"
                                        class="rounded-circle border border-4 border-white shadow"
                                        style="width:180px;height:180px;object-fit:cover;">
                                @else
                                    <div id="preview-placeholder"
                                        class="rounded-circle bg-light border border-4 border-white shadow mx-auto d-flex align-items-center justify-content-center"
                                        style="width:180px;height:180px;">
                                        <i class="bi bi-person-fill text-secondary me-1" style="font-size:4rem;"></i>
                                    </div>
                                @endif

                            </div>

                            <h4 class="mt-3 fw-bold">
                                {{ $kepsek->nama_guru }}
                            </h4>

                            <span class="badge bg-warning text-dark px-3 py-2">
                                {{ ucfirst($kepsek->jabatan) }}
                            </span>

                            <div class="mt-3 text-start">

                                <label class="form-label fw-semibold">
                                    Foto Profil
                                </label>

                                <input type="file" name="gambar" id="gambar-input"
                                    class="form-control @error('gambar') is-invalid @enderror" accept="image/*">

                                <small class="text-muted">
                                    JPG, JPEG, PNG, GIF (Maks. 2MB)
                                </small>

                                @error('gambar')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Form -->
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-person-vcard me-2"></i>
                                Informasi Pribadi
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row gy-3">

                                <div class="col-md-6">
                                    <label class="form-label">NIP</label>
                                    <input type="text" value="{{ $kepsek->nip }}" class="form-control" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="text" value="{{ $kepsek->nik }}" class="form-control" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nama Guru</label>
                                    <input type="text" name="nama_guru" value="{{ old('nama_guru', $kepsek->nama_guru) }}"
                                        class="form-control @error('nama_guru') is-invalid @enderror">

                                    @error('nama_guru')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" value="{{ old('username', $kepsek->username) }}"
                                        class="form-control @error('username') is-invalid @enderror">

                                    @error('nama_guru')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>

                                    <select name="jenis_kelamin"
                                        class="form-select @error('jenis_kelamin') is-invalid @enderror">

                                        <option value="">Pilih Jenis Kelamin</option>

                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin', $kepsek->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>

                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin', $kepsek->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>

                                    </select>

                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir</label>

                                    <input type="text" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $kepsek->tempat_lahir) }}"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror">

                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir</label>

                                    <input type="date" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $kepsek->tanggal_lahir) }}"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror">

                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">No. HP</label>

                                    <input type="text" name="no_hp" value="{{ old('no_hp', $kepsek->no_hp) }}"
                                        class="form-control @error('no_hp') is-invalid @enderror">

                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>

                                    <input type="email" name="email" value="{{ old('email', $kepsek->email) }}"
                                        class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Alamat</label>

                                    <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $kepsek->alamat) }}</textarea>

                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanda Tangan</label>
                                    <input type="file"
                                        name="ttd"
                                        class="form-control"
                                        accept="image/png,image/jpeg,image/jpg">
                                    <small class="text-muted">
                                        Disarankan menggunakan PNG dengan background transparan.
                                    </small>
                                </div>
                            </div>

                            <hr class="my-4">

                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-shield-lock me-2"></i>
                                Ubah Password
                            </h5>

                            <div class="alert alert-info">
                                Kosongkan password jika tidak ingin mengubah password akun.
                            </div>

                            <div class="row gy-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Password Baru
                                    </label>

                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">

                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePassword('password')">
                                            <i class="bi bi-eye me-1"></i>
                                        </button>
                                    </div>

                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Konfirmasi Password
                                    </label>

                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control">

                                        <button type="button" class="btn btn-outline-secondary"
                                            onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye me-1"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="card-footer bg-white">

                            <div class="d-flex gap-2">

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Simpan Perubahan
                                </button>

                                <a href="{{ route('kepsek.profile.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>
        ```

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('gambar-input').addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(event) {

                let previewImage = document.getElementById('preview-image');
                const wrapper = document.getElementById('preview-wrapper');

                if (!previewImage) {
                    wrapper.innerHTML =
                        `<img src="${event.target.result}"
                        id="preview-image"
                        class="rounded-circle border border-4 border-white shadow"
                        style="width:180px;height:180px;object-fit:cover;">`;
                } else {
                    previewImage.src = event.target.result;
                }
            }

            reader.readAsDataURL(file);
        });

        function togglePassword(id) {
            const input = document.getElementById(id);

            input.type = input.type === 'password' ?
                'text' :
                'password';
        }
    </script>
@endpush
