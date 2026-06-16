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
}
