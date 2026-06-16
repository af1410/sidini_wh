@extends('guru.layouts.app')
@section('title', 'Detail Mapel')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Detail Kelas</h4>
                <p class="text-muted mb-0">Daftar mapel dan siswa pada kelas ini.</p>
            </div>
            <a href="{{ route('guru.mapel.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-2">{{ $kelas->nama_kelas }}</h5>
                <p class="mb-1"><strong>ID Kelas:</strong> {{ $kelas->id_kelas }}</p>
                <p class="mb-1"><strong>Tahun Ajar:</strong> {{ $kelas->tahun_ajar }}</p>
                <p class="mb-1"><strong>Kelas:</strong> {{ $kelas->kelas }}</p>
                <p class="mb-1"><strong>Rombel:</strong> {{ $kelas->rombel }}</p>
                <p class="mb-0">
                    <strong>Wali Kelas:</strong>
                    {{ $kelas->waliKelas->nama_guru ?? 'Belum ada wali kelas' }}
                </p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Mapel di Kelas Ini</h5>
            </div>
            <div class="card-body">
                @if ($kelas->mapels->count() > 0)
                    <div class="row g-3">
                        @foreach ($kelas->mapels as $mapel)
                            <div class="col-md-6 col-lg-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-1">{{ $mapel->nama_mapel }}</h6>
                                        <p class="mb-1 text-muted">
                                            {{ $mapel->jenis_mapel }} - {{ $mapel->tahun_ajaran }}
                                        </p>

                                        <a href="{{ route('guru.nilai_formatif.show', [
                                            'id_kelas' => $kelas->id_kelas,
                                            'id_mapel' => $mapel->id_mapel,
                                        ]) }}"
                                            class="btn btn-primary btn-sm mt-2">
                                            <i class="bi bi-journal-text me-1"></i> Nilai Formatif
                                        </a>

                                        <a href="{{ route('guru.nilai_sumatif.show', [
                                            'id_kelas' => $kelas->id_kelas,
                                            'id_mapel' => $mapel->id_mapel,
                                        ]) }}"
                                            class="btn btn-success btn-sm mt-2">
                                            <i class="bi bi-journal-check me-1"></i> Nilai Sumatif
                                        </a>

                                        <a href="{{ route('guru.nilai_akhir.show', [
                                            'id_kelas' => $kelas->id_kelas,
                                            'id_mapel' => $mapel->id_mapel,
                                        ]) }}"
                                            class="btn btn-primary btn-sm mt-2">
                                            <i class="bi bi-award me-1"></i> Nilai Akhir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning mb-0">
                        Belum ada mapel.
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Daftar Siswa</h5>
            </div>
            <div class="card-body">
                @if ($kelas->siswas->count() > 0)
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Waktu Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas->siswas as $index => $item)
                                    @php
                                        $presensi = isset($presensiHariIni)
                                            ? $presensiHariIni->get($item->id_siswa)
                                            : null;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nim }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->dataKelas->nama_kelas ?? '-' }}</td>
                                        <td>
                                            @if ($presensi)
                                                <span
                                                    class="badge bg-{{ $presensi->status === 'Hadir' ? 'success' : ($presensi->status === 'Terlambat' ? 'warning' : ($presensi->status === 'Izin' ? 'info' : ($presensi->status === 'Sakit' ? 'primary' : 'secondary'))) }}">
                                                    {{ $presensi->status }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Belum</span>
                                            @endif
                                        </td>
                                        <td>{{ $presensi->waktu_masuk ?? '-' }}</td>
                                        <td>
                                            @if ($presensi && in_array($presensi->status, ['Hadir', 'Terlambat']))
                                                <span class="text-muted">Tidak dapat diubah</span>
                                            @else
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <form action="{{ route('guru.presensi.status', $item->id_siswa) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Izin">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-primary">Izin</button>
                                                    </form>
                                                    <form action="{{ route('guru.presensi.status', $item->id_siswa) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Sakit">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-info">Sakit</button>
                                                    </form>
                                                    <form action="{{ route('guru.presensi.status', $item->id_siswa) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Alpha">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Alpha</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
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
    </div>
@endsection
