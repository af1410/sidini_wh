@extends('guru.layouts.app')

@section('title', 'Mapel Saya')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h4 class="fw-bold">Mapel Saya</h4>
            <p class="text-muted mb-0">Klik kelas untuk melihat detail mapel dan siswa.</p>
        </div>

        <div class="row">
            @forelse($kelas as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('guru.mapel.show', $item->id_kelas) }}" class="text-decoration-none text-dark">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <h5 class="fw-bold mb-2">{{ $item->nama_kelas }}</h5>
                                <p class="mb-1"><strong>Tahun Ajar:</strong> {{ $item->tahun_ajar }}</p>
                                <p class="mb-1"><strong>Kelas:</strong> {{ $item->kelas }}</p>
                                <p class="mb-3"><strong>Rombel:</strong> {{ $item->rombel }}</p>

                                <hr>

                                <strong class="d-block mb-2">Mapel:</strong>
                                @if ($item->mapels->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($item->mapels as $mapel)
                                            <span class="badge bg-primary">
                                                {{ $mapel->nama_mapel }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        Belum ada mapel.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning mb-0">
                        Tidak ada kelas yang terhubung dengan mapel Anda.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
