@extends('admin.layouts.app')

@section('title', 'Daftar Orang Tua')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0">Daftar Orang Tua</h4>
                    <p class="text-muted mb-0">Kelola data orang tua/wali siswa.</p>
                </div>
                <a href="{{ route('admin.ortu.create') }}" class="btn btn-success">+ Tambah Orang Tua</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ortus as $ortu)
                                <tr>
                                    <td>{{ $ortu->id_ortu }}</td>
                                    <td>{{ $ortu->nama_ortu }}</td>
                                    <td>{{ $ortu->no_hp }}</td>
                                    <td>{{ $ortu->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.ortu.edit', $ortu->id_ortu) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.ortu.destroy', $ortu->id_ortu) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus data?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $ortus->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
