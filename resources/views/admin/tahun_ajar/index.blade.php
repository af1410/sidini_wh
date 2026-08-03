@extends('admin.layouts.app')

@section('title', 'Kelola Tahun Ajar')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Kelola Tahun Ajar</h4>
                    <p class="text-muted mb-0">Daftar tahun ajar yang terdaftar di sistem.</p>
                </div>
                <a href="{{ route('admin.tahun_ajar.create') }}" class="btn btn-success"><i class="bi bi-plus me-1"></i> Tambah Tahun Ajar</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Tahun Ajar</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajar</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tahunAjar as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $tahunAjar->firstItem() - 1 }}</td>
                                    <td><strong>{{ $item->tahun_ajar }}</strong></td>
                                    <td>{{ $item->tahun_mulai }}</td>
                                    <td>{{ $item->tahun_selesai }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tanggal_mulai)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}</td>
                                    <td>
                                        @if ($item->status === 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 flex-wrap">
                                            @if ($item->status !== 'aktif')
                                                <form action="{{ route('admin.tahun_ajar.set-aktif', $item->id_tahun_ajar) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-info" title="Set Aktif">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.tahun_ajar.edit', $item->id_tahun_ajar) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            {{-- <form action="{{ route('admin.tahun_ajar.destroy', $item->id_tahun_ajar) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        Tidak ada data tahun ajar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($tahunAjar->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $tahunAjar->links() }}
            </div>
        @endif
    </div>
@endsection
