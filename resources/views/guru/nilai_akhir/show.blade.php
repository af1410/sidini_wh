@extends('guru.layouts.app')

@section('title', 'Nilai Akhir')


@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Nilai Akhir</h4>

            <div class="d-flex gap-2">
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBobot">
                    <i class="bi bi-gear me-1"></i>
                    Pengaturan Bobot
                </button>

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
                                    @foreach ($daftarBab as $bab)
                                        <th>Bab {{ $bab }}</th>
                                    @endforeach
                                    <th>Rata-rata BAB</th>
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
                                        @foreach ($daftarBab as $bab)
                                            <td>
                                                {{ $item['detail_bab'][$bab] ?? '-' }}
                                            </td>
                                        @endforeach
                                        <td class="rata-bab">
                                            {{ $item['rata_bab'] ? rtrim(rtrim((string) $item['rata_bab'], '0'), '.') : '0' }}
                                        </td>

                                        <td class="psts">
                                            {{ $item['psts'] ? rtrim(rtrim((string) $item['psts'], '0'), '.') : '0' }}
                                        </td>

                                        <td class="psas">
                                            {{ $item['psas'] ? rtrim(rtrim((string) $item['psas'], '0'), '.') : '0' }}
                                        </td>

                                        <td class="nilai-akhir fw-bold">
                                            {{ $item['nilai_akhir'] ? rtrim(rtrim((string) $item['nilai_akhir'], '0'), '.') : '0' }}
                                        </td>

                                        <td style="height: 70px">
                                            <textarea class="form-control" name="keterangan[{{ $item['siswa']->id_siswa }}]" rows="1"
                                                placeholder="{{ $item['default_keterangan'] }}" style="height: 90px">{{ $item['keterangan'] ?? '' }}</textarea>
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

    <div class="modal fade" id="modalBobot" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Pengaturan Bobot
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Bobot Rata-rata BAB (%)</label>
                        <input type="number" class="form-control" id="bobotBab"
                            value="{{ number_format($bobotBab, 0, ',', '.') }}">
                    </div>

                    <div class="mb-3">
                        <label>Bobot PSTS (%)</label>
                        <input type="number" class="form-control" id="bobotPsts"
                            value="{{ number_format($bobotPsts, 0, ',', '.') }}">
                    </div>

                    <div class="mb-3">
                        <label>Bobot PSAS (%)</label>
                        <input type="number" class="form-control" id="bobotPsas"
                            value="{{ number_format($bobotPsas, 0, ',', '.') }}">
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="simpanBobot">

                        <i class="bi bi-floppy-fill me-1"></i> Simpan

                    </button>

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

            const bobotBab =
                parseFloat(document.getElementById('bobotBab').value) || 0;

            const bobotPsts =
                parseFloat(document.getElementById('bobotPsts').value) || 0;

            const bobotPsas =
                parseFloat(document.getElementById('bobotPsas').value) || 0;

            const total =
                bobotBab +
                bobotPsts +
                bobotPsas;

            if (total !== 100) {
                alert('Total bobot harus 100%');
                return false;
            }

            document.querySelectorAll('tbody tr').forEach(row => {

                const bab =
                    parseFloat(row.querySelector('.rata-bab').textContent) || 0;

                const psts =
                    parseFloat(row.querySelector('.psts').textContent) || 0;

                const psas =
                    parseFloat(row.querySelector('.psas').textContent) || 0;

                const akhir =
                    (bab * bobotBab / 100) +
                    (psts * bobotPsts / 100) +
                    (psas * bobotPsas / 100);

                const nilaiCell = row.querySelector('.nilai-akhir');
                nilaiCell.textContent = akhir.toFixed(2);

                // Update placeholder keterangan berdasarkan nilai baru
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
