@extends('siswa.layouts.app')

@section('title', 'Sumatif - Mapel')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sumatif - {{ $penilaian->first()?->mapel?->nama_mapel ?? 'Mapel' }}</h5>
                <small class="text-muted">Siswa: {{ $siswa->nama_siswa }}</small>
            </div>
            <div class="card-body">
                @if ($penilaian->isEmpty())
                    <div class="alert alert-info">Belum ada penilaian sumatif untuk mapel/semester ini.</div>
                @else
                    <div class="list-group">
                        @foreach ($penilaian as $p)
                            <?php $ns = $nilaiMap[$p->id] ?? null; ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Bab {{ $p->bab_ke ?? '-' }}</strong> -
                                    {{ $p->judul_bab ?? ($p->keterangan ?? '') }}
                                    <div class="small text-muted">Tanggal:
                                        {{ optional($p->tanggal_mulai)->format('d M Y') ?? '-' }} -
                                        {{ optional($p->tanggal_selesai)->format('d M Y') ?? '-' }}</div>
                                </div>
                                <div class="text-end">
                                    <div>Nilai Bab: {{ isset($ns->nilai_bab) ? number_format($ns->nilai_bab, 2) : '-' }}
                                    </div>
                                    <a href="{{ route('siswa.nilai.penilaian.show', $p->id) }}"
                                        class="btn btn-sm btn-outline-secondary mt-1">Lihat Detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
