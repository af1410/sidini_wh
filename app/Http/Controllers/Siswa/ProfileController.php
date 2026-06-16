<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.profile.index', compact('siswa'));
    }

    public function edit()
    {
        $siswa = Auth::guard('siswa')->user();
        return view('siswa.profile.edit', compact('siswa'));
    }

    public function update(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();

        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:siswa,email,' . $siswa->id_siswa . ',id_siswa',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($siswa->gambar && Storage::exists('public/' . $siswa->gambar)) {
                Storage::delete('public/' . $siswa->gambar);
            }

            // Upload foto baru
            $file = $request->file('gambar');
            $path = $file->store('profiles', 'public');
            $validated['gambar'] = $path;
        }

        $siswa->update($validated);

        return redirect()->route('siswa.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
