@extends('admin.layouts.app')

@section('title', 'Tambah Tahun Ajar')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Tambah Tahun Ajar</h4>
                    </div>
                    <a href="{{ route('admin.tahun_ajar.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tahun_ajar.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Tahun Ajar</label>
                            <input type="text" name="tahun_ajar" value="{{ old('tahun_ajar') }}"
                                class="form-control @error('tahun_ajar') is-invalid @enderror"
                                placeholder="Contoh: 2024/2025">
                            @error('tahun_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: YYYY/YYYY</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">-- Pilih Status --</option>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tahun Mulai</label>
                            <input type="number" name="tahun_mulai" value="{{ old('tahun_mulai') }}"
                                class="form-control @error('tahun_mulai') is-invalid @enderror"
                                min="2000" max="2100" placeholder="Contoh: 2024">
                            @error('tahun_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tahun Selesai</label>
                            <input type="number" name="tahun_selesai" value="{{ old('tahun_selesai') }}"
                                class="form-control @error('tahun_selesai') is-invalid @enderror"
                                min="2000" max="2100" placeholder="Contoh: 2025">
                            @error('tahun_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                rows="3" placeholder="Catatan atau keterangan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                            <a href="{{ route('admin.tahun_ajar.index') }}" class="btn btn-secondary"><i class="bi bi-x me-1"></i> Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
