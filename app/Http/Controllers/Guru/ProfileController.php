<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.profile.index', compact('guru'));
    }

    public function edit()
    {
        $guru = Auth::guard('guru')->user();
        return view('guru.profile.edit', compact('guru'));
    }

    public function update(Request $request)
    {
        $guru = Auth::guard('guru')->user();

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:guru,email,' . $guru->id_guru . ',id_guru',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ttd' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Hapus TTD lama jika upload baru
        if ($request->hasFile('ttd')) {

            if ($guru->ttd && Storage::exists('public/' . $guru->ttd)) {
                Storage::delete('public/' . $guru->ttd);
            }

            $validated['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($guru->gambar && Storage::exists('public/' . $guru->gambar)) {
                Storage::delete('public/' . $guru->gambar);
            }

            // Upload foto baru
            $file = $request->file('gambar');
            $path = $file->store('profiles', 'public');
            $validated['gambar'] = $path;
        }

        $guru->update($validated);

        return redirect()->route('guru.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
