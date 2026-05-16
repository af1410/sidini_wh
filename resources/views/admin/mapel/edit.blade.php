@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Edit Mapel</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.mapel.update', $mapel->id_mapel) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Mapel</label>
                        <input type="text" name="nama_mapel" class="form-control"
                            value="{{ old('nama_mapel', $mapel->nama_mapel) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Guru Pengajar</label>
                        <select name="id_guru" class="form-select @error('id_guru') is-invalid @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id_guru }}"
                                    {{ old('id_guru', $mapel->id_guru) == $guru->id_guru ? 'selected' : '' }}>
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
                            <option value="wajib"
                                {{ old('jenis_mapel', $mapel->jenis_mapel) == 'wajib' ? 'selected' : '' }}>Wajib</option>
                            <option value="minat"
                                {{ old('jenis_mapel', $mapel->jenis_mapel) == 'minat' ? 'selected' : '' }}>Minat
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control"
                            value="{{ old('tahun_ajaran', $mapel->tahun_ajaran) }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
