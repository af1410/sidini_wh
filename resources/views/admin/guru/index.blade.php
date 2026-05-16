@extends('admin.layouts.app')

@section('title', 'Kelola Guru')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Kelola Guru</h4>
                    <p class="text-muted mb-0">Daftar guru yang terdaftar di sistem.</p>
                </div>
                <a href="{{ route('admin.guru.create') }}" class="btn btn-success">+ Tambah Guru</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Guru</h5>
                <small class="text-muted">Kelola data guru dengan mudah.</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gurus as $guru)
                                <tr>
                                    <td>{{ $loop->iteration + $gurus->firstItem() - 1 }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->nama_guru }}</td>
                                    <td>{{ $guru->jenis_kelamin }}</td>
                                    <td>{{ $guru->jabatan }}</td>
                                    <td>{{ $guru->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.guru.edit', $guru->id_guru) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.guru.destroy', $guru->id_guru) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus guru ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <small>Menampilkan halaman {{ $gurus->currentPage() }} dari {{ $gurus->lastPage() }}</small>
                <div>{{ $gurus->links() }}</div>
            </div>
        </div>
    </div>
@endsection
