@extends('guru.layouts.app')

@section('title', 'Nilai')

@section('content')
    <div class="container">
        <h2 class="mb-3">
            <i class="bi bi-file-earmark-text me-2" style="color: var(--primary-color)"></i>Penilaian Ujian
        </h2>

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
                                <th>Semester</th>
                                <th>Ujian</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->mapel->nama_mapel }}
                                        <br>
                                        <small>{{ $item->mapel->jenis_mapel }}</small>
                                    </td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ ucfirst($item->semester) }}</td>
                                    <td>{{ strtoupper($item->tipe_sumatif) }}</td>
                                    <td>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_mulai)) }}
                                        <br>
                                        s/d
                                        <br>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_selesai)) }}
                                    </td>
                                    <td>
                                        @if ($item->status_approval == 'draft')
                                            <span class="badge bg-secondary">Draft</span>
                                        @elseif($item->status_approval == 'menunggu_approval')
                                            <span class="badge bg-warning text-dark">
                                                Menunggu Approval
                                            </span>
                                        @elseif($item->status_approval == 'disetujui')
                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>
                                        @elseif($item->status_approval == 'published')
                                            <span class="badge bg-primary">
                                                Published
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_approval == 'published' || $item->status_approval == 'disetujui' || $item->status_approval == 'menunggu_approval')
                                            <a href="{{ route('guru.nilai.sumatif_ujian.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye me-1"></i>Detail Nilai
                                            </a>
                                        @else
                                            <a href="{{ route('guru.nilai.sumatif_ujian.create', $item->id) }}" class="btn btn-success btn-sm">
                                                <i class="bi bi-journal-check me-1"></i>Input Nilai
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada penilaian ujian.
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
