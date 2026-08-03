@extends('admin.layouts.app')

@section('title', 'Penilaian')

@section('content')

    @php
        $activeTab = request('tab', 'formatifsumatif');
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Pembukaan Penilaian</h4>
            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                <i class="bi bi-journal-check me-1"></i>Buka Penilaian Ujian
            </a>
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
        <div class="card">
            <div class='card-body'>

                <ul class="nav nav-tabs mb-3" id="penilaianTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link {{ $activeTab == 'formatifsumatif' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#formatifsumatif" type="button">
                            Formatif & Sumatif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link {{ $activeTab == 'psts' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#psts" type="button">
                            PSTS
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link {{ $activeTab == 'psas' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#psas" type="button">
                            PSAS
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane fade {{ $activeTab == 'formatifsumatif' ? 'show active' : '' }}" id="formatifsumatif">

                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-3 mb-3">
                                    {{-- <div class="col-md-3">
                                        <label class="form-label">Semester</label>
                                        <select name="semester" class="form-select" onchange="this.form.submit()">
                                            <option value="ganjil" {{ $semester == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                            <option value="genap" {{ $semester == 'genap' ? 'selected' : '' }}>Genap</option>
                                        </select>
                                    </div> --}}
                                    <div class="row g-3 mb-3">

                                        <div class="col-md-3">
                                            <label>Semester</label>
                                            <select name="semester" class="form-select" onchange="this.form.submit()">
                                                @foreach (['ganjil', 'genap'] as $s)
                                                    <option value="{{ $s }}" {{ $semester == $s ? 'selected' : '' }}>
                                                        {{ ucfirst($s) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Tahun Ajaran</label>
                                            <select name="tahun_ajar" class="form-select" onchange="this.form.submit()">
                                                @foreach ($tahunAjarList as $ta)
                                                    <option value="{{ $ta }}" {{ $tahunAjar == $ta ? 'selected' : '' }}>
                                                        {{ $ta }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </form>
                                <form id="penilaianForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="semester" value="{{ $semester }}">

                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle">
                                            <thead>
                                                <tr>
                                                    <th width="40">
                                                        <input type="checkbox" id="headerCheck">
                                                    </th>
                                                    <th>No</th>
                                                    <th>Mapel</th>
                                                    <th>Guru</th>
                                                    <th>Kelas</th>
                                                    <th>Semester</th>
                                                    <th>Status Formatif</th>
                                                    <th>Status Sumatif</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($formatifSumatif as $items)
                                                    @php
                                                        $pertama = $items->first();
                                                        $formatif = $items->firstWhere('jenis_penilaian', 'formatif');
                                                        $sumatif = $items->firstWhere('jenis_penilaian', 'sumatif');
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="penilaian[]" class="rowCheck" value="{{ $pertama->id_kelas }}|{{ $pertama->id_mapel }}">
                                                        </td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <strong>{{ $pertama->mapel->nama_mapel }}</strong>
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ $pertama->mapel->jenis_mapel }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            {{ $pertama->guru->nama_guru ?? '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $pertama->kelas->nama_kelas }}
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary">
                                                                {{ ucfirst($pertama->semester) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if ($formatif)
                                                                <span class="badge bg-{{ $formatif->status_buka == 'dibuka' ? 'success' : 'danger' }}">
                                                                    {{ ucfirst($formatif->status_buka) }}
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($sumatif)
                                                                <span class="badge bg-{{ $sumatif->status_buka == 'dibuka' ? 'success' : 'danger' }}">
                                                                    {{ ucfirst($sumatif->status_buka) }}
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">
                                                            Belum ada data.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class=" justify-content-between align-items-center mb-3 text-end">

                                        <div>
                                            <button type="submit"
                                                formaction="{{ route('admin.penilaian.bukapenilaian') }}"
                                                class="btn btn-success me-2">
                                                <i class="bi bi-unlock-fill me-1"></i>Buka Penilaian
                                            </button>
                                            <button type="submit"
                                                formaction="{{ route('admin.penilaian.tutuppenilain') }}"
                                                class="btn btn-danger">
                                                <i class="bi bi-lock-fill me-1"></i>Tutup Penilaian
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade {{ $activeTab == 'psts' ? 'show active' : '' }}" id="psts">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-3 mb-3">
                                    <div class="row g-3 mb-3">

                                        <div class="col-md-3">
                                            <label>Semester</label>
                                            <select name="semester" class="form-select" onchange="this.form.submit()">
                                                @foreach (['ganjil', 'genap'] as $s)
                                                    <option value="{{ $s }}" {{ $semester == $s ? 'selected' : '' }}>
                                                        {{ ucfirst($s) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Tahun Ajaran</label>
                                            <select name="tahun_ajar" class="form-select" onchange="this.form.submit()">
                                                @foreach ($tahunAjarList as $ta)
                                                    <option value="{{ $ta }}" {{ $tahunAjar == $ta ? 'selected' : '' }}>
                                                        {{ $ta }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mapel</th>
                                                <th>Guru</th>
                                                <th>Kelas</th>
                                                <th>Periode</th>
                                                <th>Approval</th>
                                                <th width="200">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($psts as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $item->mapel->nama_mapel }}
                                                        <br>
                                                        <small class="text-muted">{{ $item->mapel->jenis_mapel }}</small>
                                                    </td>
                                                    <td>{{ $item->guru->nama_guru ?? '-' }}</td>
                                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                                        <br>
                                                        s/d
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status_approval == 'draft')
                                                            <span class="badge bg-secondary">Draft</span>
                                                        @elseif($item->status_approval == 'menunggu_approval')
                                                            <span class="badge bg-warning text-dark">
                                                                Menunggu Approval
                                                            </span>
                                                        @elseif($item->status_approval == 'disetujui')
                                                            <span class="badge bg-success">
                                                                Disetujui
                                                            </span>
                                                        @elseif($item->status_approval == 'publish')
                                                            <span class="badge bg-primary">
                                                                Published
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                Ditolak
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $hasNilai = ($item->nilai_formatif_count ?? 0) > 0 || ($item->nilai_sumatif_count ?? 0) > 0 || ($item->nilai_ujian_count ?? 0) > 0;

                                                            $isExpired = now()->gt($item->tanggal_selesai);
                                                        @endphp

                                                        <div class="d-flex gap-2 flex-wrap">

                                                            {{-- Lihat Nilai --}}
                                                            @if ($hasNilai)
                                                                <a href="{{ route('admin.penilaian.show', $item->id) }}" class="btn btn-info btn-sm">
                                                                    <i class="bi bi-eye me-1"></i>Lihat Nilai
                                                                </a>
                                                            @endif

                                                            {{-- Draft --}}
                                                            @if ($item->status_approval == 'draft')
                                                                @if (!$isExpired)
                                                                    <a href="{{ route('admin.penilaian.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                                        <i class="bi bi-pencil me-1"></i>Edit
                                                                    </a>

                                                                    <form action="{{ route('admin.penilaian.destroy', $item->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Hapus penilaian?')">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <button class="btn btn-danger btn-sm">
                                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                                        </button>
                                                                    </form>
                                                                @endif

                                                                {{-- Menunggu Approval --}}
                                                            @elseif ($item->status_approval == 'menunggu_approval')
                                                                <form action="{{ route('admin.penilaian.approve', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-success btn-sm">
                                                                        <i class="bi bi-check-lg me-1"></i>Approve
                                                                    </button>
                                                                </form>

                                                                {{-- Disetujui --}}
                                                            @elseif ($item->status_approval == 'disetujui')
                                                                <button type="button" class="btn btn-success btn-sm btn-publish" data-bs-toggle="modal" data-bs-target="#publishModal" data-action="{{ route('admin.penilaian.publish', $item->id) }}">
                                                                    <i class="bi bi-send-check me-1"></i>Publish
                                                                </button>

                                                                {{-- Published --}}
                                                            @elseif ($item->status_approval == 'publish')
                                                                <a href="{{ route('admin.penilaian.show', $item->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="bi bi-eye me-1"></i>Lihat Nilai
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Belum ada data PSTS.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade {{ $activeTab == 'psas' ? 'show active' : '' }}" id="psas">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-3 mb-3">
                                    <div class="row g-3 mb-3">

                                        <div class="col-md-3">
                                            <label>Semester</label>
                                            <select name="semester" class="form-select" onchange="this.form.submit()">
                                                @foreach (['ganjil', 'genap'] as $s)
                                                    <option value="{{ $s }}" {{ $semester == $s ? 'selected' : '' }}>
                                                        {{ ucfirst($s) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Tahun Ajaran</label>
                                            <select name="tahun_ajar" class="form-select" onchange="this.form.submit()">
                                                @foreach ($tahunAjarList as $ta)
                                                    <option value="{{ $ta }}" {{ $tahunAjar == $ta ? 'selected' : '' }}>
                                                        {{ $ta }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </form>
                                <div class="table-responsive">
                                    @csrf
                                    <input type="hidden" name="semester" value="{{ $semester }}">
                                    <table class="table table-bordered align-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mapel</th>
                                                <th>Guru</th>
                                                <th>Kelas</th>
                                                <th>Periode</th>
                                                <th>Approval</th>
                                                <th width="200">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($psas as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $item->mapel->nama_mapel }}
                                                        <br>
                                                        <small class="text-muted">{{ $item->mapel->jenis_mapel }}</small>
                                                    </td>
                                                    <td>{{ $item->guru->nama_guru ?? '-' }}</td>
                                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                                        <br>
                                                        s/d
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status_approval == 'draft')
                                                            <span class="badge bg-secondary">Draft</span>
                                                        @elseif($item->status_approval == 'menunggu_approval')
                                                            <span class="badge bg-warning text-dark">
                                                                Menunggu Approval
                                                            </span>
                                                        @elseif($item->status_approval == 'disetujui')
                                                            <span class="badge bg-success">
                                                                Disetujui
                                                            </span>
                                                        @elseif($item->status_approval == 'publish')
                                                            <span class="badge bg-primary">
                                                                Published
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                Ditolak
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $hasNilai = ($item->nilai_formatif_count ?? 0) > 0 || ($item->nilai_sumatif_count ?? 0) > 0 || ($item->nilai_ujian_count ?? 0) > 0;
                                                        @endphp
                                                        <div class="d-flex gap-2 flex-wrap">
                                                            @if ($hasNilai)
                                                                <a href="{{ route('admin.penilaian.show', $item->id) }}" class="btn btn-info btn-sm">
                                                                    <i class="bi bi-eye me-1"></i>Lihat Nilai
                                                                </a>
                                                            @endif
                                                            @if ($item->status_approval == 'draft' && $item->status_buka != 'menunggu')
                                                                <a href="{{ route('admin.penilaian.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                                    <i class="bi bi-pencil me-1"></i>Edit
                                                                </a>
                                                                <form action="{{ route('admin.penilaian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus penilaian?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm">
                                                                        <i class="bi bi-trash me-1"></i>Hapus
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($item->status_buka == 'menunggu')
                                                                <form action="{{ route('admin.penilaian.bukakembali', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-warning btn-sm">
                                                                        <i class="bi bi-unlock me-1"></i>Buka Penilaian
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($item->status_approval == 'menunggu_approval')
                                                                <form action="{{ route('admin.penilaian.approve', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-success btn-sm">
                                                                        <i class="bi bi-check-lg me-1"></i>Approve
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($item->status_approval == 'disetujui')
                                                                <form action="{{ route('admin.penilaian.publish', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="button" class="btn btn-success btn-sm btn-publish" data-bs-toggle="modal" data-bs-target="#publishModal" data-action="{{ route('admin.penilaian.publish', $item->id) }}">
                                                                        <i class="bi bi-send-check me-1"></i>Publish
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            @if ($item->status_approval == 'publish')
                                                                <a href="{{ route('admin.penilaian.show', $item->id) }}" class="btn btn-success btn-sm">
                                                                    <i class="bi bi-eye me-1"></i>Lihat Nilai
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Belum ada data PSAS.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="publishModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Konfirmasi Publish</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Apakah Anda yakin ingin mempublikasikan nilai ini?
                    <div class="alert alert-success mt-3 mb-0">
                        Setelah dipublikasikan, siswa dapat melihat nilai.
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form id="publishForm" method="POST">
                        @csrf
                        <button class="btn btn-success">
                            <i class="bi bi-send-check me-1"></i>Ya, Publish
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-publish').forEach(function(button) {

                button.addEventListener('click', function() {

                    document.getElementById('publishForm')
                        .action = this.dataset.action;

                });

            });
            const headerCheck = document.getElementById('headerCheck');
            const rowChecks = document.querySelectorAll('.rowCheck');

            headerCheck.addEventListener('change', function() {

                rowChecks.forEach(function(item) {
                    item.checked = headerCheck.checked;
                });

            });

            rowChecks.forEach(function(item) {

                item.addEventListener('change', function() {

                    headerCheck.checked =
                        document.querySelectorAll('.rowCheck:checked').length === rowChecks.length;

                });

            });

        });
    </script>


@endsection
