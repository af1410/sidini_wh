@extends('guru.layouts.app')

@section('title', 'Perlengkapan Rapor')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h5>
                    Perlengkapan Rapor - {{ $siswa->nama_siswa }}
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('guru.kelas_saya.lengkapi_rapor.update', $siswa->id_siswa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Ekstrakurikuler</h5>
                    <table class="table table-bordered" id="table-ekskul">
                        <thead>
                            <tr>
                                <th>Ekskul</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($rapor->ekskul as $i => $item)
                                <tr>
                                    <td>
                                        <input type="text" name="ekskul[{{ $i }}][nama]" class="form-control" value="{{ $item->nama_ekskul }}">
                                    </td>
                                    <td>
                                        <select name="ekskul[{{ $i }}][nilai]" class="form-select">
                                            @if (empty($item->nilai))
                                                <option value="" selected>-- Pilih Nilai --</option>
                                            @endif
                                            @foreach (['A', 'B', 'C', 'D', 'E'] as $nilai)
                                                <option value="{{ $nilai }}"
                                                    {{ $item->nilai == $nilai ? 'selected' : '' }}>
                                                    {{ $nilai }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="ekskul[{{ $i }}][keterangan]" class="form-control" value="{{ $item->keterangan }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove">
                                            ×
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <input type="text" name="ekskul[0][nama]" class="form-control">
                                    </td>
                                    <td>
                                        <select name="ekskul[0][nilai]" class="form-control">
                                            @foreach (['A', 'B', 'C', 'D', 'E'] as $nilai)
                                                <option value="{{ $nilai }}">
                                                    {{ $nilai }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="ekskul[0][keterangan]" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove">
                                            ×
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="button" id="add-ekskul" class="btn btn-primary btn-sm">
                        + Tambah Ekskul
                    </button>
                    <hr>
                    <h5 class="mt-4">Prestasi</h5>
                    <table class="table table-bordered" id="table-prestasi">
                        <thead>
                            <tr>
                                <th>Prestasi</th>
                                <th>Keterangan</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rapor->prestasi as $i => $item)
                                <tr>
                                    <td>
                                        <input type="text" name="prestasi[{{ $i }}][nama]" class="form-control" value="{{ $item->prestasi }}">
                                    </td>
                                    <td>
                                        <textarea name="prestasi[{{ $i }}][keterangan]" class="form-control">{{ $item->keterangan }}</textarea>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove">
                                            ×
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <input type="text" name="prestasi[0][nama]" class="form-control">
                                    </td>
                                    <td>
                                        <textarea name="prestasi[0][keterangan]" class="form-control"></textarea>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-remove">
                                            ×
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="button" id="add-prestasi" class="btn btn-primary btn-sm">
                        + Tambah Prestasi
                    </button>
                    <hr>
                    <h5>Ketidakhadiran</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Sakit</label>
                            <input type="number" name="sakit" class="form-control" value="{{ $rapor->sakit ?? 0 }}">
                        </div>
                        <div class="col-md-4">
                            <label>Izin</label>
                            <input type="number" name="izin" class="form-control" value="{{ $rapor->izin ?? 0 }}">
                        </div>
                        <div class="col-md-4">
                            <label>Alpa</label>
                            <input type="number" name="alpa" class="form-control" value="{{ $rapor->alpa ?? 0 }}">
                        </div>
                    </div>
                    <hr>
                    <h5>Catatan Wali Kelas</h5>
                    <textarea name="catatan_wali_kelas" rows="5" class="form-control">{{ $rapor->catatan_wali_kelas }}</textarea>
                    <div class="mt-3">
                        <button class="btn btn-success">
                            <i class="bi bi-floppy-fill me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let ekskulIndex = document.querySelectorAll('#table-ekskul tbody tr').length;
        let prestasiIndex = document.querySelectorAll('#table-prestasi tbody tr').length;

        document.getElementById('add-ekskul').addEventListener('click', function() {

            document.querySelector('#table-ekskul tbody').insertAdjacentHTML(
                'beforeend',
                `
        <tr>
            <td>
                <input type="text" name="ekskul[${ekskulIndex}][nama]" class="form-control">
            </td>
            <td>
                 <select name="ekskul[${ekskulIndex}][nilai]" class="form-control">
                                            @foreach (['A', 'B', 'C', 'D', 'E'] as $nilai)
                                                <option value="{{ $nilai }}">
                                                    {{ $nilai }}
                                                </option>
                                            @endforeach
                                        </select>
            </td>
            <td>
                <input type="text" name="ekskul[${ekskulIndex}][keterangan]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-remove">×</button>
            </td>
        </tr>
        `
            );

            ekskulIndex++;
        });

        document.getElementById('add-prestasi').addEventListener('click', function() {

            document.querySelector('#table-prestasi tbody').insertAdjacentHTML(
                'beforeend',
                `
        <tr>
            <td>
                <input type="text" name="prestasi[${prestasiIndex}][nama]" class="form-control">
            </td>
            <td>
                <textarea name="prestasi[${prestasiIndex}][keterangan]" class="form-control"></textarea>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-remove">×</button>
            </td>
        </tr>
        `
            );

            prestasiIndex++;
        });

        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('btn-remove')) {
                e.target.closest('tr').remove();
            }

        });
    </script>
@endpush
