@extends('admin.layouts.app')
@section('title', 'Kelola Siswa')
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
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1">Kelola Siswa</h4>
                    <p class="text-muted mb-0">Menampilkan <strong>{{ $siswa->count() }}</strong> siswa dari <strong>{{ $totalCount }}</strong> total siswa.</p>
                </div>
                <a href="{{ route('admin.siswa.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Siswa
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Filter Data</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.siswa.index') }}" method="GET">
                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" class="form-select">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelasOptions as $kelas)
                                    <option value="{{ $kelas->id_kelas }}" {{ request('kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Angkatan</label>
                            <select name="angkatan" class="form-select">
                                <option value="">Semua Angkatan</option>
                                @foreach ($angkatanOptions as $angkatan)
                                    <option value="{{ $angkatan }}" {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                                        {{ $angkatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cari</label>
                            <input type="text" name="keyword" class="form-control" placeholder="Nama / NIM / NISN" value="{{ request('keyword') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button class="btn btn-primary w-100">
                                Terapkan
                            </button>
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary w-100">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-3 d-none" id="bulkActionCard">
            <div class="card-body">
                <form action="{{ route('admin.siswa.bulk-status') }}" method="POST" id="bulkForm">
                    @csrf
                    @method('PUT')
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label mb-1">
                                <span id="selectedCount">0</span> siswa dipilih
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status Baru --</option>
                                <option value="aktif">Aktif</option>
                                <option value="lulus">Lulus</option>
                                <option value="pindah">Pindah</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button"
                                class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#bulkStatusModal">
                                <i class="bi bi-arrow-repeat me-1"></i>
                                Ubah Status
                            </button>
                        </div>
                    </div>
                    <div id="selectedItems"></div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                </div>
                            </th>
                            <th>No</th>
                            <th>NIM</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $item)
                            <tr>
                                <td>
                                    <div class="form-check m-0">
                                        <input
                                            class="form-check-input row-check" type="checkbox" value="{{ $item->id_siswa }}">
                                    </div>
                                </td>
                                <td>{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->nisn ?? '-' }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="detail-siswa" data-bs-toggle="modal" data-bs-target="#detailSiswa{{ $item->id_siswa }}">
                                        {{ $item->nama_siswa }}
                                    </a>
                                </td>
                                <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $item->dataKelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->angkatan ?? '-' }}</td>
                                <td>
                                    @switch($item->status)
                                        @case('aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @break

                                        @case('lulus')
                                            <span class="badge bg-primary">Lulus</span>
                                        @break

                                        @case('pindah')
                                            <span class="badge bg-warning text-dark">Pindah</span>
                                        @break

                                        @case('keluar')
                                            <span class="badge bg-danger">Keluar</span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#statusModal{{ $item->id_siswa }}">
                                        <i class="bi bi-arrow-repeat me-1"></i>Status
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="statusModal{{ $item->id_siswa }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.siswa.update-status', $item->id_siswa) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Status Siswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Siswa</label>
                                                    <input type="text" class="form-control" value="{{ $item->nama_siswa }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status Saat Ini</label>
                                                    <input type="text" class="form-control" value="{{ ucfirst($item->status) }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Status Baru</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="aktif" {{ $item->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="lulus" {{ $item->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                                        <option value="pindah" {{ $item->status == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                                        <option value="keluar" {{ $item->status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- modal detail siswa --}}
                            <div class="modal fade" id="detailSiswa{{ $item->id_siswa }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header text-white" style=" background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                                            <h5 class="modal-title">
                                                Detail Data Siswa
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close btn-close-white"
                                                data-bs-dismiss="modal">
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center mb-4">
                                                @php
                                                    $foto = $item->foto && Storage::disk('public')->exists($item->foto) ? asset('storage/' . $item->foto) : asset('img/profil_default.png');
                                                @endphp

                                                <img
                                                    src="{{ $foto }}"
                                                    alt="{{ $item->nama_siswa }}"
                                                    class="foto-siswa">

                                                <h5 class="mt-3 mb-0">{{ $item->nama_siswa }}</h5>
                                                <small class="text-muted">{{ $item->nim }}</small>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIM</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->nim }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NISN</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->nisn }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Siswa</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->nama_siswa }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->jenis_kelamin }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->tempat_lahir }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->tanggal_lahir }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Kelas</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->dataKelas->nama_kelas ?? '-' }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Angkatan</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->angkatan }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $item->email }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ ucfirst($item->status) }}"
                                                        readonly>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea
                                                        class="form-control"
                                                        rows="3"
                                                        readonly>{{ $item->alamat }}</textarea>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                                Tutup
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        Tidak ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small>
                        Menampilkan halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
                    </small>
                    {{ $siswa->links() }}
                </div>
            </div>
            <div class="modal fade" id="bulkStatusModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Ubah Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-1">Jumlah siswa dipilih :</p>
                            <h5><span id="modalSelectedCount">0</span> siswa</h5>
                            <p class="mb-0 mt-3">Apakah Anda yakin ingin mengubah status siswa yang dipilih?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-warning" id="btnSubmitBulk">Ya, Ubah Status</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkAll = document.getElementById('checkAll');
                const rowChecks = document.querySelectorAll('.row-check');
                const bulkCard = document.getElementById('bulkActionCard');
                const selectedCount = document.getElementById('selectedCount');
                const modalSelectedCount = document.getElementById('modalSelectedCount');
                const selectedItems = document.getElementById('selectedItems');
                const bulkForm = document.getElementById('bulkForm');
                const btnSubmitBulk = document.getElementById('btnSubmitBulk');

                function updateSelection() {
                    const checked = document.querySelectorAll('.row-check:checked');
                    selectedCount.textContent = checked.length;
                    modalSelectedCount.textContent = checked.length;
                    bulkCard.classList.toggle('d-none', checked.length === 0);
                    selectedItems.innerHTML = '';
                    checked.forEach(function(item) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'siswa[]';
                        input.value = item.value;
                        selectedItems.appendChild(input);
                    });
                }
                if (checkAll) {
                    checkAll.addEventListener('change', function() {
                        rowChecks.forEach(function(item) {
                            item.checked = checkAll.checked;
                        });
                        updateSelection();
                    });
                }
                rowChecks.forEach(function(item) {
                    item.addEventListener('change', function() {
                        const total = rowChecks.length;
                        const checked = document.querySelectorAll('.row-check:checked').length;
                        if (checkAll) {
                            checkAll.checked = total === checked;
                        }
                        updateSelection();
                    });
                });
                btnSubmitBulk.addEventListener('click', function() {
                    bulkForm.submit();
                });
            });
        </script>
    @endsection
