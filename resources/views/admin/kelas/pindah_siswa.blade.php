@extends('admin.layouts.app')

@section('title', 'Pindah Kelas')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-arrow-left-right me-2"></i>
                            Pindah Kelas
                        </h5>
                    </div>

                    <form action="{{ route('admin.kelas.UpdatePindahSiswa', [$kelas, $siswa]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Nama Siswa</label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $siswa->nama_siswa }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $siswa->nim }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kelas Saat Ini</label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ $kelas->nama_kelas }}"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Kelas Tujuan <span class="text-danger">*</span>
                                </label>

                                <select name="id_kelas" class="form-select" required>
                                    <option value="">-- Pilih Kelas --</option>

                                    @foreach ($kelasList as $item)
                                        @if ($item->id_kelas != $kelas->id_kelas)
                                            <option value="{{ $item->id_kelas }}">
                                                {{ $item->nama_kelas }}
                                                ({{ $item->tahun_ajar }})
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.kelas.siswa', $kelas) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Batal
                            </a>

                            <button type="submit"
                                class="btn btn-warning">
                                <i class="bi bi-arrow-left-right"></i>
                                Pindahkan
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
@endsection
