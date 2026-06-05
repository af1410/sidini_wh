<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Ortu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $validated['username'],
            'password' => $validated['password'],
        ];

        // Try to authenticate as siswa first
        if (Auth::guard('siswa')->attempt($credentials)) {
            $name = Auth::guard('siswa')->user()->nama_siswa ?? 'Siswa';
            return redirect()->route('siswa.dashboard')->with('success', 'Selamat datang, ' . $name);
        }

        // Try to authenticate as ortu
        if (Auth::guard('ortu')->attempt($credentials)) {
            $name = Auth::guard('ortu')->user()->nama_ortu ?? 'Orang Tua';
            return redirect()->route('ortu.dashboard')->with('success', 'Selamat datang, ' . $name);
        }

        // Try to authenticate as guru (check jabatan for admin/kepsek)
        $guru = Guru::query()->where('username', '=', $validated['username'])->first();
        if ($guru && Hash::check($validated['password'], $guru->password)) {
            Auth::guard('guru')->login($guru);
            $name = $guru->nama_guru ?? 'Guru';
            if ($guru->jabatan === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $name);
            } elseif ($guru->jabatan === 'kepala_sekolah') {
                return redirect()->route('kepsek.dashboard')->with('success', 'Selamat datang, ' . $name);
            } elseif ($guru->jabatan === 'kurikulum') {
                return redirect()->route('kurikulum.dashboard')->with('success', 'Selamat datang, ' . $name);
            } else {
                return redirect()->route('guru.dashboard')->with('success', 'Selamat datang, ' . $name);
            }
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        $guards = ['siswa', 'guru', 'ortu'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
