@extends('guru.layouts.app')
@section('title', 'Cetak Rapor Siswa')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4>Cetak Rapor Siswa</h4>
                <p class="mb-0">Klik nama siswa untuk melihat preview rapor. Gunakan tombol "Download Semua" untuk
                    mengunduh ZIP berisi semua rapor.</p>
            </div>
            @if ($kelas && $siswas->count() > 0)
                <a href="{{ route('guru.kelas.rapor.download_all') }}" class="btn btn-primary">
                    <i class="bi bi-download"></i> Download Semua Rapor
                </a>
            @endif
        </div>

        @if (!$kelas)
            <div class="alert alert-danger">Kelas untuk guru ini belum ditemukan.</div>
        @elseif ($siswas->isEmpty())
            <div class="alert alert-warning">Belum ada siswa di kelas ini.</div>
        @else
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>NIM</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->nim }}</td>
                                        <td>
                                            <a href="{{ route('guru.kelas.rapor.pdf', $siswa->id_siswa) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary me-2">
                                                <i class="bi bi-eye"></i> Preview
                                            </a>
                                            <a href="{{ route('guru.kelas.rapor.download', $siswa->id_siswa) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-file-earmark-pdf"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
