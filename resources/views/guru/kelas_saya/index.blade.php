@extends('guru.layouts.app')
@section('title', 'Kelas Saya')

@section('content')
    <div class="container">
        <h4>Detail Kelas</h4>

        @if ($kelas)
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>ID Kelas:</strong> {{ $kelas->id_kelas }}</p>
                    <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                    <p><strong>Tahun Ajar:</strong> {{ $kelas->tahun_ajar }}</p>
                    <p><strong>Kelas:</strong> {{ $kelas->kelas }}</p>
                    <p><strong>Rombel:</strong> {{ $kelas->rombel }}</p>
                    <p><strong>Wali Kelas:</strong> {{ optional($kelas->waliKelas)->nama_guru ?? 'Belum ada wali kelas' }}
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Daftar Siswa</h5>
                </div>
                <div class="card-body">
                    @if ($kelas->siswas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas->siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Belum ada siswa di kelas ini.
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                Kelas untuk guru ini belum ditemukan.
            </div>
        @endif
    </div>
@endsection
