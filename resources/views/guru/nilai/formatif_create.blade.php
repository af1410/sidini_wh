@extends('guru.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Input Penilaian Formatif</h4>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Informasi Penilaian</h6>
                                <p class="mb-2"><strong>Mapel:</strong> {{ $pembukaan->mapel->nama_mapel }}</p>
                                <p class="mb-2"><strong>Kelas:</strong> {{ $pembukaan->kelas->nama_kelas ?? '-' }}</p>
                                <p class="mb-2"><strong>Guru:</strong> {{ $pembukaan->guru->nama_guru ?? '-' }}</p>
                                <p class="mb-2"><strong>Semester:</strong> {{ ucfirst($pembukaan->semester) }}</p>
                                <p class="mb-0"><strong>Periode:</strong>
                                    {{ date('d M Y', strtotime($pembukaan->tanggal_mulai)) }} -
                                    {{ date('d M Y', strtotime($pembukaan->tanggal_selesai)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('guru.nilai.formatif.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_penilaian" value="{{ $pembukaan->id }}">

                    <div class="mb-3">
                        <label class="form-label">ID Siswa</label>
                        <input type="text" name="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror"
                            required>
                        @error('id_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nilai UAS</label>
                        <div class="input-group">
                            <input type="number" name="nilai_uas"
                                class="form-control @error('nilai_uas') is-invalid @enderror" min="0" max="100"
                                step="0.1" required>
                            <span class="input-group-text">/ 100</span>
                        </div>
                        @error('nilai_uas')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            💾 Simpan Nilai
                        </button>
                        <a href="{{ route('guru.nilai.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
