@extends('guru.layouts.app')
@section('title', 'Kelas Saya')

@section('content')
    <div class="container">

        @if ($kelas)
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Detail Kelas</h4>
                </div>
                <div>
                    <a href="{{ route('guru.kelas.rapor.index') }}" class="btn btn-primary">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Cetak Rapor Siswa
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                    <p><strong>Tahun Ajar:</strong> {{ $kelas->tahun_ajar }}</p>
                    <p><strong>Wali Kelas:</strong> {{ optional($kelas->waliKelas)->nama_guru ?? 'Belum ada wali kelas' }}
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Daftar Siswa</h5>
                </div>
                <div class="card-body">
                    @if ($kelas->siswas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2" style="min-width: 150px;">Nama Siswa</th>

                                        @foreach ($mapels as $mapel)
                                            <th colspan="5" class="text-center">
                                                {{ $mapel->nama_mapel }}
                                            </th>
                                        @endforeach

                                        <th rowspan="2">Aksi</th>
                                    </tr>

                                    <tr>
                                        @foreach ($mapels as $mapel)
                                            <th>Sumatif</th>
                                            <th>Formatif</th>
                                            <th>PSTS</th>
                                            <th>PSAS</th>
                                            <th>Nilai Akhir</th>
                                        @endforeach

                                    </tr>


                                </thead>

                                <tbody>

                                    @foreach ($kelas->siswas as $index => $siswa)
                                        <tr>

                                            <td>{{ $index + 1 }}</td>

                                            <td>{{ $siswa->nama_siswa }}</td>

                                            @foreach ($mapels as $mapel)
                                                @php
                                                    $nilai = $nilaiAkhir[$siswa->id_siswa][$mapel->id_mapel][0] ?? null;
                                                @endphp

                                                <td>
                                                    @if ($nilai && $nilai->rata_bab !== null && $nilai->rata_bab != 0)
                                                        {{ number_format($nilai->rata_bab, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($nilai && $nilai->rata_bab_formatif !== null && $nilai->rata_bab_formatif != 0)
                                                        {{ number_format($nilai->rata_bab_formatif, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($nilai && $nilai->nilai_psts !== null && $nilai->nilai_psts != 0)
                                                        {{ number_format($nilai->nilai_psts, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($nilai && $nilai->nilai_psas !== null && $nilai->nilai_psas != 0)
                                                        {{ number_format($nilai->nilai_psas, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="fw-bold">
                                                    @if ($nilai && $nilai->nilai_akhir !== null && $nilai->nilai_akhir != 0)
                                                        {{ number_format($nilai->nilai_akhir, 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td>
                                                <a href="{{ route('guru.kelas_saya.lengkapi_rapor', $siswa->id_siswa) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Lengkapi Rapor
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Belum ada siswa di kelas ini.
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                Kelas untuk guru ini belum ditemukan.
            </div>
        @endif
    </div>
@endsection
