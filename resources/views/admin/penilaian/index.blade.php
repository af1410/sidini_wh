@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Pembukaan Penilaian</h4>

            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                Buka Penilaian
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                                <th>Kelas / Guru</th>
                                <th>Jenis</th>
                                <th>Bab</th>
                                <th>Semester</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Approval</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->mapel->nama_mapel }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $item->mapel->jenis_mapel }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ $item->kelas->nama_kelas ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            {{ $item->guru->nama_guru ?? '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($item->jenis_penilaian) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->jenis_penilaian == 'sumatif')
                                            Bab {{ $item->bab_ke }}
                                            <br>
                                            <small>{{ $item->judul_bab }}</small>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->semester }}</td>
                                    <td>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_mulai)) }}
                                        <br>
                                        s/d
                                        <br>
                                        {{ date('d M Y H:i', strtotime($item->tanggal_selesai)) }}
                                    </td>
                                    <td>
                                        @if ($item->status_buka == 'dibuka')
                                            <span class="badge bg-success">Dibuka</span>
                                        @else
                                            <span class="badge bg-danger">Ditutup</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_approval == 'normal')
                                            <span class="badge bg-secondary">Normal</span>
                                        @elseif($item->status_approval == 'menunggu_approval')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($item->status_approval == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $hasNilai =
                                                ($item->nilai_formatif_count ?? 0) > 0 ||
                                                ($item->nilai_sumatif_count ?? 0) > 0;
                                            $isExpired = now()->gt($item->tanggal_selesai);
                                        @endphp

                                        <div class="d-flex gap-2 flex-wrap">
                                            @if (!$isExpired)
                                                <a href="{{ route('admin.penilaian.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>

                                                <form action="{{ route('admin.penilaian.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Hapus penilaian?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            @else
                                                @if ($hasNilai)
                                                    <a href="{{ route('admin.penilaian.show', $item->id) }}"
                                                        class="btn btn-info btn-sm">Detail Nilai</a>
                                                @elseif ($item->status_approval == 'menunggu_approval')
                                                    <form action="{{ route('admin.penilaian.approve', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                    </form>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $item->id }}">
                                                        Tolak
                                                    </button>
                                                @endif
                                            @endif
                                        </div>

                                        <div class="modal fade" id="tolakModal{{ $item->id }}">
                                            <div class="modal-dialog">
                                                <form action="{{ route('admin.penilaian.tolak', $item->id) }}"
                                                    method="POST">
                                                    @csrf

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tolak Approval</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Catatan</label>
                                                                <textarea name="catatan" class="form-control" rows="4"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Belum ada data.
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
