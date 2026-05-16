@extends('admin.layouts.app')

@section('title', 'Kelola Mata Pelajaran Kelas - ' . $kelas->nama_kelas)

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Kelola Mata Pelajaran Kelas</h4>
                    <p class="text-muted mb-0">Kelola mata pelajaran untuk kelas: <strong>{{ $kelas->nama_kelas }}</strong>
                    </p>
                </div>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ada kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Pilih Mata Pelajaran</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.kelas.mapel.update', $kelas->id_kelas) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        @forelse ($mapelsAvailable as $mapel)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mapels[]"
                                        value="{{ $mapel->id_mapel }}" id="mapel_{{ $mapel->id_mapel }}"
                                        {{ in_array($mapel->id_mapel, $mapelsSelected) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mapel_{{ $mapel->id_mapel }}">
                                        <strong>{{ $mapel->nama_mapel }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $mapel->jenis_mapel }} -
                                            {{ $mapel->tahun_ajaran }}</small>
                                    </label>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Tidak ada mata pelajaran tersedia. Silakan tambahkan mata pelajaran terlebih dahulu.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Mata Pelajaran yang Dipilih</h5>
            </div>
            <div class="card-body">
                @if (count($mapelsSelected) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Jenis</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapelsAvailable as $mapel)
                                    @if (in_array($mapel->id_mapel, $mapelsSelected))
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mapel->nama_mapel }}</td>
                                            <td><span class="badge bg-info text-dark">{{ $mapel->jenis_mapel }}</span></td>
                                            <td>{{ $mapel->tahun_ajaran }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning mb-0">
                        <strong>Belum ada mata pelajaran dipilih untuk kelas ini.</strong> Pilih setidaknya satu mata
                        pelajaran dan simpan.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
