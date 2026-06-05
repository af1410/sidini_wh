@extends('siswa.layouts.app')

@section('title', 'Nilai Saya')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Nilai Saya</h5>
                <small class="text-muted">Siswa: {{ $siswa->nama_siswa }}</small>
            </div>
            <div class="card-body">
                @if ($nilaiPerSemester->isEmpty())
                    <div class="alert alert-info">Belum ada data nilai untuk saat ini.</div>
                @else
                    @foreach ($nilaiPerSemester as $semester => $items)
                        <h6 class="mt-4">Semester: {{ $semester }}</h6>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mapel</th>
                                        <th>Formatif</th>
                                        @php
                                            $babs = $babColumnsPerSemester[$semester] ?? [];
                                        @endphp
                                        @foreach ($babs as $bab)
                                            <th>Bab {{ $bab }}</th>
                                        @endforeach
                                        <th>Sumatif</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $n)
                                        <tr>
                                            <td>
                                                {{ $n->mapel?->nama_mapel ?? $n->id_mapel }}
                                                <div class="mt-1">
                                                    <a href="{{ route('siswa.nilai.sumatif.show', ['id_mapel' => $n->id_mapel, 'semester' => $n->semester]) }}"
                                                        class="btn btn-sm btn-outline-primary">Detail Sumatif</a>
                                                </div>
                                            </td>
                                            <td>{{ isset($n->nilai_formatif) ? number_format($n->nilai_formatif, 2) : '-' }}
                                            </td>
                                            @foreach ($babs as $bab)
                                                @php
                                                    $val = $n->nilai_per_bab[$bab] ?? null;
                                                @endphp
                                                <td>{{ isset($val) ? number_format($val, 2) : '-' }}</td>
                                            @endforeach
                                            <td>{{ isset($n->nilai_sumatif) ? number_format($n->nilai_sumatif, 2) : '-' }}
                                            </td>
                                            <td>{{ isset($n->nilai_akhir) ? number_format($n->nilai_akhir, 2) : '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
