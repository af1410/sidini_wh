@extends('admin.layouts.app')

@section('title', 'Tambah Mata Pelajaran')


@section('content')
    @push('styles')
        <style>
            .select2-container .select2-selection--multiple {
                min-height: 42px !important;
                border: 1px solid #ced4da !important;
                border-radius: .375rem !important;
                padding: 4px 8px !important;
            }

            .select2-container--default .select2-selection--multiple {
                background-color: #fff;
            }

            .select2-container {
                width: 100% !important;
            }

            .select2-selection__choice {
                margin-top: 3px !important;
            }
        </style>
    @endpush

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

                        <select name="id_guru[]" id="id_guru" class="form-select @error('id_guru') is-invalid @enderror"
                            multiple>

                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id_guru }}">
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
                            <option value="umum" {{ old('jenis_mapel') == 'umum' ? 'selected' : '' }}>Umum</option>
                            <option value="minat" {{ old('jenis_mapel') == 'minat' ? 'selected' : '' }}>Minat</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Ajaran</label>
                        <select name="id_tahun_ajar" class="form-select @error('id_tahun_ajar') is-invalid @enderror">
                            <option value="">-- Pilih Tahun Ajaran --</option>
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

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {

                $('#id_guru').select2({
                    placeholder: 'Pilih Guru Pengajar',
                    width: '100%'
                });

            });
        </script>
    @endpush
@endsection
