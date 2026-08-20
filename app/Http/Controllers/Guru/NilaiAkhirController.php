<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Penilaian;
use App\Models\SumatifUjian;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\NilaiAkhir;
use App\Models\NilaiFormatif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiAkhirExport;

class NilaiAkhirController extends Controller
{
    public function show($id_kelas, $id_mapel)
    {
        $mapel = Mapel::findOrFail($id_mapel);
        $kelas = Kelas::findOrFail($id_kelas);
        $guru = Auth::guard('guru')->user();

        $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        $siswas = Siswa::where('id_kelas', $id_kelas)->get();

        $babPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'semester' => $semester,
        ])
            ->whereNull('tipe_sumatif')
            ->with('nilaiSumatif')
            ->orderBy('bab_ke')
            ->get();

        // Ambil penilaian PSTS
        $pstsPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSTS',
            'semester' => $semester,
        ])->first();

        // Ambil penilaian PSAS
        $psasPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSAS',
            'semester' => $semester,
        ])->first();

        // Ambil semua nilai PSTS sekaligus
        $nilaiPsts = $pstsPenilaian
            ? SumatifUjian::where('id_penilaian', $pstsPenilaian->id)
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        // Ambil semua nilai PSAS sekaligus
        $nilaiPsas = $psasPenilaian
            ? SumatifUjian::where('id_penilaian', $psasPenilaian->id)
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        $formatifPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'formatif',
            'semester' => $semester,
        ])->first();

        $nilaiFormatif = $formatifPenilaian
            ? NilaiFormatif::where('id_penilaian', $formatifPenilaian->id)->get()
            : collect();

        $existingNilaiAkhir = NilaiAkhir::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'semester' => $semester,
        ])
            ->get()
            ->keyBy('id_siswa');


        $nilaiSiswa = [];

        foreach ($siswas as $siswa) {
            $nilaiBab = [];
            foreach ($babPenilaian as $penilaian) {
                $nilai = $penilaian->nilaiSumatif->where('id_siswa', $siswa->id_siswa)->first();
                $nilaiBabValue = $nilai?->nilai_bab ?? null;
                if (!is_null($nilaiBabValue)) {
                    $nilaiBab[] = $nilaiBabValue;
                }
            }
            $rataBab = count($nilaiBab) ? round(array_sum($nilaiBab) / count($nilaiBab), 2) : 0;
            $nilaiFormatifSiswa = $nilaiFormatif->where('id_siswa', $siswa->id_siswa);
            $nilaiBabFormatif = $nilaiFormatifSiswa->groupBy('bab_ke')->map(function ($nilaiBab) {
                return $nilaiBab->avg('nilai_bab');
            })->filter(fn($nilai) => $nilai !== null);
            $rataBabFormatif = $nilaiBabFormatif->count() ? round($nilaiBabFormatif->avg(), 2) : 0;
            $psts = $nilaiPsts[$siswa->id_siswa] ?? 0;
            $psas = $nilaiPsas[$siswa->id_siswa] ?? 0;
            $rerataFSPsts = ($rataBabFormatif + $rataBab + $psts) / 3;
            $nilaiAkhir = ($rerataFSPsts * 75 / 100) + ($psas * 25 / 100);
            $nilaiAkhir = round($nilaiAkhir, 2);
            $defaultKeterangan = $this->generateKeterangan($nilaiAkhir);
            $nilaiSiswa[] = [
                'siswa' => $siswa,
                'rata_bab' => $rataBab,
                'rata_bab_formatif' => $rataBabFormatif,
                'psts' => $psts,
                'psas' => $psas,
                'rerata_fspsts' => round($rerataFSPsts, 2),
                'nilai_akhir' => $nilaiAkhir,
                'keterangan' => $existingNilaiAkhir[$siswa->id_siswa]?->keterangan ?? null,
                'default_keterangan' => $defaultKeterangan,
            ];
        }


        return view(
            'guru.nilai_akhir.show',
            compact(
                'nilaiSiswa',
                'kelas',
                'mapel'
            )
        );
    }

    private function generateKeterangan($nilai)
    {
        if ($nilai >= 90) {
            return 'Menunjukkan penguasaan materi yang sangat baik serta mampu menerapkan konsep secara mandiri.';
        } elseif ($nilai >= 80) {
            return 'Menunjukkan penguasaan materi yang baik dan mampu menerapkan sebagian besar konsep dengan tepat.';
        } elseif ($nilai >= 70) {
            return 'Menunjukkan penguasaan materi yang cukup baik namun masih memerlukan peningkatan pada beberapa aspek.';
        } elseif ($nilai >= 60) {
            return 'Menunjukkan penguasaan materi yang kurang dan memerlukan bimbingan lebih lanjut.';
        } else {
            return 'Menunjukkan penguasaan materi yang sangat kurang dan memerlukan pendampingan intensif.';
        }
    }

    public function store(
        Request $request,
        $id_kelas,
        $id_mapel
    ) {
        $guru = Auth::guard('guru')->user();

        $semester = now()->month >= 7
            ? 'ganjil'
            : 'genap';



        $siswas = Siswa::where(
            'id_kelas',
            $id_kelas
        )->get();

        // Ambil semua penilaian BAB
        $babPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'semester' => $semester,
        ])
            ->whereNull('tipe_sumatif')
            ->with('nilaiSumatif')
            ->get();

        // Ambil penilaian PSTS
        $pstsPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSTS',
            'semester' => $semester,
        ])->first();

        // Ambil penilaian PSAS
        $psasPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSAS',
            'semester' => $semester,
        ])->first();

        // Semua nilai PSTS
        $nilaiPsts = $pstsPenilaian
            ? SumatifUjian::where(
                'id_penilaian',
                $pstsPenilaian->id
            )
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        // Semua nilai PSAS
        $nilaiPsas = $psasPenilaian
            ? SumatifUjian::where(
                'id_penilaian',
                $psasPenilaian->id
            )
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        $validated = $request->validate([
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:600',
        ]);

        foreach ($siswas as $siswa) {

            $nilaiBab = [];

            foreach ($babPenilaian as $penilaian) {

                $nilai = $penilaian->nilaiSumatif
                    ->where(
                        'id_siswa',
                        $siswa->id_siswa
                    )
                    ->first();

                if (
                    $nilai &&
                    $nilai->nilai_bab !== null
                ) {
                    $nilaiBab[] =
                        $nilai->nilai_bab;
                }
            }

            $rataBab = count($nilaiBab)
                ? round(
                    array_sum($nilaiBab) /
                        count($nilaiBab),
                    2
                )
                : 0;

            $formatifPenilaian = Penilaian::where([
                'id_kelas' => $id_kelas,
                'id_mapel' => $id_mapel,
                'id_guru' => $guru->id_guru,
                'jenis_penilaian' => 'formatif',
                'semester' => $semester,
            ])->first();
            $nilaiFormatif = $formatifPenilaian ? NilaiFormatif::where('id_penilaian', $formatifPenilaian->id)->get() : collect();

            $nilaiFormatifSiswa = $nilaiFormatif->where('id_siswa', $siswa->id_siswa);
            $nilaiBabFormatif = $nilaiFormatifSiswa->groupBy('bab_ke')->map(function ($nilaiBab) {
                return $nilaiBab->avg('nilai_bab');
            })->filter(fn($nilai) => $nilai !== null);
            $rataBabFormatif = $nilaiBabFormatif->count() ? round($nilaiBabFormatif->avg(), 2) : 0;
            $psts = $nilaiPsts[$siswa->id_siswa] ?? 0;
            $psas = $nilaiPsas[$siswa->id_siswa] ?? 0;
            $rerataFSPsts = ($rataBabFormatif + $rataBab + $psts) / 3;
            $nilaiAkhir = round(($rerataFSPsts * 75 / 100) + ($psas * 25 / 100));

            $keterangan = $request->input('keterangan.' . $siswa->id_siswa);
            $keterangan = filled($keterangan) ? $keterangan : $this->generateKeterangan($nilaiAkhir);
            NilaiAkhir::updateOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_mapel' => $id_mapel,
                    'id_kelas' => $id_kelas,
                    'semester' => $semester,
                ],
                [
                    'rata_bab' => $rataBab,
                    'rata_bab_formatif' => $rataBabFormatif,
                    'nilai_psts' => $psts,
                    'nilai_psas' => $psas,
                    'nilai_akhir' => round($nilaiAkhir, 2),
                    'keterangan' => $keterangan,
                ]
            );
        }

        return back()->with(
            'success',
            'Nilai akhir berhasil disimpan.'
        );
    }

    public function exportExcel(
        Request $request,
        $id_kelas,
        $id_mapel
    ) {

        $guru = Auth::guard('guru')->user();

        $semester = now()->month >= 7
            ? 'ganjil'
            : 'genap';

        $babPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'semester' => $semester,
        ])
            ->whereNull('tipe_sumatif')
            ->with('nilaiSumatif')
            ->orderBy('bab_ke')
            ->get();

        $babList = $babPenilaian
            ->pluck('bab_ke')
            ->unique()
            ->values();

        // Ambil bobot dari modal
        $bobotBab = (float) ($request->bobot_bab ?? 40);
        $bobotPsts = (float) ($request->bobot_psts ?? 30);
        $bobotPsas = (float) ($request->bobot_psas ?? 30);

        // Penilaian PSTS
        $pstsPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSTS',
            'semester' => $semester,
        ])->first();

        // Penilaian PSAS
        $psasPenilaian = Penilaian::where([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel,
            'id_guru' => $guru->id_guru,
            'jenis_penilaian' => 'sumatif',
            'tipe_sumatif' => 'PSAS',
            'semester' => $semester,
        ])->first();

        // Semua nilai PSTS
        $nilaiPsts = $pstsPenilaian
            ? SumatifUjian::where(
                'id_penilaian',
                $pstsPenilaian->id
            )
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        // Semua nilai PSAS
        $nilaiPsas = $psasPenilaian
            ? SumatifUjian::where(
                'id_penilaian',
                $psasPenilaian->id
            )
            ->pluck('nilai_ujian', 'id_siswa')
            ->toArray()
            : [];

        $rows = [];

        $siswas = Siswa::where(
            'id_kelas',
            $id_kelas
        )->get();

        foreach ($siswas as $siswa) {

            $detailBab = [];
            $nilaiBab = [];

            foreach ($babPenilaian as $penilaian) {

                $nilai = $penilaian->nilaiSumatif
                    ->where(
                        'id_siswa',
                        $siswa->id_siswa
                    )
                    ->first();

                $babValue = $nilai?->nilai_bab;

                $detailBab[] = $babValue;

                if ($babValue !== null) {
                    $nilaiBab[] = $babValue;
                }
            }

            $rataBab = count($nilaiBab)
                ? round(
                    array_sum($nilaiBab) /
                        count($nilaiBab),
                    2
                )
                : 0;

            $psts = $nilaiPsts[$siswa->id_siswa] ?? 0;
            $psas = $nilaiPsas[$siswa->id_siswa] ?? 0;

            $nilaiAkhir =
                ($rataBab * $bobotBab / 100) +
                ($psts * $bobotPsts / 100) +
                ($psas * $bobotPsas / 100);

            $row = [
                $siswa->nim,
                $siswa->nama_siswa
            ];

            foreach ($detailBab as $bab) {
                $row[] = $bab;
            }

            $row[] = $rataBab;
            $row[] = $psts;
            $row[] = $psas;
            $row[] = round($nilaiAkhir, 2);

            $rows[] = $row;
        }


        $mapel = Mapel::findOrFail($id_mapel);
        $kelas = Kelas::findOrFail($id_kelas);

        $namaFile = sprintf(
            'nilai_akhir_%s_%s_%s.xlsx',
            Str::slug($mapel->nama_mapel, '_'),
            Str::slug($kelas->nama_kelas, '_'),
            Str::slug($kelas->tahun_ajar ?? '', '_')
        );

        return Excel::download(
            new NilaiAkhirExport(
                $rows,
                $babList
            ),
            $namaFile
        );
    }
}
