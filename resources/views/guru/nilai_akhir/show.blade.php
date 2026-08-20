@extends('guru.layouts.app')

@section('title', 'Nilai Akhir')


@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Nilai Akhir</h4>

            <div class="d-flex gap-2">
                <a id="btnExport"
                    href="{{ route('guru.nilai_akhir.export', [
                        'id_kelas' => $kelas->id_kelas,
                        'id_mapel' => $mapel->id_mapel,
                    ]) }}"
                    class="btn btn-success">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Export Excel
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <form
                    action="{{ route('guru.nilai_akhir.store', [
                        'id_kelas' => $kelas->id_kelas,
                        'id_mapel' => $mapel->id_mapel,
                    ]) }}"
                    method="POST">

                    @csrf

                    <input type="hidden" name="bobot_bab" id="input_bobot_bab">
                    <input type="hidden" name="bobot_psts" id="input_bobot_psts">
                    <input type="hidden" name="bobot_psas" id="input_bobot_psas">

                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Nilai Sumatif</th>
                                    <th>Nilai Formatif</th>
                                    <th>PSTS</th>
                                    <th>PSAS</th>
                                    <th>Nilai Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($nilaiSiswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['siswa']->nim }}</td>
                                        <td>{{ $item['siswa']->nama_siswa }}</td>
                                        <td class="nilai-sumatif">
                                            {{ $item['rata_bab'] !== null ? rtrim(rtrim(number_format((float) $item['rata_bab'], 2, '.', ''), '0'), '.') : '0' }}
                                        </td>
                                        <td class="nilai-formatif">
                                            {{ $item['rata_bab_formatif'] !== null ? rtrim(rtrim(number_format((float) $item['rata_bab_formatif'], 2, '.', ''), '0'), '.') : '0' }}
                                        </td>
                                        <td class="psts">
                                            {{ $item['psts'] !== null ? rtrim(rtrim(number_format((float) $item['psts'], 2, '.', ''), '0'), '.') : '0' }}
                                        </td>
                                        <td class="psas">
                                            {{ $item['psas'] !== null ? rtrim(rtrim(number_format((float) $item['psas'], 2, '.', ''), '0'), '.') : '0' }}
                                        </td>
                                        <td class="nilai-akhir fw-bold">
                                            {{ $item['nilai_akhir'] !== null ? round($item['nilai_akhir']) : '0' }}
                                        </td>
                                        <td style="height: 70px">
                                            <textarea class="form-control" name="keterangan[{{ $item['siswa']->id_siswa }}]" rows="1" placeholder="{{ $item['default_keterangan'] }}" style="height: 90px">{{ $item['keterangan'] ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" text-end">
                        <button type="submit" class="btn btn-primary text-end">
                            <i class="bi bi-floppy-fill me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    </div>



    <script>
        function generateKeterangan(nilai) {
            if (nilai >= 90) {
                return 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.';
            } else if (nilai >= 80) {
                return 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.';
            } else if (nilai >= 70) {
                return 'Menunjukkan penguasaan materi yang cukup baik namun masih memerlukan peningkatan pada beberapa aspek.';
            } else if (nilai >= 60) {
                return 'Menunjukkan penguasaan materi yang kurang dan memerlukan bimbingan lebih lanjut.';
            } else {
                return 'Menunjukkan penguasaan materi yang sangat kurang dan memerlukan pendampingan intensif.';
            }
        }

        function hitungNilaiAkhir() {
            const bobotBab = parseFloat(document.getElementById('bobotBab').value) || 0;
            const bobotPsts = parseFloat(document.getElementById('bobotPsts').value) || 0;
            const bobotPsas = parseFloat(document.getElementById('bobotPsas').value) || 0;
            const total = bobotBab + bobotPsts + bobotPsas;
            if (total !== 100) {
                alert('Total bobot harus 100%');
                return false;
            }
            document.querySelectorAll('tbody tr').forEach(row => {
                const sumatif = parseFloat(row.querySelector('.nilai-sumatif').textContent) || 0;
                const psts = parseFloat(row.querySelector('.psts').textContent) || 0;
                const psas = parseFloat(row.querySelector('.psas').textContent) || 0;
                const akhir = (sumatif * bobotBab / 100) + (psts * bobotPsts / 100) + (psas * bobotPsas / 100);
                const nilaiCell = row.querySelector('.nilai-akhir');
                nilaiCell.textContent = akhir.toFixed(2);
                const textarea = row.querySelector('textarea[name^="keterangan"]');
                if (textarea) {
                    textarea.placeholder = generateKeterangan(akhir);
                }
            });
            return true;
        }

        function updateExportLink() {

            const bab = document.getElementById('bobotBab').value;
            const psts = document.getElementById('bobotPsts').value;
            const psas = document.getElementById('bobotPsas').value;

            const exportBtn = document.getElementById('btnExport');

            exportBtn.href =
                "{{ route('guru.nilai_akhir.export', [
                    'id_kelas' => $kelas->id_kelas,
                    'id_mapel' => $mapel->id_mapel,
                ]) }}" +
                '?bobot_bab=' + bab +
                '&bobot_psts=' + psts +
                '&bobot_psas=' + psas;
        }
        document.getElementById('simpanBobot')
            .addEventListener('click', function() {
                document.getElementById('input_bobot_bab').value =
                    document.getElementById('bobotBab').value;

                document.getElementById('input_bobot_psts').value =
                    document.getElementById('bobotPsts').value;

                document.getElementById('input_bobot_psas').value =
                    document.getElementById('bobotPsas').value;
                hitungNilaiAkhir();
                updateExportLink();

                const modalElement =
                    document.getElementById('modalBobot');

                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );

                modal.hide();
            });

        document.addEventListener('DOMContentLoaded', function() {
            updateExportLink();
        });
    </script>
@endsection
