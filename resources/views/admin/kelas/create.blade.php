@extends('admin.layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0"><i class="bi bi-house me-2"></i>Tambah Kelas</h4>
                    </div>
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kelas.store') }}" method="POST">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Tahun Ajar</label>
                            <select name="id_tahun_ajar" class="form-control @error('id_tahun_ajar') is-invalid @enderror">
                                <option value="">-- Pilih Tahun Ajar --</option>
                                @foreach ($tahunAjars as $ta)
                                    <option value="{{ $ta->id_tahun_ajar }}" {{ old('id_tahun_ajar') == $ta->id_tahun_ajar ? 'selected' : '' }}>
                                        {{ $ta->tahun_ajar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tahun_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                <option value="" disabled selected hidden>-- Pilih Kelas ---</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Rombel</label>
                            <select name="rombel" class="form-control @error('rombel') is-invalid @enderror">
                                <option value="" disabled selected hidden>-- Pilih Rombel ---</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                            @error('rombel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Wali Kelas</label>
                            <select name="id_guru" class="form-control @error('id_guru') is-invalid @enderror">
                                <option value="">Pilih Wali Kelas</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id_guru }}"
                                        {{ old('id_guru') == $guru->id_guru ? 'selected' : '' }}>{{ $guru->nama_guru }}
                                        ({{ $guru->nip }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_guru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success"><i class="bi bi-floppy-fill me-1"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
