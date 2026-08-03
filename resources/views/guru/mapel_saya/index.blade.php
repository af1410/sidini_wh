@extends('guru.layouts.app')

@section('title', 'Mapel Saya')

@section('content')

    <style>
        :root {
            --primary-color: #29ab87;
            --secondary-color: #1e7f5f;
            --light-color: #eefaf6;
        }

        .page-title {
            font-weight: 700;
            color: #333;
        }

        .kelas-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: .3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .kelas-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(41, 171, 135, .20);
        }

        .kelas-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 18px 20px;
        }

        .kelas-header h5 {
            margin: 0;
            font-weight: 700;
        }

        .kelas-header small {
            opacity: .9;
        }

        .jumlah-mapel {
            background: rgba(255, 255, 255, .2);
            padding: 8px 14px;
            border-radius: 12px;
            text-align: center;
        }

        .jumlah-mapel h5 {
            margin: 0;
            font-weight: 700;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .info-item small {
            color: #6c757d;
            display: block;
        }

        .info-item strong {
            color: #333;
            font-size: 15px;
        }

        .mapel-title {
            font-weight: 600;
            color: #444;
            margin-bottom: 10px;
        }

        .mapel-item {
            background: var(--light-color);
            border-left: 4px solid var(--primary-color);
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 8px;
            color: var(--secondary-color);
            font-weight: 500;
        }

        .btn-detail {
            background: var(--primary-color);
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            transition: .3s;
            font-weight: 600;
        }

        .btn-detail:hover {
            background: var(--secondary-color);
            color: white;
        }

        .empty-state {
            border-radius: 16px;
            padding: 40px;
        }
    </style>

    <div class="container-fluid">

        <div class="mb-4">

            <h3 class="page-title">
                <i class="bi bi-journal-bookmark-fill me-2" style="color: var(--primary-color)"></i>

                Mapel Saya
            </h3>

            <p class="text-muted mb-0">
                Daftar kelas yang Anda ampu beserta mata pelajaran.
            </p>

        </div>

        <div class="row">

            @forelse($kelas as $item)

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card kelas-card h-100">

                        <div class="kelas-header">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <h5>{{ $item->nama_kelas }}</h5>

                                    <small>
                                        Tahun Ajar {{ $item->tahun_ajar }}
                                    </small>

                                </div>

                                <div class="jumlah-mapel">

                                    <h5>{{ $item->mapels->count() }}</h5>

                                    <small>Mapel</small>

                                </div>

                            </div>

                        </div>

                        <div class="card-body">



                            <hr>

                            <div class="mapel-title">
                                Mata Pelajaran
                            </div>

                            @forelse($item->mapels as $mapel)
                                <div class="mapel-item">

                                    <i class="bi bi-book me-2"></i>

                                    {{ $mapel->nama_mapel }}

                                </div>

                            @empty

                                <div class="alert alert-warning py-2">

                                    Belum ada mata pelajaran.

                                </div>
                            @endforelse

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a href="{{ route('guru.mapel.show', $item->id_kelas) }}" class="btn btn-detail w-100">

                                <i class="bi bi-arrow-right-circle me-2"></i>

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning empty-state text-center">

                        <i class="bi bi-exclamation-circle fs-1 d-block mb-3"></i>

                        <h5>Tidak Ada Data</h5>

                        <p class="mb-0">

                            Tidak ada kelas yang terhubung dengan mata pelajaran Anda.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

@endsection
