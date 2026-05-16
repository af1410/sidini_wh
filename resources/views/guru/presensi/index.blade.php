@extends('guru.layouts.app')

@section('title', 'Presensi Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Presensi Siswa</h4>
                    <p class="text-muted mb-0">Lihat kehadiran dan tandai siswa yang tidak hadir.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h6>Hadir</h6>
                                    <strong>{{ $hadirCount }}</strong>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <h6>Terlambat</h6>
                                    <strong>{{ $terlambatCount }}</strong>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="p-3 bg-light rounded">
                                    <h6>Izin</h6>
                                    <strong>{{ $izinCount }}</strong>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="p-3 bg-light rounded">
                                    <h6>Sakit</h6>
                                    <strong>{{ $sakitCount }}</strong>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="p-3 bg-light rounded">
                                    <h6>Alpha</h6>
                                    <strong>{{ $alphaCount }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-0">Tanggal:
                                <strong>{{ \Illuminate\Support\Carbon::parse($tanggal)->format('d M Y') }}</strong></p>
                            <p class="mb-0">Belum ada catatan: <strong>{{ $belumCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Kelas</h5>
            </div>
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
                        @foreach ($siswa as $index => $item)
                            @php
                                $presensi = $presensiHariIni->get($item->id_siswa);
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
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Izin</button>
                                            </form>
                                            <form action="{{ route('guru.presensi.status', $item->id_siswa) }}"
                                                method="POST" class="m-0">
                                                @csrf
                                                <input type="hidden" name="status" value="Sakit">
                                                <button type="submit" class="btn btn-sm btn-outline-info">Sakit</button>
                                            </form>
                                            <form action="{{ route('guru.presensi.status', $item->id_siswa) }}"
                                                method="POST" class="m-0">
                                                @csrf
                                                <input type="hidden" name="status" value="Alpha">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Alpha</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
