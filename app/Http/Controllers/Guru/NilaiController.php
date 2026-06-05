<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\NilaiFormatif;
use App\Models\NilaiSumatif;
use App\Models\NilaiSumatifTugas;
use App\Models\NilaiAkhir;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $data = Penilaian::with(['mapel', 'kelas', 'guru'])
            ->withCount(['nilaiFormatif', 'nilaiSumatif'])
            ->where('status_buka', '=', 'dibuka', 'and')
            ->latest()
            ->get();

        return view('guru.nilai.index', compact('data'));
    }

    // Export CSV for teachers: supports optional ?id_penilaian= and/or ?semester= and/or ?id_mapel=
    public function exportCsv(Request $request)
    {
        $idPenilaian = $request->query('id_penilaian');
        $semester = $request->query('semester');
        $idMapel = $request->query('id_mapel');

        $query = NilaiAkhir::with(['mapel', 'siswa']);

        if ($idPenilaian) {
            // find penilaian to limit mapel/semester
            $p = Penilaian::find($idPenilaian);
            if ($p) {
                $query->where('id_mapel', $p->id_mapel)->where('semester', $p->semester);
            }
        }
        if ($semester) {
            $query->where('semester', $semester);
        }
        if ($idMapel) {
            $query->where('id_mapel', $idMapel);
        }

        $data = $query->orderBy('semester')->get();

        // gather bab columns
        $mapelIds = $data->pluck('id_mapel')->unique()->values()->all();
        $penilaian = Penilaian::whereIn('id_mapel', $mapelIds)
            ->when($semester, function ($q) use ($semester) {
                return $q->where('semester', $semester);
            })
            ->get();

        $babNumbers = $penilaian->pluck('bab_ke')->filter()->unique()->sort()->values()->all();

        // prepare lookup of penilaian by mapel and bab
        $penilaianByMapelBab = [];
        foreach ($penilaian as $p) {
            $penilaianByMapelBab[$p->id_mapel][$p->bab_ke] = $p;
        }

        // attach nilai_per_bab on each NilaiAkhir item
        foreach ($data as $n) {
            $perBab = [];
            foreach ($babNumbers as $bab) {
                $value = null;
                if (isset($penilaianByMapelBab[$n->id_mapel]) && isset($penilaianByMapelBab[$n->id_mapel][$bab])) {
                    $p = $penilaianByMapelBab[$n->id_mapel][$bab];
                    $ns = NilaiSumatif::where('id_penilaian', $p->id)
                        ->where('id_siswa', $n->id_siswa)
                        ->first();
                    if ($ns) {
                        $value = $ns->nilai_bab ?? $n->nilai_sumatif ?? null;
                    }
                }
                $perBab[$bab] = $value;
            }
            $n->nilai_per_bab = $perBab;
        }

        $filename = 'export_nilai_' . (now()->format('Ymd_His')) . '.csv';

        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($data, $babNumbers) {
            $handle = fopen('php://output', 'w');
            $headers = array_merge(['Semester', 'NIS', 'Nama Siswa', 'Mapel', 'Formatif'], array_map(function ($b) {
                return 'Bab ' . $b;
            }, $babNumbers), ['Sumatif', 'Nilai Akhir']);
            fputcsv($handle, $headers);

            foreach ($data as $n) {
                $row = [];
                $row[] = $n->semester;
                $row[] = $n->siswa?->nisn ?? $n->id_siswa;
                $row[] = $n->siswa?->nama_siswa ?? '';
                $row[] = $n->mapel?->nama_mapel ?? $n->id_mapel;
                $row[] = isset($n->nilai_formatif) ? number_format($n->nilai_formatif, 2) : '';
                foreach ($babNumbers as $bab) {
                    $val = $n->nilai_per_bab[$bab] ?? null;
                    $row[] = isset($val) ? number_format($val, 2) : '';
                }
                $row[] = isset($n->nilai_sumatif) ? number_format($n->nilai_sumatif, 2) : '';
                $row[] = isset($n->nilai_akhir) ? number_format($n->nilai_akhir, 2) : '';
                fputcsv($handle, $row);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }

    public function show($idPenilaian)
    {
        $pembukaan = Penilaian::with(['mapel', 'kelas', 'guru'])->findOrFail($idPenilaian);

        if ($pembukaan->jenis_penilaian === 'formatif') {
            $nilai = NilaiFormatif::with('siswa')
                ->where('id_penilaian', '=', $idPenilaian, 'and')
                ->get();
        } else {
            $nilai = NilaiSumatif::with(['siswa', 'tugas'])
                ->where('id_penilaian', '=', $idPenilaian, 'and')
                ->get();
        }

        return view('guru.nilai.show', compact('pembukaan', 'nilai'));
    }

    public function requestApproval($idPenilaian)
    {
        $penilaian = Penilaian::findOrFail($idPenilaian);

        if (now()->lte($penilaian->tanggal_selesai)) {
            return back()->with('error', 'Permintaan approval hanya bisa diajukan setelah periode penilaian berakhir.');
        }

        $hasNilai = $penilaian->jenis_penilaian === 'formatif'
            ? NilaiFormatif::where('id_penilaian', '=', $idPenilaian, 'and')->exists()
            : NilaiSumatif::where('id_penilaian', '=', $idPenilaian, 'and')->exists();

        if ($hasNilai) {
            return back()->with('info', 'Nilai sudah terinput, silakan lihat detail nilai.');
        }

        if ($penilaian->status_approval === 'menunggu_approval') {
            return back()->with('info', 'Permintaan approval sudah diajukan dan sedang menunggu respon.');
        }

        $penilaian->update(['status_approval' => 'menunggu_approval']);

        return back()->with('success', 'Permintaan persetujuan input nilai telah dikirim ke admin/kurikulum.');
    }

    public function createFormatif($idPembukaan)
    {
        $pembukaan = Penilaian::with(['mapel', 'kelas', 'guru'])->findOrFail($idPembukaan);

        if (now()->gt($pembukaan->tanggal_selesai) && $pembukaan->status_approval !== 'disetujui') {
            return back()->with('error', 'Periode sudah berakhir. Ajukan permintaan input nilai ke admin/kurikulum terlebih dahulu.');
        }

        return view('guru.nilai.formatif_create', compact('pembukaan'));
    }

    public function storeFormatif(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required',
            'id_siswa' => 'required',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        $penilaian = Penilaian::findOrFail($request->id_penilaian);

        $status = now()->gt($penilaian->tanggal_selesai)
            ? 'menunggu_approval'
            : 'submitted';

        NilaiFormatif::updateOrCreate(
            [
                'id_penilaian' => $request->id_penilaian,
                'id_siswa' => $request->id_siswa,
            ],
            [
                'nilai_uas' => $request->nilai_uas,
                'status_data' => $status,
            ]
        );

        return back()->with('success', 'Nilai formatif berhasil disimpan.');
    }

    public function createSumatif($idPenilaian)
    {
        $pembukaan = Penilaian::with(['mapel', 'kelas', 'guru'])->findOrFail($idPenilaian);

        if (now()->gt($pembukaan->tanggal_selesai) && $pembukaan->status_approval !== 'disetujui') {
            return back()->with('error', 'Periode sudah berakhir. Ajukan permintaan input nilai ke admin/kurikulum terlebih dahulu.');
        }

        $siswas = Siswa::where('id_kelas', '=', $pembukaan->id_kelas, 'and')->orderBy('nama_siswa')->get();
        return view('guru.nilai.sumatif_create', compact('pembukaan', 'siswas'));
    }

    public function storeSumatif(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required',
            'judul_bab' => 'nullable|string|max:150',
            'id_siswa' => 'required|array|min:1',
            'nilai_tes_tulis' => 'required|array',
            'nilai_tes_tulis.*' => 'required|numeric|min:0|max:100',
            'nilai_kehadiran' => 'required|array',
            'nilai_kehadiran.*' => 'required|numeric|min:0|max:100',
            'bobot_tes_tulis' => 'required|numeric|min:0|max:100',
            'bobot_tugas' => 'required|numeric|min:0|max:100',
            'bobot_kehadiran' => 'required|numeric|min:0|max:100',
            'tugas' => 'required|array|min:1',
            'tugas.*.nama_tugas' => 'nullable|string|max:150',
            'tugas_nilai' => 'required|array',
            'tugas_nilai.*' => 'required|array',
            'tugas_nilai.*.*' => 'required|numeric|min:0|max:100',
        ]);

        $totalBobot = $request->bobot_tes_tulis + $request->bobot_tugas + $request->bobot_kehadiran;
        if ($totalBobot != 100) {
            return back()->withErrors(['bobot' => 'Total bobot harus 100%'])->withInput();
        }

        $penilaian = Penilaian::findOrFail($request->id_penilaian);
        if ($request->filled('judul_bab')) {
            $penilaian->update(['judul_bab' => $request->judul_bab]);
        }

        DB::transaction(function () use ($request, $penilaian) {
            $status = now()->gt($penilaian->tanggal_selesai)
                ? 'menunggu_approval'
                : 'submitted';

            foreach ($request->id_siswa as $idSiswa) {
                $sumatif = NilaiSumatif::updateOrCreate(
                    [
                        'id_penilaian' => $request->id_penilaian,
                        'id_siswa' => $idSiswa,
                    ],
                    [
                        'nilai_tes_tulis' => $request->nilai_tes_tulis[$idSiswa],
                        'nilai_kehadiran' => $request->nilai_kehadiran[$idSiswa],
                        'bobot_tes_tulis' => $request->bobot_tes_tulis,
                        'bobot_tugas' => $request->bobot_tugas,
                        'bobot_kehadiran' => $request->bobot_kehadiran,
                        'status_data' => $status,
                    ]
                );

                $sumatif->tugas()->delete();

                foreach ($request->tugas as $taskIndex => $tugas) {
                    $namaTugas = trim($tugas['nama_tugas'] ?? '');
                    if ($namaTugas === '') {
                        $namaTugas = 'Tugas ' . ($taskIndex + 1);
                    }

                    NilaiSumatifTugas::create([
                        'id_sumatif' => $sumatif->id,
                        'nama_tugas' => $namaTugas,
                        'nilai' => $request->tugas_nilai[$idSiswa][$taskIndex] ?? 0,
                    ]);
                }

                $rataTugas = $sumatif->tugas()->avg('nilai') ?? 0;

                $nilaiBab = (
                    ($sumatif->nilai_tes_tulis * $sumatif->bobot_tes_tulis) +
                    ($rataTugas * $sumatif->bobot_tugas) +
                    ($sumatif->nilai_kehadiran * $sumatif->bobot_kehadiran)
                ) / 100;

                $sumatif->update([
                    'nilai_bab' => $nilaiBab,
                ]);

                $this->recalcAkhir($idSiswa, $penilaian->id_mapel, $penilaian->semester);
            }
        });

        return view('guru.nilai.index')->with('success', 'Nilai sumatif berhasil disimpan untuk semua siswa.');
    }

    private function recalcAkhir($idSiswa, $idMapel, $semester)
    {
        $nilaiFormatif = NilaiFormatif::where('id_siswa', '=', $idSiswa, 'and')
            ->whereHas('penilaian', function ($q) use ($idMapel, $semester) {
                $q->where('id_mapel', '=', $idMapel)
                    ->where('semester', '=', $semester)
                    ->where('jenis_penilaian', '=', 'formatif');
            })
            ->value('nilai_uas') ?? 0;

        $nilaiSumatif = NilaiSumatif::where('id_siswa', '=', $idSiswa, 'and')
            ->whereHas('penilaian', function ($q) use ($idMapel, $semester) {
                $q->where('id_mapel', '=', $idMapel)
                    ->where('semester', '=', $semester)
                    ->where('jenis_penilaian', '=', 'sumatif');
            })
            ->avg('nilai_bab') ?? 0;

        $bobotFormatif = 40;
        $bobotSumatif = 60;

        $nilaiAkhir = (
            ($nilaiFormatif * $bobotFormatif) +
            ($nilaiSumatif * $bobotSumatif)
        ) / 100;

        NilaiAkhir::updateOrCreate(
            [
                'id_siswa' => $idSiswa,
                'id_mapel' => $idMapel,
                'semester' => $semester,
            ],
            [
                'bobot_formatif' => $bobotFormatif,
                'bobot_sumatif' => $bobotSumatif,
                'nilai_formatif' => $nilaiFormatif,
                'nilai_sumatif' => $nilaiSumatif,
                'nilai_akhir' => $nilaiAkhir,
            ]
        );
    }
}
