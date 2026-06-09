@extends('admin.layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">

            <h4 class="mb-0">
                Approval Nilai
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Guru</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Terlambat</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($data as $item)
                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->guru->nama_guru ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->mapel->nama_mapel ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->kelas->nama_kelas ?? '-' }}
                                </td>

                                <td>

                                    @if ($item->jenis_penilaian == 'formatif')
                                        Formatif
                                    @elseif($item->tipe_sumatif)
                                        {{ strtoupper($item->tipe_sumatif) }}
                                    @else
                                        Bab {{ $item->bab_ke }}
                                    @endif

                                </td>

                                <td>

                                    {{ now()->diffInDays($item->tanggal_selesai) }}
                                    Hari

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <form action="{{ route('admin.approval.approve', $item->id) }}" method="POST">

                                            @csrf

                                            <button class="btn btn-success btn-sm">

                                                Approve

                                            </button>

                                        </form>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#rejectModal{{ $item->id }}">

                                            Tolak

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <form action="{{ route('admin.approval.reject', $item->id) }}" method="POST">

                                            @csrf

                                            <div class="modal-header">

                                                <h5 class="modal-title">

                                                    Alasan Penolakan

                                                </h5>

                                            </div>

                                            <div class="modal-body">

                                                <textarea name="catatan" class="form-control" rows="4" required></textarea>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                                    Batal

                                                </button>

                                                <button type="submit" class="btn btn-danger">

                                                    Tolak

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center">

                                    Tidak ada permintaan approval

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{ $data->links() }}

        </div>

    </div>
@endsection
