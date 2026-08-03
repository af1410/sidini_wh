@extends('kepsek.layouts.app')
@section('title', 'Rapor Siswa')
@section('content')
    <style>
        .detail-siswa {
            color: inherit;
            text-decoration: none;
            font-weight: normal;
            cursor: pointer;
        }

        .detail-siswa:hover,
        .detail-siswa:focus,
        .detail-siswa:active {
            color: inherit;
            text-decoration: none;
        }

        .foto-siswa {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #dee2e6;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="bi bi-file-earmark-text-fill me-2" style="color: var(--primary-color)"></i>Rapor Siswa {{ $kelas->nama_kelas }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Siswa</h3>
                    <div id="bulkAction" class="d-none">
                        <form id="bulkForm" action="{{ route('kepsek.rapor_siswa.accSelected') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check-circle"></i>
                                Aprove Terpilih
                            </button>
                        </form>
                        {{-- <form action="{{ route('kepsek.rapor_siswa.batalSelected') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" id="btnBatalSelected">
                                <i class="fas fa-times-circle"></i>
                                Batal Aprove Terpilih
                            </button>
                        </form> --}}
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" id="checkAll">
                                </th>
                                <th width="5%">No</th>
                                <th>NIM</th>
                                <th>Nama Siswa</th>
                                <th width="15%">Status</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas->siswas as $siswa)
                                @php
                                    $rapor = $rapors[$siswa->id_siswa] ?? null;
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        @if (optional($rapor)->status_acc !== 'disetujui')
                                            <input type="checkbox" class="row-check" form="bulkForm" name="siswa[]" value="{{ $siswa->id_siswa }}">
                                        @else
                                            <i class="bi bi-check-circle text-success"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nim }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="detail-siswa" data-bs-toggle="modal" data-bs-target="#detailSiswa{{ $siswa->id_siswa }}">
                                            {{ $siswa->nama_siswa }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if (optional($rapor)->status_acc == 'disetujui')
                                            <span class="badge bg-success">
                                                Disetujui
                                            </span>
                                        @elseif (optional($rapor)->status_acc == 'menunggu')
                                            <span class="badge bg-warning">
                                                Menunggu Disetujui
                                            </span>
                                        @elseif (optional($rapor)->status_acc == 'ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Belum Diajukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{-- Mode Normal --}}
                                        <div class="normal-action">
                                            <button type="button" class="btn btn-secondary btn-sm btn-lihat-nilai" data-id="{{ $siswa->id_siswa }}">
                                                <i class="bi bi-file-earmark"></i>
                                                Lihat Nilai
                                            </button>
                                            <a href="{{ route('kepsek.rapor_siswa.preview', $siswa->id_siswa) }}" target="_blank" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                                Preview
                                            </a>
                                        </div>

                                        {{-- Mode Aprove --}}
                                        @if (!$rapor || $rapor->status_acc != 'disetujui')
                                            <div class="acc-action d-none">
                                                <form action="{{ route('kepsek.rapor_siswa.acc', $siswa->id_siswa) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i>
                                                        Aprove
                                                    </button>
                                                </form>
                                            </div>
                                        @endif

                                    </td>
                                </tr>

                                {{-- modal detail siswa --}}
                                <div class="modal fade" id="detailSiswa{{ $siswa->id_siswa }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header text-white" style=" background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                                                <h5 class="modal-title">
                                                    Detail Data Siswa
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                    @php
                                                        $foto = $siswa->foto && Storage::disk('public')->exists($siswa->foto) ? asset('storage/' . $siswa->foto) : asset('img/profil_default.png');
                                                    @endphp
                                                    <img src="{{ $foto }}" alt="{{ $siswa->nama_siswa }}" class="foto-siswa">
                                                    <h5 class="mt-3 mb-0">{{ $siswa->nama_siswa }}</h5>
                                                    <small class="text-muted">{{ $siswa->nim }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">NIM</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->nim }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">NISN</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->nisn }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Nama Siswa</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->nama_siswa }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->jenis_kelamin }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->tempat_lahir }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Tanggal Lahir</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->tanggal_lahir }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Kelas</label>
                                                        <input type="text" class="form-control" value="{{ $siswa->dataKelas->nama_kelas ?? '-' }}" readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Angkatan</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $siswa->angkatan }}"
                                                            readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $siswa->email }}"
                                                            readonly>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Status</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ ucfirst($siswa->status) }}"
                                                            readonly>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea
                                                            class="form-control"
                                                            rows="3"
                                                            readonly>{{ $siswa->alamat }}</textarea>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Tidak ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Nilai -->
    <div class="modal fade" id="modalNilai" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style=" background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                    <h5 class="modal-title">
                        <i class="fas fa-chart-bar me-2"></i>
                        Detail Nilai Siswa
                    </h5>

                    <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div id="loadingNilai" class="text-center py-5 d-none">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2 mb-0">
                            Memuat data nilai...
                        </p>
                    </div>
                    <div id="detailNilaiContent">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const checkAll = document.getElementById('checkAll');
        const rowChecks = document.querySelectorAll('.row-check');
        const bulkAction = document.getElementById('bulkAction');
        const bulkForm = document.getElementById('bulkForm');
        const btnBatalSelected = document.getElementById('btnBatalSelected');

        document.querySelectorAll('.btn-lihat-nilai').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let id = this.dataset.id;
                let modal = new bootstrap.Modal(
                    document.getElementById('modalNilai')
                );
                document.getElementById('loadingNilai')
                    .classList.remove('d-none');
                document.getElementById('detailNilaiContent')
                    .innerHTML = '';
                modal.show();
                fetch('/kepsek/kelas/' + id + '/detail-nilai')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('loadingNilai')
                            .classList.add('d-none');
                        document.getElementById('detailNilaiContent')
                            .innerHTML = html;
                    });
            });
        });

        function updateBulkAction() {
            const checked = document.querySelectorAll('.row-check:checked');
            bulkAction.classList.toggle('d-none', checked.length === 0);
            document.querySelectorAll('tbody tr').forEach(function(row) {
                const normal = row.querySelector('.normal-action');
                const acc = row.querySelector('.acc-action');
                if (!normal) return;
                if (checked.length > 0) {
                    normal.classList.add('d-none');
                    if (acc) {
                        acc.classList.remove('d-none');
                    }
                } else {
                    normal.classList.remove('d-none');
                    if (acc) {
                        acc.classList.add('d-none');
                    }
                }
            });
        }
        checkAll.addEventListener('change', function() {
            rowChecks.forEach(function(cb) {
                cb.checked = checkAll.checked;
            });
            updateBulkAction();
        });
        rowChecks.forEach(function(cb) {
            cb.addEventListener('change', function() {
                checkAll.checked = rowChecks.length === document.querySelectorAll('.row-check:checked').length;
                updateBulkAction();
            });
        });
        btnBatalSelected.addEventListener('click', function() {
            bulkForm.action = "{{ route('kepsek.rapor_siswa.batalSelected') }}";
        });
        bulkForm.addEventListener('submit', function() {
            if (bulkForm.action !== "{{ route('kepsek.rapor_siswa.batalSelected') }}") {
                bulkForm.action = "{{ route('kepsek.rapor_siswa.accSelected') }}";
            }
        });
        updateBulkAction();
    </script>
@endpush
