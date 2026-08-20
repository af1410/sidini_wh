@extends('siswa.layouts.app')

@section('title', 'Detail Nilai ')

@section('content')
    <div class="container-fluid">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Detail Nilai
                </h5>

                <small class="text-muted">
                    {{ $siswa->nama_siswa }}
                </small>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Semester</label>
                                <select name="semester" class="form-select" onchange="this.form.submit()">
                                    <option value="ganjil" {{ $semester == 'ganjil' ? 'selected' : '' }}>
                                        Ganjil
                                    </option>
                                    <option value="genap" {{ $semester == 'genap' ? 'selected' : '' }}>
                                        Genap
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                @if (count($nilaiPerKelas) == 0)
                    <div class="alert alert-info">
                        Belum ada nilai akhir yang tersedia.
                    </div>
                @else
                    {{-- Tab Kelas --}}
                    <ul class="nav nav-tabs mb-3" role="tablist">

                        @foreach ($nilaiPerKelas as $namaKelas => $items)
                            <li class="nav-item">
                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#kelas{{ $loop->index }}" type="button">

                                    {{ $namaKelas }}

                                </button>
                            </li>
                        @endforeach

                    </ul>

                    {{-- Isi Tab --}}
                    <div class="tab-content">

                        @foreach ($nilaiPerKelas as $namaKelas => $items)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="kelas{{ $loop->index }}">

                                <div class="table-responsive">

                                    <table class="table table-bordered table-striped align-middle tabel-nilai" data-semester="{{ strtolower($items[0]['semester'] ?? 'semua') }}">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Sumatif</th>
                                                <th>Formatif</th>
                                                <th>PSTS</th>
                                                <th>PSAS</th>
                                                <th>Nilai Akhir</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            @forelse($items as $item)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $item['mapel']->nama_mapel }}
                                                    </td>
                                                    <td>
                                                        @if ($item['rata_bab'] !== null && $item['rata_bab'] != 0)
                                                            {{ number_format($item['rata_bab'], 2) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['rata_bab_formatif'] !== null && $item['rata_bab_formatif'] != 0)
                                                            {{ number_format($item['rata_bab_formatif'], 2) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['nilai_psts'] !== null && $item['nilai_psts'] != 0)
                                                            {{ number_format($item['nilai_psts'], 2) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item['nilai_psas'] !== null && $item['nilai_psas'] != 0)
                                                            {{ number_format($item['nilai_psas'], 2) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="fw-bold">
                                                        @if ($item['nilai_akhir'] !== null && $item['nilai_akhir'] != 0)
                                                            {{ round($item['nilai_akhir']) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        Tidak ada data nilai.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const filter = document.getElementById('filterSemester');

            function filterSemester() {

                const semester = filter.value;

                document.querySelectorAll('.tabel-nilai').forEach(function(table) {

                    if (semester === 'semua') {
                        table.closest('.table-responsive').style.display = '';
                        return;
                    }

                    if (table.dataset.semester === semester) {
                        table.closest('.table-responsive').style.display = '';
                    } else {
                        table.closest('.table-responsive').style.display = 'none';
                    }

                });

            }

            filter.addEventListener('change', filterSemester);

            filterSemester();

        });
    </script>
@endpush
