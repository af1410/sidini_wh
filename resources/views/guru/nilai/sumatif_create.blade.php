@extends('guru.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Input Penilaian Sumatif</h4>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Informasi Penilaian</h6>
                                <p class="mb-2"><strong>Mapel:</strong> {{ $pembukaan->mapel->nama_mapel }}</p>
                                <p class="mb-2"><strong>Kelas:</strong> {{ $pembukaan->kelas->nama_kelas ?? '-' }}</p>
                                <p class="mb-2"><strong>Guru:</strong> {{ $pembukaan->guru->nama_guru ?? '-' }}</p>
                                <p class="mb-2"><strong>Semester:</strong> {{ ucfirst($pembukaan->semester) }}</p>
                                <p class="mb-0"><strong>Bab:</strong> Bab {{ $pembukaan->bab_ke }} -
                                    {{ $pembukaan->judul_bab }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('guru.nilai.sumatif.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_pembukaan_penilaian" value="{{ $pembukaan->id }}">

                    <div class="mb-3">
                        <label class="form-label">Judul Bab</label>
                        <input type="text" name="judul_bab" class="form-control @error('judul_bab') is-invalid @enderror"
                            value="{{ old('judul_bab', $pembukaan->judul_bab) }}" required>
                        @error('judul_bab')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <h5>Nilai Siswa Kelas {{ $pembukaan->kelas->nama_kelas ?? '-' }}</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="student-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Nilai Tes Tulis</th>
                                        <th>Nilai Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr data-siswa-id="{{ $siswa->id_siswa }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->nim ?? '-' }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>
                                                <input type="number" name="nilai_tes_tulis[{{ $siswa->id_siswa }}]"
                                                    class="form-control @error('nilai_tes_tulis.' . $siswa->id_siswa) is-invalid @enderror"
                                                    min="0" max="100" step="0.1"
                                                    value="{{ old('nilai_tes_tulis.' . $siswa->id_siswa) }}">
                                            </td>
                                            <td>
                                                <input type="number" name="nilai_kehadiran[{{ $siswa->id_siswa }}]"
                                                    class="form-control @error('nilai_kehadiran.' . $siswa->id_siswa) is-invalid @enderror"
                                                    min="0" max="100" step="0.1"
                                                    value="{{ old('nilai_kehadiran.' . $siswa->id_siswa) }}">
                                            </td>
                                            <input type="hidden" name="id_siswa[]" value="{{ $siswa->id_siswa }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @error('id_siswa')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('nilai_tes_tulis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('nilai_kehadiran')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bobot Tes Tulis</label>
                            <select name="bobot_tes_tulis"
                                class="form-select @error('bobot_tes_tulis') is-invalid @enderror" required>
                                <option value="">-- Pilih Bobot --</option>
                                @for ($i = 0; $i <= 100; $i += 5)
                                    <option value="{{ $i }}"
                                        {{ old('bobot_tes_tulis') == $i ? 'selected' : '' }}>{{ $i }}%</option>
                                @endfor
                            </select>
                            @error('bobot_tes_tulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bobot Kehadiran</label>
                            <select name="bobot_kehadiran"
                                class="form-select @error('bobot_kehadiran') is-invalid @enderror" required>
                                <option value="">-- Pilih Bobot --</option>
                                @for ($i = 0; $i <= 100; $i += 5)
                                    <option value="{{ $i }}"
                                        {{ old('bobot_kehadiran') == $i ? 'selected' : '' }}>{{ $i }}%</option>
                                @endfor
                            </select>
                            @error('bobot_kehadiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot Tugas</label>
                        <select name="bobot_tugas" class="form-select @error('bobot_tugas') is-invalid @enderror" required>
                            <option value="">-- Pilih Bobot --</option>
                            @for ($i = 0; $i <= 100; $i += 5)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                        @error('bobot_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Data Tugas</h5>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="tambahTugas()">
                            + Tambah Tugas
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Daftar Tugas</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Daftar Tugas</h5>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="tambahTugas()">
                            + Tambah Tugas
                        </button>
                    </div>

                    <div id="tugas-wrapper">
                        <div class="row mb-3 tugas-item" data-task-index="0">
                            <div class="col-md-11">
                                <input type="text" name="tugas[0][nama_tugas]" class="form-control"
                                    placeholder="Nama tugas">
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger w-100" onclick="hapusTugas(this)">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    @error('tugas')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            💾 Simpan Nilai Sumatif
                        </button>
                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let tugasIndex = 0;
        const wrapper = document.getElementById('tugas-wrapper');
        const studentTableHead = document.querySelector('#student-table thead tr');
        const oldTugasNilai = @json(old('tugas_nilai', []));

        function addTaskColumn(index) {
            const th = document.createElement('th');
            th.textContent = `Tugas ${index + 1}`;
            th.dataset.taskIndex = index;
            studentTableHead.appendChild(th);

            document.querySelectorAll('#student-table tbody tr').forEach(row => {
                const siswaId = row.dataset.siswaId;
                const td = document.createElement('td');
                td.dataset.taskIndex = index;

                const value = (oldTugasNilai[siswaId] && oldTugasNilai[siswaId][index] !== undefined) ?
                    oldTugasNilai[siswaId][index] :
                    '';

                td.innerHTML = `
                    <input type="number" name="tugas_nilai[${siswaId}][${index}]" class="form-control" min="0" max="100" step="0.1" value="${value}">
                `;
                row.appendChild(td);
            });
        }

        function updateTaskIndexes() {
            document.querySelectorAll('.tugas-item').forEach((item, idx) => {
                item.dataset.taskIndex = idx;
                const input = item.querySelector('input[name^="tugas["]');
                if (input) {
                    input.name = `tugas[${idx}][nama_tugas]`;
                }
            });
        }

        function tambahTugas() {
            const index = tugasIndex;
            const html = `
                <div class="row mb-3 tugas-item" data-task-index="${index}">
                    <div class="col-md-11">
                        <input type="text" name="tugas[${index}][nama_tugas]" class="form-control" placeholder="Nama tugas">
                    </div>

                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger w-100" onclick="hapusTugas(this)">
                            Hapus
                        </button>
                    </div>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            addTaskColumn(index);
            tugasIndex++;
        }

        function hapusTugas(button) {
            const item = button.closest('.tugas-item');
            const taskIndex = Number(item.dataset.taskIndex);
            item.remove();

            const th = studentTableHead.querySelector(`th[data-task-index="${taskIndex}"]`);
            if (th) {
                th.remove();
            }

            document.querySelectorAll('#student-table tbody tr').forEach(row => {
                const td = row.querySelector(`td[data-task-index="${taskIndex}"]`);
                if (td) {
                    td.remove();
                }
            });

            updateTaskIndexes();
            refreshTaskColumns();
        }

        function refreshTaskColumns() {
            const currentIndexes = Array.from(wrapper.querySelectorAll('.tugas-item')).map(item => Number(item.dataset
                .taskIndex));
            const headers = Array.from(studentTableHead.querySelectorAll('th[data-task-index]'));
            headers.forEach(th => {
                if (!currentIndexes.includes(Number(th.dataset.taskIndex))) {
                    th.remove();
                }
            });

            document.querySelectorAll('#student-table tbody tr').forEach(row => {
                const cells = Array.from(row.querySelectorAll('td[data-task-index]'));
                cells.forEach(cell => {
                    if (!currentIndexes.includes(Number(cell.dataset.taskIndex))) {
                        cell.remove();
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const currentTasks = wrapper.querySelectorAll('.tugas-item');
            currentTasks.forEach((item, index) => {
                item.dataset.taskIndex = index;
                const input = item.querySelector('input[name^="tugas["]');
                if (input) {
                    input.name = `tugas[${index}][nama_tugas]`;
                }
                addTaskColumn(index);
            });
            tugasIndex = currentTasks.length;
        });
    </script>
@endsection
