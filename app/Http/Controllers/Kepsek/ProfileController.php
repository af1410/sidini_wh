<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Guru;

class ProfileController extends Controller
{
    public function index()
    {
        $kepsek = Auth::guard('guru')->user();
        return view('kepsek.profile.index', compact('kepsek'));
    }

    public function edit()
    {
        $kepsek = Auth::guard('guru')->user();
        return view('kepsek.profile.edit', compact('kepsek'));
    }

    public function update(Request $request)
    {
        $kepsek = Auth::guard('guru')->user();

        if (
            Guru::where('username', $request->username)
            ->where('id_guru', '!=', $kepsek->id_guru)
            ->exists()
        ) {
            return back()
                ->withInput()
                ->with('error', 'Username sudah digunakan.');
        }

        if (
            Guru::where('email', $request->email)
            ->where('id_guru', '!=', $kepsek->id_guru)
            ->exists()
        ) {
            return back()
                ->withInput()
                ->with('error', 'Email sudah digunakan.');
        }

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ttd' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->hasFile('gambar')) {

            if ($kepsek->gambar && Storage::disk('public')->exists($kepsek->gambar)) {
                Storage::disk('public')->delete($kepsek->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('profiles', 'public');
        }

        if ($request->hasFile('ttd')) {

            if ($kepsek->ttd && Storage::disk('public')->exists($kepsek->ttd)) {
                Storage::disk('public')->delete($kepsek->ttd);
            }

            $validated['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $kepsek->update($validated);

        $kepsek->update($validated);

        return redirect()
            ->route('kepsek.profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
