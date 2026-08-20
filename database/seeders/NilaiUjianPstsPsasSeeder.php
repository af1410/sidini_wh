<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NilaiUjianPstsPsasSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = Carbon::now();
            $idKelas = 'KX2526002';
            $idTahunAjar = 3;
            $semester = 'ganjil';
            $mapelPenilaian = [
                'MW2627002' => 43,
                'MM2627012' => 47,
                'MM2627013' => 51,
                'MU2627005' => 55,
                'MU2627004' => 59,
                'MU2627008' => 63,
                'MU2627002' => 67,
                'MU2627003' => 71,
                'MU2627006' => 75,
                'MU2627001' => 79,
                'MU2627010' => 83,
                'MU2627009' => 87,
                'MU2627007' => 91,
                'MU2627011' => 95,
            ];
            $siswaKelas = DB::table('siswa_kelas')
                ->where('id_kelas', $idKelas)
                ->where('id_tahun_ajar', $idTahunAjar)
                ->where('status', 'aktif')
                ->get();
            foreach ($mapelPenilaian as $idMapel => $idPenilaianAsal) {
                $penilaianAsal = DB::table('penilaian')
                    ->where('id', $idPenilaianAsal)
                    ->first();
                if (!$penilaianAsal) {
                    $this->command->warn("Penilaian {$idPenilaianAsal} untuk mapel {$idMapel} tidak ditemukan.");
                    continue;
                }
                $dataPenilaian = [
                    'id_tahun_ajar' => $idTahunAjar,
                    'id_guru' => $penilaianAsal->id_guru,
                    'id_mapel' => $idMapel,
                    'id_kelas' => $idKelas,
                    'semester' => $semester,
                    'jenis_penilaian' => 'sumatif',
                    'bab_ke' => null,
                    'judul_bab' => null,
                    'tanggal_selesai' => null,
                    'status_buka' => 'dibuka',
                    'status_approval' => 'normal',
                    'dibuka_oleh' => $penilaianAsal->dibuka_oleh,
                    'approved_oleh' => $penilaianAsal->approved_oleh,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $pstsExisting = DB::table('penilaian')
                    ->where('id_kelas', $idKelas)
                    ->where('id_mapel', $idMapel)
                    ->where('id_guru', $penilaianAsal->id_guru)
                    ->where('semester', $semester)
                    ->where('jenis_penilaian', 'sumatif')
                    ->where('tipe_sumatif', 'PSTS')
                    ->first();
                if ($pstsExisting) {
                    $pstsId = $pstsExisting->id;
                } else {
                    $pstsId = DB::table('penilaian')->insertGetId(array_merge(
                        $dataPenilaian,
                        [
                            'tipe_sumatif' => 'PSTS',
                            'tanggal_mulai' => '2026-09-01 00:00:00',
                        ]
                    ));
                }
                $psasExisting = DB::table('penilaian')
                    ->where('id_kelas', $idKelas)
                    ->where('id_mapel', $idMapel)
                    ->where('id_guru', $penilaianAsal->id_guru)
                    ->where('semester', $semester)
                    ->where('jenis_penilaian', 'sumatif')
                    ->where('tipe_sumatif', 'PSAS')
                    ->first();
                if ($psasExisting) {
                    $psasId = $psasExisting->id;
                } else {
                    $psasId = DB::table('penilaian')->insertGetId(array_merge(
                        $dataPenilaian,
                        [
                            'tipe_sumatif' => 'PSAS',
                            'tanggal_mulai' => '2026-12-01 00:00:00',
                        ]
                    ));
                }
                foreach ($siswaKelas as $siswa) {
                    $nilaiAkhir = DB::table('nilai_akhir')
                        ->where('id_siswa', $siswa->id_siswa)
                        ->where('id_mapel', $idMapel)
                        ->where('id_kelas', $idKelas)
                        ->where('semester', $semester)
                        ->first();
                    if (!$nilaiAkhir) {
                        $this->command->warn("Nilai akhir siswa {$siswa->id_siswa} untuk mapel {$idMapel} tidak ditemukan.");
                        continue;
                    }
                    DB::table('nilai_sumatif_ujian')->updateOrInsert(
                        [
                            'id_penilaian' => $pstsId,
                            'id_siswa' => $siswa->id_siswa,
                        ],
                        [
                            'nilai_ujian' => $nilaiAkhir->nilai_psts,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                    DB::table('nilai_sumatif_ujian')->updateOrInsert(
                        [
                            'id_penilaian' => $psasId,
                            'id_siswa' => $siswa->id_siswa,
                        ],
                        [
                            'nilai_ujian' => $nilaiAkhir->nilai_psas,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }
                $this->command->info("{$idMapel} → PSTS ID {$pstsId}, PSAS ID {$psasId}");
            }
            $this->command->info('Seeder nilai PSTS dan PSAS berhasil.');
            $this->command->info('Nilai diambil langsung dari tabel nilai_akhir sehingga nilainya sama.');
        });
    }
}
