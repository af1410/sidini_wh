<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\SumatifUjian;

class NilaiSumatifUjianController extends Controller
{
    public function index()
    {
        $guru = auth()->guard('guru')->user();

        $data = Penilaian::with([
            'mapel',
            'kelas',
            'guru'
        ])
            ->withCount([
                'nilaiFormatif',
                'nilaiSumatif',
                'nilaiUjian'
            ])
            ->where('id_guru', $guru->id_guru)
            ->where('jenis_penilaian', 'sumatif')
            ->whereIn('tipe_sumatif', ['psts', 'psas'])
            ->latest()
            ->get();

        return view('guru.nilai.index', compact('data'));
    }

    public function create($id)
    {
        $pembukaan = Penilaian::with([
            'mapel',
            'kelas.siswas',
            'guru'
        ])
            ->findOrFail($id);

        if ($pembukaan->status_buka != 'dibuka') {
            return redirect()
                ->route('guru.nilai.index')
                ->with('error', 'Penilaian sedang ditutup.');
        }

        $siswas = $pembukaan->kelas->siswas;

        $nilaiUjian = SumatifUjian::where('id_penilaian', $id)
            ->pluck('nilai_ujian', 'id_siswa');

        return view(
            'guru.nilai.sumatif_ujian',
            compact(
                'pembukaan',
                'siswas',
                'nilaiUjian'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required',
            'nilai' => 'required|array'
        ]);

        $penilaian = Penilaian::findOrFail($request->id_penilaian);

        if ($penilaian->status_buka != 'dibuka') {
            return redirect()
                ->route('guru.nilai.index')
                ->with('error', 'Penilaian sedang ditutup.');
        }

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
        if ($request->action == 'approve') {

            if ($penilaian->status_approval == 'draft') {

                $penilaian->update([
                    'status_approval' => 'menunggu_approval'
                ]);
            }

            return redirect()
                ->route('guru.nilai.index')
                ->with(
                    'success',
                    'Nilai berhasil disimpan dan diajukan untuk approval.'
                );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Nilai ujian berhasil disimpan.'
            );
    }

    public function requestApproval($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        if ($penilaian->status_approval == 'menunggu_approval') {
            return back()->with('info', 'Permintaan approval sudah diajukan.');
        }

        if ($penilaian->status_approval == 'disetujui') {
            return back()->with('info', 'Penilaian sudah disetujui.');
        }

        if ($penilaian->status_approval == 'published') {
            return back()->with('info', 'Penilaian sudah dipublish.');
        }

        $penilaian->update([
            'status_approval' => 'menunggu_approval'
        ]);

        return back()->with(
            'success',
            'Permintaan approval berhasil dikirim.'
        );
    }

    public function show($id)
    {
        $penilaian = Penilaian::with([
            'mapel',
            'kelas.siswas',
            'guru',
            'nilaiUjian'
        ])
            ->findOrFail($id);

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
