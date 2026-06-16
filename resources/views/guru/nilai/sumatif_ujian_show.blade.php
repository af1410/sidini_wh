@extends('guru.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h4 class="mb-0">
                    Hasil Nilai {{ strtoupper($penilaian->tipe_sumatif) }}
                </h4>

            </div>

            <div class="card-body">

                <div class="row mb-4">

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>
                                <th width="180">Mata Pelajaran</th>
                                <td>{{ $penilaian->mapel->nama_mapel }}</td>
                            </tr>

                            <tr>
                                <th>Kelas</th>
                                <td>{{ $penilaian->kelas->nama_kelas }}</td>
                            </tr>

                            <tr>
                                <th>Guru</th>
                                <td>{{ $penilaian->guru->nama_guru }}</td>
                            </tr>

                            <tr>
                                <th>Semester</th>
                                <td>{{ ucfirst($penilaian->semester) }}</td>
                            </tr>

                            <tr>
                                <th>Jenis Ujian</th>
                                <td>{{ strtoupper($penilaian->tipe_sumatif) }}</td>
                            </tr>

                        </table>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th width="60">No</th>
                                <th>NIM</th>
                                <th>Nama Siswa</th>
                                <th width="150">Nilai {{ strtoupper($penilaian->tipe_sumatif) }}</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($penilaian->kelas->siswas as $siswa)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $siswa->nim ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $siswa->nama_siswa }}
                                    </td>

                                    <td class="text-center">

                                        {{ $nilaiUjian[$siswa->id_siswa]->nilai_ujian ?? '-' }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        Tidak ada data siswa

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    <a href="{{ url()->previous() }}" class="btn btn-secondary">

                        <i class="bi bi-arrow-left me-1"></i> Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection
