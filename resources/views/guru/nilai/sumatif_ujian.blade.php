@extends('guru.layouts.app')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-header bg-warning text-dark">

                <h4 class="mb-0">
                    Input Nilai {{ strtoupper($pembukaan->tipe_sumatif) }}
                </h4>

            </div>

            <div class="card-body">

                <div class="row mb-4">

                    <div class="col-md-6">

                        <div class="card bg-light">

                            <div class="card-body">

                                <h6>Informasi Penilaian</h6>

                                <p class="mb-2">
                                    <strong>Mapel :</strong>
                                    {{ $pembukaan->mapel->nama_mapel }}
                                </p>

                                <p class="mb-2">
                                    <strong>Kelas :</strong>
                                    {{ $pembukaan->kelas->nama_kelas }}
                                </p>

                                <p class="mb-2">
                                    <strong>Guru :</strong>
                                    {{ $pembukaan->guru->nama_guru }}
                                </p>

                                <p class="mb-2">
                                    <strong>Semester :</strong>
                                    {{ ucfirst($pembukaan->semester) }}
                                </p>

                                <p class="mb-0">
                                    <strong>Jenis :</strong>
                                    {{ strtoupper($pembukaan->tipe_sumatif) }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <form action="{{ route('guru.nilai.sumatif_ujian.store') }}" method="POST">

                    @csrf

                    <input type="hidden" name="id_penilaian" value="{{ $pembukaan->id }}">

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Ujian</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($siswas as $siswa)
                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            {{ $siswa->nis ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $siswa->nama_siswa }}
                                        </td>

                                        <td>

                                            <input type="number" min="0" max="100" step="0.01"
                                                class="form-control" name="nilai[{{ $siswa->id_siswa }}]">

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">

                        <button type="submit" class="btn btn-primary">

                            Simpan Nilai

                        </button>

                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
