@extends('guru.layouts.app')

@section('title', 'Nilai Sumatif')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Nilai Sumatif</h4>

                <p class="text-muted mb-0">
                    {{ $penilaians->first()->mapel->nama_mapel }}
                    -
                    {{ $penilaians->first()->kelas->nama_kelas }}
                </p>
            </div>

            <div class="d-flex gap-2">

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBobot">

                    <i class="bi bi-gear"></i>
                    Pengaturan Bobot

                </button>

                <a href="{{ route('guru.mapel.show', $penilaians->first()->id_mapel) }}" class="btn btn-secondary">

                    Kembali

                </a>

            </div>
        </div>

        <form action="{{ route('guru.nilai_sumatif.store') }}" method="POST">

            @csrf

            <input type="hidden" name="bobot_tugas" id="bobot_tugas" value="{{ $bobotTugas ?? 40 }}">

            <input type="hidden" name="bobot_tes_tulis" id="bobot_tes_tulis" value="{{ $bobotTesTulis ?? 50 }}">

            <input type="hidden" name="bobot_kehadiran" id="bobot_kehadiran" value="{{ $bobotKehadiran ?? 10 }}">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        Penilaian Sumatif
                    </h5>

                    <button type="button" id="btnTambahTugas" class="btn btn-success btn-sm">

                        + Tugas

                    </button>

                    <button type="button" id="btnTambahBab" class="btn btn-primary btn-sm">

                        + Bab Baru

                    </button>

                </div>

                <div class="card-body p-0 table-responsive">

                    <table class="table table-bordered align-middle mb-0" id="tabelSumatif">

                        <thead>

                            <tr>

                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>

                                @foreach ($babList as $bab)
                                    <th colspan="{{ count($tugasPerBab[$bab]) + 3 }}" data-header-bab="{{ $bab }}"
                                        data-jumlah-tugas="{{ count($tugasPerBab[$bab]) }}">
                                        Bab {{ $bab }}
                                    </th>
                                @endforeach

                            </tr>

                            <tr>

                                @foreach ($babList as $bab)
                                    @foreach ($tugasPerBab[$bab] as $tugas)
                                        <th data-bab="{{ $bab }}" class="kolom-tugas">

                                            T{{ $tugas }}

                                        </th>
                                    @endforeach

                                    <th data-bab="{{ $bab }}" data-type="tes">
                                        Tes Tulis
                                    </th>

                                    <th data-bab="{{ $bab }}" data-type="hadir">
                                        Kehadiran
                                    </th>

                                    <th data-bab="{{ $bab }}" data-type="nilai">
                                        Nilai Bab
                                    </th>
                                @endforeach

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($siswa as $index => $item)
                                <tr data-siswa="{{ $item->id_siswa }}">

                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $item->nama_siswa }}</td>

                                    @foreach ($penilaians as $penilaian)
                                        @php
                                            $bab = $penilaian->bab_ke;
                                            $isBabAktif = $bab == $babAktif;
                                            $lastTugas = max($tugasPerBab[$bab]);
                                        @endphp

                                        @foreach ($tugasPerBab[$bab] as $tugas)
                                            @php
                                                $nilaiTugas =
                                                    $nilaiPivot[$bab][$item->id_siswa]['tugas'][$tugas] ?? null;
                                            @endphp
                                            <td>

                                                <input type="number" min="0" max="100"
                                                    class="form-control form-control-sm"
                                                    name="tugas[{{ $penilaian->id }}][{{ $item->id_siswa }}][{{ $tugas }}]"
                                                    value="{{ $nilaiTugas }}"
                                                    {{ $nilaiTugas !== null ? 'readonly' : '' }}>

                                            </td>
                                        @endforeach

                                        <td>

                                            <input type="number" min="0" max="100"
                                                class="form-control form-control-sm"
                                                name="tes_tulis[{{ $penilaian->id }}][{{ $item->id_siswa }}]"
                                                value="{{ $nilaiPivot[$bab][$item->id_siswa]['tes_tulis'] ?? '' }}"
                                                {{ !$isBabAktif ? 'readonly' : '' }}>

                                        </td>

                                        <td>

                                            <input type="number" min="0" max="100"
                                                class="form-control form-control-sm"
                                                name="kehadiran[{{ $penilaian->id }}][{{ $item->id_siswa }}]"
                                                value="{{ $nilaiPivot[$bab][$item->id_siswa]['kehadiran'] ?? '' }}"
                                                {{ !$isBabAktif ? 'readonly' : '' }}>

                                        </td>

                                        <td>

                                            <input type="text" readonly class="form-control form-control-sm bg-light"
                                                value="{{ $nilaiPivot[$bab][$item->id_siswa]['nilai_bab'] ?? 0 }}">

                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="card-footer text-end">

                    <button class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

    {{-- Modal Bobot --}}
    <div class="modal fade" id="modalBobot" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Pengaturan Bobot
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Bobot Tugas (%)</label>

                        <input type="number" class="form-control" id="modal_bobot_tugas" value="{{ $bobotTugas ?? 40 }}">
                    </div>

                    <div class="mb-3">
                        <label>Bobot Tes Tulis (%)</label>

                        <input type="number" class="form-control" id="modal_bobot_tes" value="{{ $bobotTesTulis ?? 50 }}">
                    </div>

                    <div class="mb-3">
                        <label>Bobot Kehadiran (%)</label>

                        <input type="number" class="form-control" id="modal_bobot_hadir"
                            value="{{ $bobotKehadiran ?? 10 }}">
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="simpanBobot">

                        Simpan

                    </button>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('simpanBobot')
                    .addEventListener('click', function() {

                        document.getElementById('bobot_tugas').value =
                            document.getElementById('modal_bobot_tugas').value;

                        document.getElementById('bobot_tes_tulis').value =
                            document.getElementById('modal_bobot_tes').value;

                        document.getElementById('bobot_kehadiran').value =
                            document.getElementById('modal_bobot_hadir').value;

                        bootstrap.Modal
                            .getInstance(
                                document.getElementById('modalBobot')
                            )
                            .hide();
                    });

                let babTerakhir = {{ count($babList) ? max($babList) : 1 }};

                document.getElementById('btnTambahBab')
                    .addEventListener('click', function() {

                        babTerakhir++;

                        const rowBab =
                            document.querySelectorAll(
                                '#tabelSumatif thead tr'
                            )[0];

                        const rowDetail =
                            document.querySelectorAll(
                                '#tabelSumatif thead tr'
                            )[1];

                        const thBab =
                            document.createElement('th');

                        thBab.setAttribute(
                            'data-header-bab',
                            babTerakhir
                        );

                        thBab.setAttribute(
                            'data-jumlah-tugas',
                            '1'
                        );

                        thBab.setAttribute(
                            'colspan',
                            '4'
                        );

                        thBab.innerHTML =
                            `Bab ${babTerakhir}`;

                        rowBab.appendChild(thBab);

                        rowDetail.insertAdjacentHTML(
                            'beforeend',
                            `
    <th data-bab="${babTerakhir}" data-type="tugas">T1</th>
    <th data-bab="${babTerakhir}" data-type="tes">Tes Tulis</th>
    <th data-bab="${babTerakhir}" data-type="hadir">Kehadiran</th>
    <th data-bab="${babTerakhir}" data-type="nilai">Nilai Bab</th>
`
                        );

                        document.querySelectorAll(
                            '#tabelSumatif tbody tr'
                        ).forEach(function(row) {

                            const idSiswa =
                                row.dataset.siswa;

                            row.insertAdjacentHTML(
                                'beforeend',
                                `
                    <td>
                        <input
                            type="number"
                            min="0"
                            max="100"
                            class="form-control form-control-sm"
                            name="bab_baru[${babTerakhir}][${idSiswa}][tugas][1]">
                    </td>

                    <td>
                        <input
                            type="number"
                            min="0"
                            max="100"
                            class="form-control form-control-sm"
                            name="bab_baru[${babTerakhir}][${idSiswa}][tes]">
                    </td>

                    <td>
                        <input
                            type="number"
                            min="0"
                            max="100"
                            class="form-control form-control-sm"
                            name="bab_baru[${babTerakhir}][${idSiswa}][hadir]">
                    </td>

                    <td>
                        <input
                            type="text"
                            readonly
                            value="0"
                            class="form-control form-control-sm bg-light">
                    </td>
                `
                            );
                        });
                    });

                // ==========================
                // TAMBAH TUGAS
                // ==========================

                document.getElementById('btnTambahTugas')
                    .addEventListener('click', function() {

                        const semuaBab =
                            document.querySelectorAll('[data-header-bab]');

                        const headerBab =
                            semuaBab[semuaBab.length - 1];

                        const babAktif =
                            parseInt(headerBab.dataset.headerBab);

                        let jumlahTugas =
                            parseInt(headerBab.dataset.jumlahTugas);

                        jumlahTugas++;

                        headerBab.dataset.jumlahTugas =
                            jumlahTugas;

                        headerBab.colSpan =
                            parseInt(headerBab.colSpan) + 1;

                        const rowHeader =
                            document.querySelectorAll(
                                '#tabelSumatif thead tr'
                            )[1];

                        const headerBabIni =
                            rowHeader.querySelectorAll(
                                `th[data-bab="${babAktif}"]`
                            );

                        const th = document.createElement('th');

                        th.setAttribute(
                            'data-bab',
                            babAktif
                        );

                        th.innerHTML =
                            'T' + jumlahTugas;

                        rowHeader.insertBefore(
                            th,
                            headerBabIni[headerBabIni.length - 3]
                        );

                        document.querySelectorAll(
                            '#tabelSumatif tbody tr'
                        ).forEach(function(row) {

                            const idSiswa = row.dataset.siswa;

                            const td = document.createElement('td');

                            td.innerHTML = `
        <input
            type="number"
            min="0"
            max="100"
            class="form-control form-control-sm"
            name="bab_baru[${babAktif}][${idSiswa}][tugas][${jumlahTugas}]">
    `;

                            const headerTes =
                                rowHeader.querySelector(
                                    `th[data-bab="${babAktif}"][data-type="tes"]`
                                );

                            const posisiTes =
                                Array.from(rowHeader.children)
                                .indexOf(headerTes);

                            row.insertBefore(
                                td,
                                row.children[posisiTes + 1]
                            );

                        });
                    });
            });
        </script>
    @endpush

@endsection
