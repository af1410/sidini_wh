<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penilaian;
use App\Models\NilaiSumatif;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NilaiController extends Controller
{
    // Show all sumatif penilaian for a mapel+semester with student's nilai
    public function sumatifByMapel($id_mapel, $semester)
    {
        $siswa = Auth::guard('siswa')->user();

        $penilaian = Penilaian::where('id_mapel', $id_mapel)
            ->where('semester', $semester)
            ->where('jenis_penilaian', 'sumatif')
            ->orderBy('bab_ke')
            ->get();

        // load student's NilaiSumatif for these penilaian
        $nilaiMap = [];
        foreach ($penilaian as $p) {
            $ns = NilaiSumatif::where('id_penilaian', $p->id)
                ->where('id_siswa', $siswa->id_siswa)
                ->first();
            $nilaiMap[$p->id] = $ns;
        }

        return view('siswa.penilaian.mapel_sumatif', compact('penilaian', 'nilaiMap', 'siswa'));
    }

    // Show details (tugas) for a specific penilaian and student's tugas
    public function showPenilaian($id)
    {
        $siswa = Auth::guard('siswa')->user();

        $p = Penilaian::with('mapel')->findOrFail($id);

        $ns = NilaiSumatif::with('tugas')
            ->where('id_penilaian', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->first();

        $tugas = $ns ? $ns->tugas : collect();

        // compute average if tugas available
        $avg = null;
        if ($tugas->isNotEmpty()) {
            $sum = $tugas->sum(function ($t) {
                return $t->nilai ?? 0;
            });
            $avg = $sum / $tugas->count();
        }

        return view('siswa.penilaian.show', compact('p', 'ns', 'tugas', 'avg', 'siswa'));
    }

    // export removed: exports are handled by Guru only
}
