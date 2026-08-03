@extends('guru.layouts.app')

@section('content')
    <div class="container">

        <div class="card">

            <div class="card-header text-dark">

                <h4 class="mb-0">
                    Input Nilai {{ strtoupper($pembukaan->tipe_sumatif) }}
                </h4>

            </div>

            <div class="card-body">


                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                @endif
                <div class="row mb-4">

                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-body">

                                <h6>Informasi Penilaian</h6>

                                <table class="table table-borderless table-sm mb-0">
                                    <tr>
                                        <th width="150">Mata Pelajaran</th>
                                        <td width="10">:</td>
                                        <td>{{ $pembukaan->mapel->nama_mapel }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>:</td>
                                        <td>{{ $pembukaan->kelas->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Guru</th>
                                        <td>:</td>
                                        <td>{{ $pembukaan->guru->nama_guru }}</td>
                                    </tr>
                                    <tr>
                                        <th>Semester</th>
                                        <td>:</td>
                                        <td>{{ ucfirst($pembukaan->semester) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Ujian</th>
                                        <td>:</td>
                                        <td>{{ strtoupper($pembukaan->tipe_sumatif) }}</td>
                                    </tr>
                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <form id="nilaiForm" action="{{ route('guru.nilai.sumatif_ujian.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_penilaian" value="{{ $pembukaan->id }}">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Ujian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nim ?? '-' }}</td>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        <td>
                                            <input type="number"
                                                min="0"
                                                max="100"
                                                step="0.01"
                                                class="form-control"
                                                name="nilai[{{ $siswa->id_siswa }}]"
                                                value="{{ isset($nilaiUjian[$siswa->id_siswa]) ? rtrim(rtrim($nilaiUjian[$siswa->id_siswa], '0'), '.') : '' }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-end">
                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            <i class="bi bi-floppy-fill me-1"></i>Simpan
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                            <i class="bi bi-send me-1"></i>Simpan & Ajukan Approval
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle-fill me-2"></i>Berhasil
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <i class="bi bi-check-circle-fill text-success"
                            style="font-size:70px"></i>

                        <h5 class="mt-3">
                            {{ session('success') }}
                        </h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success"
                            data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="approveModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%)">
                    <h5 class="modal-title text-white">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Konfirmasi
                    </h5>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-2">
                        Apakah Anda yakin ingin mengajukan nilai ini untuk disetujui admin?
                    </p>

                    <div class="alert alert-success mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Setelah diajukan, nilai tidak dapat diubah lagi sampai admin membuka kembali penilaian.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" form="nilaiForm" name="action" value="approve" class="btn btn-success">
                        <i class="bi bi-send me-1"></i>
                        Ya, Ajukan
                    </button>
                </div>

            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            setTimeout(function() {
                let alert = document.querySelector('.alert-success');
                if (alert) {
                    bootstrap.Alert.getOrCreateInstance(alert).close();
                }
            }, 2500);
        </script>
    @endif
@endsection
