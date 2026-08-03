@extends('admin.layouts.app')

@section('title', 'Kelola Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Mapel</h4>
            <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary"><i class="bi bi-plus me-1"></i> Tambah
                Mapel</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('admin.mapel.index') }}" method="GET" class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="keyword" class="form-control"
                            placeholder="Cari kode, nama, atau jenis mapel..." value="{{ $keyword ?? request('keyword') }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-secondary"><i class="bi bi-search me-1"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Guru Pengajar</th>
                                <th>Jenis</th>
                                <th width="200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                    <td>{{ $item->id_mapel ?? '-' }}</td>
                                    <td>{{ $item->nama_mapel }}</td>
                                    <td>
                                        @foreach ($item->guruMapels as $gm)
                                            {{ $gm->guru->nama_guru }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->jenis_mapel }}</td>
                                    <td>
                                        <a href="{{ route('admin.mapel.edit', $item->id_mapel) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.mapel.destroy', $item->id_mapel) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Hapus mapel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-trash me-1"></i>
                                                Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data mapel.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
