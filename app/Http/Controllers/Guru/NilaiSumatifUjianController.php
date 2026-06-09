<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\SumatifUjian;

class NilaiSumatifUjianController extends Controller
{
    public function create($id)
    {
        $pembukaan = Penilaian::with([
            'mapel',
            'kelas.siswas',
            'guru'
        ])->findOrFail($id);

        $siswas = $pembukaan->kelas->siswas;

        return view(
            'guru.nilai.sumatif_ujian',
            compact(
                'pembukaan',
                'siswas'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required',
            'nilai' => 'required|array'
        ]);

        foreach ($request->nilai as $idSiswa => $nilai) {

            SumatifUjian::updateOrCreate(
                [
                    'id_penilaian' => $request->id_penilaian,
                    'id_siswa' => $idSiswa
                ],
                [
                    'nilai_ujian' => $nilai
                ]
            );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Nilai ujian berhasil disimpan'
            );
    }

    public function show($id)
    {
        $penilaian = Penilaian::with([
            'mapel',
            'kelas.siswas',
            'guru',
            'nilaiUjian'
        ])->findOrFail($id);

        $nilaiUjian = $penilaian->nilaiUjian
            ->keyBy('id_siswa');

        return view(
            'guru.nilai.sumatif_ujian_show',
            compact(
                'penilaian',
                'nilaiUjian'
            )
        );
    }
}
