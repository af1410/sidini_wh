<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.dashboard', compact('guru'));
    }
}
