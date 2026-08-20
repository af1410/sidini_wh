<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NilaiPstsPsasSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $penilaianAsal = DB::table('penilaian')
                ->where('id', 43)
                ->first();
            if (!$penilaianAsal) {
                $this->command->error('Penilaian dengan ID 43 tidak ditemukan.');
                return;
            }
            $now = Carbon::now();
            $pstsId = DB::table('penilaian')->insertGetId([
                'id_guru' => $penilaianAsal->id_guru,
                'id_mapel' => $penilaianAsal->id_mapel,
                'id_kelas' => $penilaianAsal->id_kelas,
                'semester' => $penilaianAsal->semester,
                'jenis_penilaian' => 'sumatif',
                'tipe_sumatif' => 'PSTS',
                'bab_ke' => null,
                'judul_bab' => null,
                'tanggal_mulai' => '2026-09-01',
                'created_at' => $now,
                'updated_at' => $now,
                'dibuka_oleh' => $penilaianAsal->dibuka_oleh,

            ]);
            $psasId = DB::table('penilaian')->insertGetId([
                'id_guru' => $penilaianAsal->id_guru,
                'id_mapel' => $penilaianAsal->id_mapel,
                'id_kelas' => $penilaianAsal->id_kelas,
                'semester' => $penilaianAsal->semester,
                'jenis_penilaian' => 'sumatif',
                'tipe_sumatif' => 'PSAS',
                'bab_ke' => null,
                'judul_bab' => null,
                'tanggal_mulai' => '2026-12-01',
                'created_at' => $now,
                'updated_at' => $now,
                'dibuka_oleh' => $penilaianAsal->dibuka_oleh,
            ]);
            $siswaKelas = DB::table('siswa_kelas')
                ->where('id_kelas', $penilaianAsal->id_kelas)
                ->where('id_tahun_ajar', 3)
                ->where('status', 'aktif')
                ->get();
            $nilaiPsts = [
                12 => 82,
                13 => 85,
                14 => 80,
                15 => 88,
                16 => 86,
                17 => 90,
                18 => 89,
            ];
            $nilaiPsas = [
                12 => 86,
                13 => 88,
                14 => 84,
                15 => 90,
                16 => 89,
                17 => 92,
                18 => 91,
            ];
            foreach ($siswaKelas as $siswa) {
                $idSiswa = $siswa->id_siswa;
                $nilaiBabData = DB::table('nilai_sumatif')
                    ->where('id_penilaian', 43)
                    ->where('id_siswa', $idSiswa)
                    ->first();
                $rataBab = $nilaiBabData?->nilai_bab ?? 0;
                $psts = $nilaiPsts[$idSiswa] ?? rand(80, 95);
                $psas = $nilaiPsas[$idSiswa] ?? rand(80, 95);
                $bobotBab = 40;
                $bobotPsts = 30;
                $bobotPsas = 30;
                $nilaiAkhir = round(
                    ($rataBab * $bobotBab / 100) +
                        ($psts * $bobotPsts / 100) +
                        ($psas * $bobotPsas / 100),
                    2
                );
                DB::table('nilai_sumatif_ujian')->updateOrInsert(
                    [
                        'id_penilaian' => $pstsId,
                        'id_siswa' => $idSiswa,
                    ],
                    [
                        'nilai_ujian' => $psts,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
                DB::table('nilai_sumatif_ujian')->updateOrInsert(
                    [
                        'id_penilaian' => $psasId,
                        'id_siswa' => $idSiswa,
                    ],
                    [
                        'nilai_ujian' => $psas,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
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
                        'id_mapel' => $penilaianAsal->id_mapel,
                        'id_kelas' => $penilaianAsal->id_kelas,
                        'semester' => $penilaianAsal->semester,
                    ],
                    [
                        'bobot_bab' => $bobotBab,
                        'bobot_psts' => $bobotPsts,
                        'bobot_psas' => $bobotPsas,
                        'rata_bab' => $rataBab,
                        'rata_bab_formatif' => null,
                        'nilai_psts' => $psts,
                        'nilai_psas' => $psas,
                        'nilai_akhir' => $nilaiAkhir,
                        'keterangan' => $keterangan,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
            $this->command->info("PSTS berhasil dibuat dengan ID: {$pstsId}");
            $this->command->info("PSAS berhasil dibuat dengan ID: {$psasId}");
            $this->command->info('Nilai PSTS, PSAS, dan Nilai Akhir berhasil dibuat.');
        });
    }
}
