<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class KelasSayaController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with(['waliKelas', 'siswas'])
            ->where('id_guru', $guru->id_guru)
            ->first();

        if (!$kelas) {
            return view('guru.kelas_saya.index', [
                'kelas' => null
            ]);
        }

        return view('guru.kelas_saya.index', compact('kelas'));
    }
}
