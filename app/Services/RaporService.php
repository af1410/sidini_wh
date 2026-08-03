<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelasMapel;
use App\Models\NilaiAkhir;
use App\Models\PerlengkapanRapor;

class RaporService
{
    public function prepareRaporData(Kelas $kelas, Siswa $siswa): array
    {
        // Pastikan relasi wali kelas sudah tersedia
        $kelas->loadMissing('waliKelas');

        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get()
            ->pluck('mapel');

        $nilaiAkhir = NilaiAkhir::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_siswa', $siswa->id_siswa)
            ->get()
            ->keyBy('id_mapel');

        $mapelWithScores = $mapels->map(function ($mapel) use ($nilaiAkhir) {
            $nilai = $nilaiAkhir->get($mapel->id_mapel);

            return (object) [
                'id_mapel'     => $mapel->id_mapel,
                'nama_mapel'   => $mapel->nama_mapel,
                'jenis_mapel'  => $mapel->jenis_mapel,
                'nilai_akhir'  => $nilai->nilai_akhir ?? 0,
                'deskripsi'    => $nilai->keterangan ?? '-',
            ];
        });

        $mapelUmum = $mapelWithScores
            ->filter(fn($item) => strtolower($item->jenis_mapel) === 'umum')
            ->values();

        $mapelPilihan = $mapelWithScores
            ->filter(fn($item) => strtolower($item->jenis_mapel) === 'minat')
            ->values();



        $totalNilai = $mapelWithScores->sum('nilai_akhir');

        $semester = $nilaiAkhir->first()?->semester ?? 'Ganjil';

        $perlengkapan = PerlengkapanRapor::with([
            'ekskul',
            'prestasi',
            'approver',
        ])->firstOrCreate(
            [
                'id_siswa' => $siswa->id_siswa,
            ],
            [
                'id_kelas' => $kelas->id_kelas,
            ]
        );

        return [
            'mapelUmum'          => $mapelUmum,
            'mapelPilihan'       => $mapelPilihan,
            'totalNilai'         => $totalNilai,
            'semester'           => $semester,
            'kokurikuler'        => '-',
            'ekstrakurikuler'    => $perlengkapan->ekskul,
            'prestasi'           => $perlengkapan->prestasi,
            'sakit'              => $perlengkapan->sakit,
            'izin'               => $perlengkapan->izin,
            'alpa'               => $perlengkapan->alpa,
            'catatan_wali'       => $perlengkapan->catatan_wali_kelas,
            // Data utama rapor
            'perlengkapanRapor'  => $perlengkapan,
            // Wali kelas
            'waliKelas'          => $kelas->waliKelas,
            // Kepala sekolah yang meng-ACC
            'approver'           => $perlengkapan->approver,
        ];
    }
}
