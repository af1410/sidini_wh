<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NilaiAkhirAllSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = Carbon::now();
            $idKelas = 'KX2526002';
            $idTahunAjar = 3;
            $semester = 'ganjil';
            $mapelPenilaian = [
                'MW2627002' => ['formatif' => 42, 'sumatif' => 43],
                'MM2627012' => ['formatif' => 46, 'sumatif' => 47],
                'MM2627013' => ['formatif' => 50, 'sumatif' => 51],
                'MU2627005' => ['formatif' => 54, 'sumatif' => 55],
                'MU2627004' => ['formatif' => 58, 'sumatif' => 59],
                'MU2627008' => ['formatif' => 62, 'sumatif' => 63],
                'MU2627002' => ['formatif' => 66, 'sumatif' => 67],
                'MU2627003' => ['formatif' => 70, 'sumatif' => 71],
                'MU2627006' => ['formatif' => 74, 'sumatif' => 75],
                'MU2627001' => ['formatif' => 78, 'sumatif' => 79],
                'MU2627010' => ['formatif' => 82, 'sumatif' => 83],
                'MU2627009' => ['formatif' => 86, 'sumatif' => 87],
                'MU2627007' => ['formatif' => 90, 'sumatif' => 91],
                'MU2627011' => ['formatif' => 94, 'sumatif' => 95],
            ];
            $siswaKelas = DB::table('siswa_kelas')
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('status', 'aktif')
                ->get();
            foreach ($mapelPenilaian as $idMapel => $penilaian) {
                $idPenilaianFormatif = $penilaian['formatif'];
                $idPenilaianSumatif = $penilaian['sumatif'];
                $penilaianSumatif = DB::table('penilaian')
                    ->where('id', $idPenilaianSumatif)
                    ->first();
                if (!$penilaianSumatif) {
                    $this->command->warn("Penilaian sumatif {$idPenilaianSumatif} tidak ditemukan.");
                    continue;
                }
                foreach ($siswaKelas as $siswa) {
                    $idSiswa = $siswa->id_siswa;
                    $formatifData = DB::table('nilai_formatif')
                        ->where('id_penilaian', $idPenilaianFormatif)
                        ->where('id_siswa', $idSiswa)
                        ->where('bab_ke', 1)
                        ->get();
                    $rataBabFormatif = $formatifData->avg('nilai_formatif');
                    $rataBabFormatif = $rataBabFormatif !== null
                        ? round($rataBabFormatif, 2)
                        : 0;
                    $sumatifData = DB::table('nilai_sumatif')
                        ->where('id_penilaian', $idPenilaianSumatif)
                        ->where('id_siswa', $idSiswa)
                        ->first();
                    $rataBab = $sumatifData?->nilai_bab ?? 0;
                    $rataBab = round($rataBab, 2);
                    $nilaiPsts = rand(80, 95);
                    $nilaiPsas = rand(80, 95);
                    $rerataFSPsts = (
                        $rataBabFormatif +
                        $rataBab +
                        $nilaiPsts
                    ) / 3;
                    $nilaiAkhir = round(
                        ($rerataFSPsts * 75 / 100) +
                            ($nilaiPsas * 25 / 100)
                    );
                    $keterangan = $nilaiAkhir >= 90
                        ? 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.'
                        : ($nilaiAkhir >= 80
                            ? 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.'
                            : ($nilaiAkhir >= 70
                                ? 'Menunjukkan penguasaan materi yang cukup baik namun masih memerlukan peningkatan pada beberapa aspek.'
                                : ($nilaiAkhir >= 60
                                    ? 'Menunjukkan penguasaan materi yang kurang dan memerlukan bimbingan lebih lanjut.'
                                    : 'Menunjukkan penguasaan materi yang sangat kurang dan memerlukan pendampingan intensif.')));
                    DB::table('nilai_akhir')->updateOrInsert(
                        [
                            'id_siswa' => $idSiswa,
                            'id_mapel' => $idMapel,
                            'id_kelas' => $idKelas,
                            'semester' => $semester,
                        ],
                        [
                            'bobot_bab' => 40,
                            'bobot_psts' => 30,
                            'bobot_psas' => 30,
                            'rata_bab' => $rataBab,
                            'rata_bab_formatif' => $rataBabFormatif,
                            'nilai_psts' => $nilaiPsts,
                            'nilai_psas' => $nilaiPsas,
                            'nilai_akhir' => $nilaiAkhir,
                            'keterangan' => $keterangan,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }
            }
            $this->command->info('Data nilai akhir berhasil dibuat untuk 14 mata pelajaran.');
            $this->command->info('MM2627001 dan MW2627001 tidak dibuat.');
        });
    }
}
