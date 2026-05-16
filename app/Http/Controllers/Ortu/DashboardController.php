<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $ortu = Auth::guard('ortu')->user();
        return view('ortu.dashboard', compact('ortu'));
    }
}
