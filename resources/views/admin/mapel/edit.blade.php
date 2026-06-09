    @extends('admin.layouts.app')

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

                            <select name="id_guru[]" id="id_guru" class="form-select" multiple>

                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id_guru }}"
                                        {{ in_array($guru->id_guru, $selectedGuru ?? []) ? 'selected' : '' }}>
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
                                    {{ old('jenis_mapel', $mapel->jenis_mapel) == 'wajib' ? 'selected' : '' }}>Wajib
                                </option>
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

        @push('scripts')
            <script>
                $(function() {
                    $('#id_guru').select2({

                        placeholder: 'Pilih Guru Pengajar',
                        allowClear: true,
                        width: '100%'
                    });
                });
            </script>
        @endpush
    @endsection
