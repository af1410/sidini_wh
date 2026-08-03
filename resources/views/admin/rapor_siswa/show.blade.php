@extends('admin.layouts.app')
@section('title', 'Rapor Siswa')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="bi bi-file-earmark-text-fill me-2" style="color: var(--primary-color)"></i>Rapor Siswa {{ $kelas->nama_kelas }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Siswa</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th>NIM</th>
                                <th>Nama Siswa</th>
                                <th width="15%">Status</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas->siswas as $siswa)
                                @php
                                    $rapor = $rapors[$siswa->id_siswa] ?? null;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nim }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td class="text-center">
                                        @if (optional($rapor)->status_acc == 'disetujui')
                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>
                                        @elseif (optional($rapor)->status_acc == 'menunggu')
                                            <span class="badge bg-warning">
                                                Menunggu Disetujui
                                            </span>
                                        @elseif (optional($rapor)->status_acc == 'ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Belum Diajukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.rapor_siswa.preview', $siswa->id_siswa) }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                            Preview
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak ada data siswa.
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
