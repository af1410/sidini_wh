@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-eye me-2 fs-3"></i> Detail Nilai</h4>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Informasi Penilaian</h6>
                                <p class="mb-2"><strong>Mapel:</strong> {{ $pembukaan->mapel->nama_mapel }}</p>
                                <p class="mb-2"><strong>Kelas:</strong> {{ $pembukaan->kelas->nama_kelas ?? '-' }}</p>
                                <p class="mb-2"><strong>Jenis:</strong> {{ ucfirst($pembukaan->jenis_penilaian) }}</p>
                                <p class="mb-2"><strong>Semester:</strong> {{ ucfirst($pembukaan->semester) }}</p>
                                <p class="mb-2"><strong>Periode:</strong>
                                    {{ date('d M Y H:i', strtotime($pembukaan->tanggal_mulai)) }}
                                    - {{ date('d M Y H:i', strtotime($pembukaan->tanggal_selesai)) }}
                                </p>
                                @if ($pembukaan->jenis_penilaian == 'sumatif')
                                    <p class="mb-0"><strong>Bab:</strong> Bab {{ $pembukaan->bab_ke }} -
                                        {{ $pembukaan->judul_bab }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($nilai->isEmpty())
                    <div class="alert alert-info">
                        Belum ada nilai yang disimpan untuk penilaian ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    @if ($pembukaan->jenis_penilaian == 'sumatif' && $pembukaan->tipe_sumatif == 'PSAS')
                                        <th>Nilai PSAS</th>
                                    @elseif ($pembukaan->jenis_penilaian == 'sumatif' && $pembukaan->tipe_sumatif == 'PSTS')
                                        <th>Nilai PSTS</th>
                                    @elseif ($pembukaan->jenis_penilaian == 'formatif')
                                        <th>Nilai Formatif</th>
                                    @else
                                        <th>Nilai Tes Tulis</th>
                                        <th>Nilai Kehadiran</th>
                                        <th>Rata-rata Tugas</th>
                                        <th>Nilai Bab</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nim ?? '-' }}</td>
                                        <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                        @if ($pembukaan->jenis_penilaian == 'sumatif' && in_array($pembukaan->tipe_sumatif, ['PSAS', 'PSTS']))
                                            <td>{{ $item->nilai_ujian }}</td>
                                        @else
                                            <td>{{ $item->nilai_tes_tulis }}</td>
                                            <td>{{ $item->nilai_kehadiran }}</td>
                                            <td>{{ number_format($item->tugas->avg('nilai') ?? 0, 2) }}</td>
                                            <td>{{ number_format($item->nilai_bab, 2) }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary mt-3"><i
                        class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
@endsection
