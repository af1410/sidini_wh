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
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
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
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Catatan:</strong> Username otomatis di-sinkronkan dari NIP guru. Password dapat direset
                        menjadi NIP melalui tombol di bawah.
                    </div>

                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <button class="btn btn-primary" type="submit">Perbarui Guru</button>
                    </div>
                </form>

                <form action="{{ route('admin.guru.reset-password', $guru->id_guru) }}" method="POST" class="mt-2"
                    onsubmit="return confirm('Reset password guru menjadi NIP?');">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        Reset Password ke NIP
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
            <div id="appToast" class="toast align-items-center text-white bg-{{ $toastType }} border-0" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3500">
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
