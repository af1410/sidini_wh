@extends('admin.layouts.app')

@section('title', 'Edit Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Edit Kelas</h4>
                    <p class="text-muted mb-0">Perbarui data kelas dan wali kelas untuk tahun ajaran yang sedang berjalan.
                    </p>
                </div>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Edit Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                        <div class="col-md-4">
                            <label class="form-label">Tahun Ajar</label>
                            <input type="text" name="tahun_ajar" value="{{ old('tahun_ajar', $tahunAjar) }}"
                                class="form-control @error('tahun_ajar') is-invalid @enderror" readonly>
                            @error('tahun_ajar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                                <option value="{{ old('kelas', $kelas->kelas) }}" disabled selected hidden>
                                    {{ $kelas->kelas }}</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Rombel</label>
                            <select name="rombel" class="form-control @error('rombel') is-invalid @enderror">
                                <option value="{{ old('rombel', $kelas->rombel) }}" disabled selected hidden>
                                    {{ $kelas->rombel }}</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                            @error('rombel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Wali Kelas</label>
                            <select name="id_guru" class="form-control @error('id_guru') is-invalid @enderror">
                                <option value="{{ old('id_guru', $kelas->id_guru) }}" disabled selected hidden>
                                    {{ $kelas->waliKelas->nama_guru ?? 'Pilih Wali Kelas' }}</option>
                                @foreach ($guru as $guru)
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
                        <button class="btn btn-success">Simpan Kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
