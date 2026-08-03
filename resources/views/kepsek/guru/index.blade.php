@extends('kepsek.layouts.app')
@section('title', 'Data Guru')
@section('content')
    <style>
        .detail-guru {
            color: inherit;
            text-decoration: none;
            font-weight: normal;
            cursor: pointer;
        }

        .detail-guru:hover,
        .detail-guru:focus,
        .detail-guru:active {
            color: inherit;
            text-decoration: none;
        }

        .foto-guru {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #dee2e6;
        }
    </style>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Data</h4>
                    <p class="text-muted mb-0">Menampilkan <strong>{{ $data->count() }}</strong> guru dari <strong>{{ $data->total() }}</strong> total guru.</p>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Filter Data</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kepsek.guru.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-select">
                                <option value="">Semua Jabatan</option>
                                <option value="guru" {{ request('jabatan') == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="admin" {{ request('jabatan') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="kepala_sekolah" {{ request('jabatan') == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cari</label>
                            <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Nama / NIP / Email / Username">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                Terapkan
                            </button>
                            <a href="{{ route('kepsek.guru.index') }}" class="btn btn-secondary w-100">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $guru)
                            <tr>
                                <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                                <td>{{ $guru->nip ?? '-' }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="detail-guru" data-bs-toggle="modal" data-bs-target="#detailGuru{{ $guru->id_guru }}">
                                        {{ $guru->nama_guru }}
                                    </a>
                                </td>
                                <td>
                                    @switch($guru->jabatan)
                                        @case('guru')
                                            <span class="badge bg-primary">Guru</span>
                                        @break

                                        @case('admin')
                                            <span class="badge bg-success">Admin</span>
                                        @break

                                        @case('kepala_sekolah')
                                            <span class="badge bg-dark">Kepala Sekolah</span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">{{ ucfirst($guru->jabatan) }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($guru->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $guru->email ?? '-' }}</td>

                            </tr>

                            {{-- modal detail guru --}}
                            <div class="modal fade" id="detailGuru{{ $guru->id_guru }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header text-white" style=" background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                                            <h5 class="modal-title">
                                                Detail Data Guru
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
                                                    $gambar = $guru->gambar && Storage::disk('public')->exists($guru->gambar) ? asset('storage/' . $guru->gambar) : asset('img/profil_default.png');
                                                @endphp

                                                <img
                                                    src="{{ $gambar }}"
                                                    alt="{{ $guru->nama_guru }}"
                                                    class="foto-guru">

                                                <h5 class="mt-3 mb-0">{{ $guru->nama_guru }}</h5>

                                                @if ($guru->status == 'aktif')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                @endif

                                            </div>
                                            <div class="row">

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIP</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->nip }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIK</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->nik }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Guru</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->nama_guru }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->jenis_kelamin }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->tempat_lahir }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->tanggal_lahir }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No Hp</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->no_hp }}"
                                                        readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ $guru->email }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Jabatan</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ ucfirst($guru->jabatan) }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Pendidikan</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="{{ ucfirst($guru->pendidikan) }}"
                                                        readonly>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea
                                                        class="form-control"
                                                        rows="3"
                                                        readonly>{{ $guru->alamat }}</textarea>
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
                                    <td colspan="9" class="text-center py-4">
                                        Tidak ada data guru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small>
                        Menampilkan halaman {{ $data->currentPage() }} dari {{ $data->lastPage() }}
                    </small>
                    {{ $data->links() }}
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
                            <p class="mb-1">Jumlah guru dipilih :</p>
                            <h5><span id="modalSelectedCount">0</span> guru</h5>
                            <p class="mb-0 mt-3">Apakah Anda yakin ingin mengubah status guru yang dipilih?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-warning" id="btnSubmitBulk">Ya, Ubah Status</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkAll = document.getElementById('checkAll');
                const rowChecks = document.querySelectorAll('.row-check');
                const bulkActionCard = document.getElementById('bulkActionCard');
                const selectedCount = document.getElementById('selectedCount');
                const modalSelectedCount = document.getElementById('modalSelectedCount');
                const selectedItems = document.getElementById('selectedItems');
                const bulkForm = document.getElementById('bulkForm');
                const btnSubmitBulk = document.getElementById('btnSubmitBulk');

                function updateSelection() {
                    const checked = document.querySelectorAll('.row-check:checked');
                    selectedCount.textContent = checked.length;
                    modalSelectedCount.textContent = checked.length;
                    bulkActionCard.classList.toggle('d-none', checked.length === 0);
                    selectedItems.innerHTML = '';
                    checked.forEach(function(item) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'guru[]';
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
