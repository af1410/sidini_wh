<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $kepsek = Auth::guard('guru')->user();
        return view('kepsek.dashboard', compact('kepsek'));
    }
}
