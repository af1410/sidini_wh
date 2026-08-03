<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PerlengkapanRapor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $kepsek = Auth::guard('guru')->user();

        $totalGuru = Guru::count();
        $totalKelas = Kelas::count();

        $totalSiswa = Siswa::count();

        return view('kepsek.dashboard', compact(
            'kepsek',
            'totalGuru',
            'totalKelas',
            'totalSiswa'
        ));
    }
}
