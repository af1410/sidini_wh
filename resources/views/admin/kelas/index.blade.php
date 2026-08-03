@extends('admin.layouts.app')

@section('title', 'Kelola Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1"><i class="bi bi-house me-2"></i>Kelola Kelas</h4>
                </div>
                <a href="{{ route('admin.kelas.create') }}" class="btn btn-success"><i class="bi bi-plus me-1"></i> Tambah
                    Kelas</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif


        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Kelas</h5>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Tahun Ajar</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $kelas->firstItem() - 1 }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td>{{ $item->tahun_ajar }}</td>
                                    <td>{{ $item->waliKelas->nama_guru ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('admin.kelas.mapel.index', $item->id_kelas) }}"
                                                class="btn btn-sm btn-info" title="Kelola Mapel">
                                                <i class="bi bi-book me-1"></i> Mapel
                                            </a>
                                            <a href="{{ route('admin.kelas.siswa', $item) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="bi bi-people-fill">Siswa</i>
                                            </a>
                                            <a href="{{ route('admin.kelas.edit', $item->id_kelas) }}"
                                                class="btn btn-sm btn-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
                                            <form action="{{ route('admin.kelas.destroy', $item->id_kelas) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus kelas ini?')"><i
                                                        class="bi bi-trash me-1"></i>
                                                    Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small>Menampilkan halaman {{ $kelas->currentPage() }} dari {{ $kelas->lastPage() }}</small>
                <div>{{ $kelas->links() }}</div>
            </div>
        </div>
    </div>
@endsection
