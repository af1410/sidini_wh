@extends('guru.layouts.app')
@section('title', 'Nilai Formatif')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Nilai Formatif</h4>
                <p class="text-muted mb-0">
                    {{ $penilaian->mapel->nama_mapel ?? '-' }} -
                    {{ $penilaian->kelas->nama_kelas ?? '-' }}
                </p>
            </div>
            <a href="{{ route('guru.mapel.show', $penilaian->id_kelas) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>


        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <form action="{{ route('guru.nilai_formatif.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_penilaian" value="{{ $penilaian->id }}">

            @foreach ($babList ?: [1] as $bab)
                @php
                    $pertemuanList = isset($nilaiFormatif[$bab]) ? $nilaiFormatif[$bab]->keys()->sort()->values() : collect([]);
                    $isBabAktif = $bab == $babAktif;
                @endphp

                <div class="card mb-4">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="mb-0">Bab {{ $bab }}</h5>

                            @if ($bab == 1)
                                <button type="button" class="btn btn-sm btn-success" id="btnTambahBab">
                                    + Bab Baru
                                </button>
                            @endif
                        </div>

                        @if ($isBabAktif && !$babBerikutnyaAda)
                            <small class="text-muted">
                                Bab aktif, baris kosong akan disiapkan otomatis
                            </small>
                        @endif
                    </div>

                    <div class="card-body p-0 table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0" id="tabelNilai">
                            <thead class="table-light">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama Siswa</th>

                                    @foreach ($babList as $bab)
                                        <th colspan="{{ count($pertemuanPerBab[$bab]) + 1 }}"
                                            data-header-bab="{{ $bab }}">
                                            Bab {{ $bab }}

                                            <button type="button"
                                                class="btn btn-sm btn-outline-primary tambah-pertemuan"
                                                data-bab="{{ $bab }}">
                                                +
                                            </button>
                                        </th>
                                    @endforeach
                                </tr>

                                <tr>
                                    @foreach ($babList as $bab)
                                        @foreach ($pertemuanPerBab[$bab] as $pertemuan)
                                            <th data-bab="{{ $bab }}">
                                                P{{ $pertemuan }}
                                            </th>
                                        @endforeach

                                        {{-- NILAI BAB --}}
                                        <th data-bab="{{ $bab }}"
                                            data-nilai-bab="{{ $bab }}">
                                            Nilai Bab
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $index => $item)
                                    <tr data-siswa="{{ $item->id_siswa }}">

                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            {{ $item->nama_siswa }}
                                        </td>

                                        @foreach ($babList as $bab)
                                            @php
                                                $nilaiBabData = collect();

                                                foreach ($pertemuanPerBab[$bab] as $pertemuan) {
                                                    $data = $nilaiPivot[$bab][$pertemuan][$item->id_siswa] ?? null;

                                                    if ($data) {
                                                        $nilaiBabData->push($data);
                                                    }
                                                }

                                                // Ambil nilai_bab yang sudah dihitung dari database
                                                $nilaiBab = $nilaiBabData->pluck('nilai_bab')->filter(fn($nilai) => $nilai !== null)->first();

                                                // Jika nilai_bab belum tersimpan, hitung sementara
                                                // dari nilai seluruh pertemuan
                                                if ($nilaiBab === null) {
                                                    $nilaiBab = $nilaiBabData->pluck('nilai_formatif')->filter(fn($nilai) => $nilai !== null)->avg();
                                                }

                                                $nilaiBab = $nilaiBab !== null ? number_format($nilaiBab, 2, ',', '') : '0,00';
                                            @endphp

                                            {{-- NILAI SETIAP PERTEMUAN --}}
                                            @foreach ($pertemuanPerBab[$bab] as $pertemuan)
                                                @php
                                                    $nilai = $nilaiPivot[$bab][$pertemuan][$item->id_siswa] ?? null;
                                                @endphp

                                                <td>
                                                    <input type="number"
                                                        class="form-control form-control-sm"
                                                        name="nilai_bab[{{ $bab }}][{{ $pertemuan }}][{{ $item->id_siswa }}]"
                                                        value="{{ $nilai->nilai_formatif ?? '' }}"
                                                        min="0"
                                                        max="100"
                                                        step="0.01">

                                                    <small class="text-muted d-block">
                                                        {{ $nilai->tanggal_input ?? '-' }}
                                                    </small>
                                                </td>
                                            @endforeach

                                            {{-- NILAI BAB --}}
                                            <td data-nilai-bab="{{ $bab }}">
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light"
                                                    value="{{ $nilaiBab }}"
                                                    readonly>

                                                <small class="text-muted">
                                                    Rata-rata
                                                </small>
                                            </td>
                                        @endforeach

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle-fill me-2"></i>Berhasil
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <i class="bi bi-check-circle-fill text-success"
                            style="font-size:70px"></i>

                        <h5 class="mt-3">
                            {{ session('success') }}
                        </h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success"
                            data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('successModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
                setTimeout(function() {
                    let alert = document.querySelector('.alert-success');
                    if (alert) {
                        bootstrap.Alert.getOrCreateInstance(alert).close();
                    }
                }, 2500);
                let babTerakhir = {{ max($babList) }};
                const btnTambahBab = document.getElementById('btnTambahBab');
                if (btnTambahBab) {
                    btnTambahBab.addEventListener('click', function() {
                        const placeholder = document.querySelector(`th[data-placeholder="1"][data-bab="${babTerakhir}"]`);
                        if (placeholder) {
                            const colIndex = placeholder.cellIndex;
                            placeholder.remove();
                            document.querySelectorAll('#tabelNilai tbody tr').forEach(function(row) {
                                row.deleteCell(colIndex);
                            });
                            const headerBabLama = document.querySelector(`th[data-header-bab="${babTerakhir}"]`);
                            if (headerBabLama) {
                                headerBabLama.colSpan = parseInt(headerBabLama.colSpan) - 1;
                            }
                        }
                        babTerakhir++;
                        const rowBab = document.querySelectorAll('#tabelNilai thead tr')[0];
                        const rowPertemuan = document.querySelectorAll('#tabelNilai thead tr')[1];
                        const thBab = document.createElement('th');
                        thBab.setAttribute('colspan', '2');
                        thBab.setAttribute('data-header-bab', babTerakhir);
                        thBab.innerHTML = `Bab ${babTerakhir} <button type="button" class="btn btn-sm btn-outline-primary tambah-pertemuan" data-bab="${babTerakhir}">+</button>`;
                        rowBab.appendChild(thBab);
                        const thPertemuan = document.createElement('th');
                        thPertemuan.setAttribute('data-bab', babTerakhir);
                        thPertemuan.setAttribute('data-placeholder', '1');
                        thPertemuan.innerHTML = 'P1';
                        rowPertemuan.appendChild(thPertemuan);
                        const thNilaiBab = document.createElement('th');
                        thNilaiBab.setAttribute('data-bab', babTerakhir);
                        thNilaiBab.setAttribute('data-nilai-bab', babTerakhir);
                        thNilaiBab.innerHTML = 'Nilai Bab';
                        rowPertemuan.appendChild(thNilaiBab);
                        document.querySelectorAll('#tabelNilai tbody tr').forEach(function(row) {
                            const idSiswa = row.dataset.siswa;
                            const tdPertemuan = document.createElement('td');
                            tdPertemuan.setAttribute('data-bab', babTerakhir);
                            tdPertemuan.innerHTML = `<input type="number" class="form-control form-control-sm" name="nilai_bab[${babTerakhir}][1][${idSiswa}]" min="0" max="100" step="0.01"><small class="text-muted d-block">-</small>`;
                            row.appendChild(tdPertemuan);
                            const tdNilaiBab = document.createElement('td');
                            tdNilaiBab.setAttribute('data-bab', babTerakhir);
                            tdNilaiBab.setAttribute('data-nilai-bab', babTerakhir);
                            tdNilaiBab.innerHTML = `<input type="text" class="form-control form-control-sm bg-light" value="0,00" readonly><small class="text-muted">Rata-rata</small>`;
                            row.appendChild(tdNilaiBab);
                        });
                    });
                }
                document.addEventListener('click', function(e) {
                    const button = e.target.closest('.tambah-pertemuan');
                    if (!button) {
                        return;
                    }
                    const bab = parseInt(button.dataset.bab);
                    const headerBab = document.querySelector(`th[data-header-bab="${bab}"]`);
                    if (!headerBab) {
                        return;
                    }
                    let jumlahKolom = parseInt(headerBab.colSpan);
                    let jumlahPertemuan = jumlahKolom - 1;
                    jumlahPertemuan++;
                    headerBab.colSpan = jumlahPertemuan + 1;
                    const th = document.createElement('th');
                    th.setAttribute('data-bab', bab);
                    th.innerHTML = `P${jumlahPertemuan}`;
                    const rowPertemuan = document.querySelectorAll('#tabelNilai thead tr')[1];
                    const nilaiBabHeader = rowPertemuan.querySelector(`th[data-nilai-bab="${bab}"]`);
                    if (nilaiBabHeader) {
                        rowPertemuan.insertBefore(th, nilaiBabHeader);
                    } else {
                        rowPertemuan.appendChild(th);
                    }
                    document.querySelectorAll('#tabelNilai tbody tr').forEach(function(row) {
                        const idSiswa = row.dataset.siswa;
                        const td = document.createElement('td');
                        td.setAttribute('data-bab', bab);
                        td.innerHTML = `<input type="number" class="form-control form-control-sm" name="nilai_bab[${bab}][${jumlahPertemuan}][${idSiswa}]" min="0" max="100" step="0.01"><small class="text-muted d-block">-</small>`;
                        const nilaiBabCell = row.querySelector(`td[data-nilai-bab="${bab}"]`);
                        if (nilaiBabCell) {
                            row.insertBefore(td, nilaiBabCell);
                        } else {
                            row.appendChild(td);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
