<?php

namespace App\Http\Controllers\Kurikulum;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $kurikulum = Auth::guard('guru')->user();
        return view('kurikulum.dashboard', compact('kurikulum'));
    }
}
