<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::guard('guru')->user();
        return view('admin.dashboard', compact('admin'));
    }
}
