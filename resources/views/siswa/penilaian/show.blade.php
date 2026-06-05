@extends('siswa.layouts.app')

@section('title', 'Detail Penilaian')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail: {{ $p->mapel?->nama_mapel ?? 'Penilaian' }} -
                    {{ $p->judul_bab ?? 'Bab ' . ($p->bab_ke ?? '') }}</h5>
                <small class="text-muted">Siswa: {{ $siswa->nama_siswa }}</small>
            </div>
            <div class="card-body">
                <h6>Informasi Penilaian</h6>
                <p><strong>Jenis:</strong> {{ ucfirst($p->jenis_penilaian) }}</p>
                <p><strong>Periode:</strong> {{ optional($p->tanggal_mulai)->format('d M Y') ?? '-' }} -
                    {{ optional($p->tanggal_selesai)->format('d M Y') ?? '-' }}</p>

                @if ($p->jenis_penilaian === 'sumatif')
                    <h6 class="mt-3">Tugas / Komponen</h6>
                    @if ($tugas->isEmpty())
                        <div class="alert alert-info">Belum ada data tugas untuk penilaian ini.</div>
                    @else
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tugas</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $i => $task)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $task->nama_tugas }}</td>
                                        <td>{{ isset($task->nilai) ? number_format($task->nilai, 2) : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2"><strong>Rata-rata tugas:</strong> {{ isset($avg) ? number_format($avg, 2) : '-' }}
                        </div>
                    @endif
                @else
                    <div class="alert alert-info">Penilaian ini bukan jenis sumatif.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
