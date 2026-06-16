@extends('siswa.layouts.app')

@section('title', 'Nilai Akhir')

@section('content')
    <div class="container-fluid">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Nilai Akhir
                </h5>

                <small class="text-muted">
                    {{ $siswa->nama_siswa }}
                </small>
            </div>

            <div class="card-body">

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

                                    <table class="table table-bordered table-striped align-middle">

                                        <thead class="table-light">

                                            <tr>
                                                <th>No</th>
                                                <th>Mata Pelajaran</th>

                                                @foreach ($semuaBab as $bab)
                                                    <th>Bab {{ $bab }}</th>
                                                @endforeach

                                                <th>Rata-rata Bab</th>
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

                                                    @foreach ($semuaBab as $bab)
                                                        <td class="text-center">
                                                            {{ $item['detail_bab'][$bab] ?? '' }}
                                                        </td>
                                                    @endforeach

                                                    <td>
                                                        {{ number_format($item['rata_bab'], 2) }}
                                                    </td>

                                                    <td>
                                                        {{ number_format($item['psts'], 2) }}
                                                    </td>

                                                    <td>
                                                        {{ number_format($item['psas'], 2) }}
                                                    </td>

                                                    <td class="fw-bold">
                                                        {{ number_format($item['nilai_akhir'], 2) }}
                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="{{ count($semuaBab) + 6 }}" class="text-center">
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
