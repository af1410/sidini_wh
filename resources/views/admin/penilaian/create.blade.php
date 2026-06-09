@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Buka Penilaian</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.penilaian.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Mapel</label>
                        <select name="id_mapel" class="form-select @error('id_mapel') is-invalid @enderror" id="mapel_select">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach ($mapel as $item)
                                <option value="{{ $item->id_mapel }}" class="mapel-option" data-guru="{{ $item->id_guru }}">
                                    {{ $item->nama_mapel }} - {{ $item->jenis_mapel }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <select name="id_kelas" id="kelas_select" class="form-select">

                            <option value="">-- Pilih Kelas --</option>

                            @foreach ($kelas as $item)
                                @php
                                    $mapelsKelas = $kelasMapel->where('id_kelas', $item->id_kelas);
                                @endphp

                                @foreach ($mapelsKelas as $km)
                                    <option value="{{ $item->id_kelas }}" data-mapel="{{ $km->id_mapel }}" hidden>
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('id_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Guru</label>
                        <select id="guru_select" name="id_guru" class="form-select">

                            <option value="">-- Pilih Guru --</option>

                            @foreach ($guruMapel as $gm)
                                <option value="{{ $gm->guru->id_guru }}" data-mapel="{{ $gm->id_mapel }}" hidden>
                                    {{ $gm->guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>





                    <div class="mb-3">
                        <label>Semester</label>
                        <select name="semester" class="form-select @error('semester') is-invalid @enderror" id="semester">
                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label>Jenis Penilaian</label>
                        <select name="jenis_penilaian" class="form-select @error('jenis_penilaian') is-invalid @enderror"
                            id="jenis_penilaian">
                            <option value="sumatif" selected>Sumatif</option>
                        </select>
                        @error('jenis_penilaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <input type="hidden" name="jenis_penilaian" value="sumatif" value="sumatif">

                    <div class="mb-3">
                        <label>Jenis Penilaian</label>
                        <select name="tipe_sumatif" class="form-select">
                            <option value="">-- Pilih Jenis Penilaian --</option>
                            <option value="PSTS">PSTS</option>
                            <option value="PSAS">PSAS</option>
                        </select>
                    </div>



                    <div class="mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="datetime-local" name="tanggal_mulai"
                            class="form-control @error('tanggal_mulai') is-invalid @enderror">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Selesai</label>
                        <input type="datetime-local" name="tanggal_selesai"
                            class="form-control @error('tanggal_selesai') is-invalid @enderror">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            💾 Simpan
                        </button>
                        <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const mapelSelect = document.getElementById('mapel_select');
            const kelasSelect = document.getElementById('kelas_select');
            const guruSelect = document.getElementById('guru_select');

            mapelSelect.addEventListener('change', function() {

                const idMapel = this.value;

                kelasSelect.value = '';
                guruSelect.value = '';

                Array.from(kelasSelect.options).forEach(option => {

                    if (option.value === '') return;

                    option.hidden = option.dataset.mapel != idMapel;
                });

                Array.from(guruSelect.options).forEach(option => {

                    if (option.value === '') return;

                    option.hidden = true;
                });

            });

            kelasSelect.addEventListener('change', function() {

                const idMapel = mapelSelect.value;

                guruSelect.value = '';

                Array.from(guruSelect.options).forEach(option => {

                    if (option.value === '') return;

                    option.hidden = option.dataset.mapel != idMapel;
                });

            });

        });
    </script>
@endsection
