@extends('kepsek.layouts.app')

@section('title', 'Rapor Siswa')

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

        .jumlah-siswa {
            background: rgba(255, 255, 255, .2);
            padding: 8px 14px;
            border-radius: 12px;
            text-align: center;
        }

        .jumlah-siswa h5 {
            margin: 0;
            font-weight: 700;
        }

        .info-item {
            margin-bottom: 14px;
        }

        .info-item small {
            color: #6c757d;
            display: block;
        }

        .info-item strong {
            color: #333;
            font-size: 15px;
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

        .badge-success {
            font-size: 13px;
        }

        .badge-warning {
            font-size: 13px;
        }
    </style>
    <div class="container-fluid">
        <div class="mb-4">
            <h3 class="page-title">
                <i class="bi bi-house text-fill me-2" style="color: var(--primary-color)"></i>
                Data Kelas
            </h3>
            <p class="text-muted mb-0">
                Daftar kelas yang siap dilakukan Approve rapor siswa.
            </p>
        </div>
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
                                    Tahun Ajar {{ $item->tahunAjar->tahun_ajar ?? '-' }}
                                </small>
                            </div>
                            <div class="jumlah-siswa">
                                <h5>{{ $item->siswas->count() }}</h5>
                                <small>Siswa</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <small>Wali Kelas</small>
                            <strong>{{ $item->waliKelas->nama_guru ?? '-' }}</strong>
                        </div>
                        <div class="info-item">
                            <small>Approve</small>
                            <strong>
                                <span class="badge bg-success">
                                    {{ $item->jumlah_acc ?? 0 }}
                                </span>
                            </strong>
                        </div>
                        <div class="info-item">
                            <small>Menunggu di Approve</small>
                            <strong>
                                <span class="badge bg-warning">
                                    {{ $item->jumlah_menunggu ?? 0 }}
                                </span>
                            </strong>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('kepsek.kelas.show', $item->id_kelas) }}" class="btn btn-detail w-100">
                            <i class="bi bi-arrow-right-circle me-2"></i>
                            Lihat Kelas
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
                        Belum ada data kelas.
                    </p>
                </div>
            </div>
        @endforelse
    </div>

@endsection
