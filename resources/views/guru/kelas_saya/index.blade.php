@extends('guru.layouts.app')
@section('title', 'Kelas Saya')

@section('content')
    <div class="container">
        <h4>Detail Kelas</h4>

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
                    <p><strong>ID Kelas:</strong> {{ $kelas->id_kelas }}</p>
                    <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                    <p><strong>Tahun Ajar:</strong> {{ $kelas->tahun_ajar }}</p>
                    <p><strong>Kelas:</strong> {{ $kelas->kelas }}</p>
                    <p><strong>Rombel:</strong> {{ $kelas->rombel }}</p>
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
                                        <th rowspan="2">Nama Siswa</th>

                                        @foreach ($mapels as $mapel)
                                            <th colspan="4" class="text-center">
                                                {{ $mapel->nama_mapel }}
                                            </th>
                                        @endforeach
                                    </tr>

                                    <tr>
                                        @foreach ($mapels as $mapel)
                                            <th>Rata BAB</th>
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
                                                    {{ $nilai->rata_bab ?? '-' }}
                                                </td>

                                                <td>
                                                    {{ $nilai->nilai_psts ?? '-' }}
                                                </td>

                                                <td>
                                                    {{ $nilai->nilai_psas ?? '-' }}
                                                </td>

                                                <td class="fw-bold">
                                                    {{ $nilai->nilai_akhir ?? '-' }}
                                                </td>
                                            @endforeach

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
