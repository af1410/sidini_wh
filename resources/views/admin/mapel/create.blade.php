@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Mapel</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.mapel.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Mapel</label>
                        <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Guru Pengajar</label>
                        <select name="id_guru" class="form-select @error('id_guru') is-invalid @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id_guru }}"
                                    {{ old('id_guru') == $guru->id_guru ? 'selected' : '' }}>
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Mapel</label>
                        <select name="jenis_mapel" class="form-select">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="wajib" {{ old('jenis_mapel') == 'wajib' ? 'selected' : '' }}>Wajib</option>
                            <option value="minat" {{ old('jenis_mapel') == 'minat' ? 'selected' : '' }}>Minat</option>
                        </select>
                    </div>
                    @php
                        $bulan = date('n');
                        $tahun = date('Y');

                        if ($bulan >= 7) {
                            $tahunAjar = $tahun . '/' . ($tahun + 1);
                        } else {
                            $tahunAjar = $tahun - 1 . '/' . $tahun;
                        }
                    @endphp

                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control"
                            value="{{ old('tahun_ajaran', $tahunAjar) }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
