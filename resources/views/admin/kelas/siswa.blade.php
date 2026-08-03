@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Data Siswa</h5>
                    <small class="text-muted">
                        {{ $kelas->nama_kelas }} - Tahun Ajaran {{ $kelas->tahun_ajar }}
                    </small>
                </div>

                <div>
                    <a href="{{ route('admin.kelas.TambahSiswa', $kelas) }}"
                        class="btn btn-success">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Siswa
                    </a>

                    <a href="{{ route('admin.kelas.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>NIM</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th style="width: 200px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($siswas as $siswa)
                            <tr>
                                <td>{{ $loop->iteration + ($siswas->firstItem() - 1) }}</td>
                                <td>{{ $siswa->nim }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td class="text-center">

                                    <a href="{{ route('admin.kelas.PindahSiswa', [$kelas, $siswa]) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-arrow-left-right"></i>
                                        Pindah
                                    </a>

                                    {{-- <form action="{{ route('admin.kelas.HapusSiswa', [$kelas, $siswa]) }}" method="POST" onsubmit="return confirm('Hapus siswa dari kelas ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form> --}}


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada data siswa.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {{ $siswas->links() }}

            </div>
        </div>

    </div>
@endsection
