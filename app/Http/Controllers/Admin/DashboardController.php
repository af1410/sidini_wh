<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Penilaian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::guard('guru')->user();

        return view('admin.dashboard', [
            'admin' => $admin,
            'totalGuru' => Guru::count(),
            'totalSiswa' => Siswa::count(),
            'totalKelas' => Kelas::count(),
            'totalMapel' => Mapel::count(),
            'totalPenilaian' => Penilaian::count(),
        ]);
    }
}
