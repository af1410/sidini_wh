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

                    @php
                        $groupedMapels = $mapelsAvailable->groupBy('jenis_mapel');
                    @endphp

                    <div class="row">
                        @foreach ($groupedMapels as $jenis => $mapels)
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0 ">
                                            Mata Pelajaran {{ ucfirst($jenis) }}
                                        </h5>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="60">Pilih</th>
                                                        <th>Nama Mata Pelajaran</th>
                                                        <th width="250">Guru Pengampu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mapels as $mapel)
                                                        <tr>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="mapels[]" value="{{ $mapel->id_mapel }}"
                                                                    {{ in_array($mapel->id_mapel, $mapelsSelected) ? 'checked' : '' }}>
                                                            </td>

                                                            <td>
                                                                {{ $mapel->nama_mapel }}
                                                            </td>

                                                            <td>
                                                                <select class="form-select form-select-sm"
                                                                    name="guru_mapel[{{ $mapel->id_mapel }}]">

                                                                    <option value="">
                                                                        -- Pilih Guru --
                                                                    </option>

                                                                    @foreach ($mapel->guruMapels as $guruMapel)
                                                                        <option value="{{ $guruMapel->id_guru }}"
                                                                            {{ ($guruSelectedId[$mapel->id_mapel] ?? null) == $guruMapel->id_guru ? 'selected' : '' }}>
                                                                            {{ $guruMapel->guru->nama_guru }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>

                    <div class="d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-floppy-fill me-1"></i> Simpan</button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary"><i
                                class="bi bi-x-lg me-1"></i>
                            Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Mata Pelajaran yang Dipilih</h5>
            </div>

            <div class="card-body">

                @php
                    $mapelTerpilih = $mapelsAvailable->whereIn('id_mapel', $mapelsSelected)->groupBy('jenis_mapel');
                @endphp

                @if ($mapelTerpilih->count())
                    <div class="row">
                        @foreach ($mapelTerpilih as $jenis => $mapels)
                            <div class="col-lg-6 mb-4">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 text-primary fw-bold">
                                            Mata Pelajaran {{ ucfirst($jenis) }}
                                        </h6>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="60">No</th>
                                                        <th>Nama Mata Pelajaran</th>
                                                        <th>Guru Pengampu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mapels as $mapel)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>

                                                            <td>
                                                                {{ $mapel->nama_mapel }}
                                                            </td>

                                                            <td>
                                                                <span class="badge bg-success">
                                                                    {{ $guruSelected[$mapel->id_mapel] ?? 'Belum ada guru' }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning mb-0">
                        <strong>Belum ada mata pelajaran dipilih untuk kelas ini.</strong>
                    </div>
                @endif

            </div>
        </div>
    @endsection
