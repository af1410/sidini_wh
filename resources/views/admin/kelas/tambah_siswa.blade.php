@extends('admin.layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-1">Tambah Siswa ke Kelas</h4>
                <p class="text-muted mb-0">
                    Kelas <strong>{{ $kelas->nama_kelas }}</strong>
                    • Tahun Ajaran {{ $kelas->tahun_ajar }}
                </p>
            </div>

            <a href="{{ route('admin.kelas.siswa', $kelas) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form method="GET">

                    <div class="row">

                        <div class="col-md-5">
                            <label class="form-label">Cari Siswa</label>
                            <input type="text" id="search" name="search" class="form-control" autocomplete="off" placeholder="Cari nama atau NIM..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Angkatan</label>
                            <select name="angkatan" class="form-select">
                                <option value="">Semua Angkatan</option>

                                @foreach ($angkatanOptions as $angkatan)
                                    <option value="{{ $angkatan }}"
                                        {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                                        {{ $angkatan }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button class="btn btn-primary">
                                <i class="bi bi-search"></i>
                                Cari
                            </button>

                            <a href="{{ route('admin.kelas.TambahSiswa', $kelas) }}"
                                class="btn btn-secondary">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    Daftar Siswa yang Belum Memiliki Kelas
                </h5>
            </div>

            <form action="{{ route('admin.kelas.SimpanSiswa', $kelas) }}" method="POST">
                @csrf
                <input type="hidden" name="siswa_dipilih" id="siswadipilih">
                <div id="daftarSiswa">
                    @include('admin.kelas.partials.daftar_siswa')
                </div>
            </form>
        </div>

    </div>
    <script>
        let timer;
        let siswadipilih = [];

        function loadData(page = 1) {
            let search = document.getElementById('search').value;
            let angkatan = document.querySelector('[name="angkatan"]').value;

            fetch(`?search=${encodeURIComponent(search)}&angkatan=${encodeURIComponent(angkatan)}&page=${page}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('daftarSiswa').innerHTML = html;
                    bindPagination();
                    bindCheckAll();
                    restoreCheckbox();
                });
        }

        document.getElementById('search').addEventListener('keyup', function() {
            clearTimeout(timer);

            timer = setTimeout(function() {
                loadData();
            }, 300);
        });

        document.querySelector('[name="angkatan"]').addEventListener('change', function() {
            loadData();
        });

        function bindPagination() {
            document.querySelectorAll('#daftarSiswa .pagination a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const url = new URL(this.href);

                    loadData(url.searchParams.get('page'));
                });
            });
        }

        function updateSelectedCount() {
            document.getElementById('selectedCount').textContent = siswadipilih.length;
            document.getElementById('siswadipilih').value = JSON.stringify(siswadipilih);
        }

        function restoreCheckbox() {
            document.querySelectorAll('.siswa-checkbox').forEach(function(item) {
                item.checked = siswadipilih.includes(item.value);
            });

            const checkAll = document.getElementById('checkAll');

            if (checkAll) {
                const checkbox = document.querySelectorAll('.siswa-checkbox');

                checkAll.checked =
                    checkbox.length > 0 && [...checkbox].every(item => item.checked);
            }

            updateSelectedCount();
        }

        function bindCheckAll() {
            const checkAll = document.getElementById('checkAll');

            if (!checkAll) {
                return;
            }

            document.querySelectorAll('.siswa-checkbox').forEach(function(item) {

                item.addEventListener('change', function() {

                    if (this.checked) {

                        if (!siswadipilih.includes(this.value)) {
                            siswadipilih.push(this.value);
                        }

                    } else {

                        siswadipilih = siswadipilih.filter(id => id !== this.value);

                    }

                    restoreCheckbox();

                });

            });

            checkAll.addEventListener('change', function() {

                document.querySelectorAll('.siswa-checkbox').forEach(function(item) {

                    if (this.checked) {

                        if (!siswadipilih.includes(item.value)) {
                            siswadipilih.push(item.value);
                        }

                        item.checked = true;

                    } else {

                        siswadipilih = siswadipilih.filter(id => id !== item.value);

                        item.checked = false;

                    }

                }.bind(this));

                restoreCheckbox();

            });
        }


        bindPagination();
        bindCheckAll();
    </script>
@endsection

@push('js')
@endpush
