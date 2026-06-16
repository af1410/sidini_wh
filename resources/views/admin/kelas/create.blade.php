@extends('admin.layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Tambah Kelas</h4>
                    </div>
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>
                        Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kelas.store') }}" method="POST">
                    @csrf
                    @php
                        $bulan = date('n');
                        $tahun = date('Y');

                        if ($bulan >= 7) {
                            $tahunAjar = $tahun . '/' . ($tahun + 1);
                        } else {
                            $tahunAjar = $tahun - 1 . '/' . $tahun;
                        }
                    @endphp
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Tahun Ajar</label>
                            <input type="text" name="tahun_ajar" value="{{ old('tahun_ajar', $tahunAjar) }}"
                                class="form-control @error('tahun_ajar') is-invalid @enderror" readonly>
                            @error('tahun_ajar')
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
