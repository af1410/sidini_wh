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
                        <label>Guru</label>
                        <select id="guru_select" name="id_guru" class="form-select @error('id_guru') is-invalid @enderror">
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
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror"
                            id="kelas_select">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id_kelas }}">
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kelas')
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

                    <div class="mb-3">
                        <label>Jenis Penilaian</label>
                        <select name="jenis_penilaian" class="form-select @error('jenis_penilaian') is-invalid @enderror"
                            id="jenis_penilaian">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="formatif">Formatif</option>
                            <option value="sumatif">Sumatif</option>
                        </select>
                        @error('jenis_penilaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="sumatif-section" style="display: none;">
                        <div class="mb-3">
                            <label>Bab Ke</label>
                            <select name="bab_ke" class="form-select">
                                <option value="">-- Pilih Bab --</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">Bab {{ $i }}</option>
                                @endfor
                                <option value="PTS">PTS</option>
                                <option value="PAS">PAS</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Judul Bab</label>
                            <input type="text" name="judul_bab" class="form-control">
                        </div>
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
        const jenis = document.getElementById('jenis_penilaian');
        const sumatifSection = document.getElementById('sumatif-section');
        const kelasSelect = document.getElementById('kelas_select');
        const mapelSelect = document.getElementById('mapel_select');
        const guruSelect = document.getElementById('guru_select');

        // Data untuk kelas-mapel relationship
        const kelasMapelData = {
            @foreach ($kelas as $k)
                '{{ $k->id_kelas }}': [
                    @foreach ($k->mapels as $m)
                        '{{ $m->id_mapel }}',
                    @endforeach
                ],
            @endforeach
        };

        function toggleSumatif() {
            if (jenis.value === 'sumatif') {
                sumatifSection.style.display = 'block';
            } else {
                sumatifSection.style.display = 'none';
            }
        }

        function setGuruFromMapel() {
            const selectedOption = mapelSelect.selectedOptions[0];
            if (!selectedOption) {
                return;
            }
            const guruId = selectedOption.dataset.guru || '';
            if (guruId) {
                guruSelect.value = guruId;
            }
        }

        function filterMapelByKelas() {
            const selectedKelas = kelasSelect.value;
            const allowedMapels = kelasMapelData[selectedKelas] || [];

            // Reset mapel select
            mapelSelect.value = '';
            guruSelect.value = '';

            // Hide/show mapel options
            const mapelOptions = document.querySelectorAll('.mapel-option');
            mapelOptions.forEach(option => {
                if (allowedMapels.includes(option.value)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        jenis.addEventListener('change', toggleSumatif);
        kelasSelect.addEventListener('change', filterMapelByKelas);
        mapelSelect.addEventListener('change', setGuruFromMapel);
        toggleSumatif();
    </script>
@endsection
