<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class MapelSayaController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with(['mapels' => function ($q) use ($guru) {
            $q->where('id_guru', $guru->id_guru);
        }])
            ->whereHas('mapels', function ($q) use ($guru) {
                $q->where('id_guru', $guru->id_guru);
            })
            ->orderBy('nama_kelas')
            ->get();

        return view('guru.mapel_saya.index', compact('kelas'));
    }

    public function show($id_kelas)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with([
            'waliKelas',
            'mapels' => function ($q) use ($guru) {
                $q->where('id_guru', $guru->id_guru);
            },
            'siswas'
        ])
            ->where('id_kelas', $id_kelas)
            ->firstOrFail();

        $presensiHariIni = collect(); // sementara kosong

        return view('guru.mapel_saya.show', compact('kelas', 'presensiHariIni'));
    }
}
