<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiAkhir;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.dashboard', compact('siswa'));
    }

    public function nilai()
    {
        $siswa = Auth::guard('siswa')->user();

        $nilai = NilaiAkhir::with('mapel')
            ->where('id_siswa', $siswa->id_siswa)
            ->orderBy('semester')
            ->get();

        $nilaiPerSemester = $nilai->groupBy('semester');

        // For each semester build list of bab columns and attach per-bab values to each row
        $babColumnsPerSemester = [];

        foreach ($nilaiPerSemester as $semester => $items) {
            $mapelIds = $items->pluck('id_mapel')->unique()->values()->all();

            $penilaian = \App\Models\Penilaian::whereIn('id_mapel', $mapelIds)
                ->where('semester', $semester)
                ->get();

            $babNumbers = $penilaian->pluck('bab_ke')->filter()->unique()->sort()->values()->all();

            $babColumnsPerSemester[$semester] = $babNumbers;

            // prepare lookup of penilaian by mapel and bab
            $penilaianByMapelBab = [];
            foreach ($penilaian as $p) {
                $penilaianByMapelBab[$p->id_mapel][$p->bab_ke] = $p;
            }

            // attach nilai_per_bab on each NilaiAkhir item (build array locally then assign)
            foreach ($items as $n) {
                $perBab = [];
                foreach ($babNumbers as $bab) {
                    $value = null;
                    if (isset($penilaianByMapelBab[$n->id_mapel]) && isset($penilaianByMapelBab[$n->id_mapel][$bab])) {
                        $p = $penilaianByMapelBab[$n->id_mapel][$bab];
                        // try to find student's NilaiSumatif for this penilaian
                        $ns = \App\Models\NilaiSumatif::where('id_penilaian', $p->id)
                            ->where('id_siswa', $siswa->id_siswa)
                            ->first();
                        if ($ns) {
                            // prefer nilai_bab if available, otherwise fallback to nilai_sumatif in NilaiAkhir
                            $value = $ns->nilai_bab ?? $n->nilai_sumatif ?? null;
                        }
                    }
                    $perBab[$bab] = $value;
                }
                // assign whole array once to avoid indirect modification on overloaded property
                $n->nilai_per_bab = $perBab;
            }
        }

        return view('siswa.nilai', ['siswa' => $siswa, 'nilaiPerSemester' => $nilaiPerSemester, 'babColumnsPerSemester' => $babColumnsPerSemester]);
    }
}
