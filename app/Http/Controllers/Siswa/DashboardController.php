<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.dashboard', compact('siswa'));
    }
}
