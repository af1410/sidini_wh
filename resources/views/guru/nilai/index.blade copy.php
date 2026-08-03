@extends('guru.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3"><i class="bi bi-file-earmark-text me-2 " style="color: var(--primary-color)"></i>Penilaian Dibuka</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Jenis</th>
                                <th>Semester</th>
                                <th>Bab</th>
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    @php
                                        $hasNilai = $item->nilai_formatif_count > 0 || $item->nilai_sumatif_count > 0 || $item->nilai_ujian_count > 0;
                                        $isPastDeadline = now()->gt($item->tanggal_selesai);
                                    @endphp
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->mapel->nama_mapel }}
                                        <br>
                                        <small>{{ $item->mapel->jenis_mapel }}</small>
                                    </td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ ucfirst($item->jenis_penilaian) }}</td>
                                    <td>{{ ucfirst($item->semester) }}</td>
                                    <td>
                                        @if ($item->jenis_penilaian == 'sumatif')
                                            @if ($item->bab_ke)
                                                Bab {{ $item->bab_ke }}
                                                <br>
                                                <small>{{ $item->judul_bab }}</small>
                                            @else
                                                {{ strtoupper($item->tipe_sumatif) }}
                                            @endif
                                        @else
                                            Formatif
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_mulai)) }}
                                        <br>
                                        s/d
                                        <br>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_selesai)) }}
                                    </td>
                                    <td>
                                        @if ($hasNilai)
                                            <a href="{{ route('guru.nilai.sumatif_ujian.show', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="bi bi-eye me-1"></i> Lihat Nilai
                                                {{ strtoupper($item->tipe_sumatif) }}
                                            </a>
                                        @elseif ($isPastDeadline)
                                            @if ($item->status_approval == 'menunggu_approval')
                                                <button class="btn btn-warning btn-sm" disabled>
                                                    <i class="bi bi-clock me-1"></i> Menunggu Persetujuan
                                                </button>
                                            @elseif ($item->status_approval == 'disetujui')
                                                <a href="{{ route('guru.nilai.sumatif_ujian.create', $item->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="bi bi-journal-check me-1"></i> Input Nilai
                                                    {{ strtoupper($item->tipe_sumatif) }}
                                                </a>
                                            @else
                                                <form action="{{ route('guru.nilai.requestApproval', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-warning btn-sm" type="submit">
                                                        <i class="bi bi-send me-1"></i> Minta Approve
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('guru.nilai.sumatif_ujian.create', $item->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-journal-check me-1"></i>Input Nilai
                                                {{ strtoupper($item->tipe_sumatif) }}
                                            </a>
                                        @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada penilaian dibuka.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
