<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('guru')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('guru')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('guru')->user();

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:guru,email,' . $admin->id_guru . ',id_guru',
            'alamat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hapus foto lama jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($admin->gambar && Storage::exists('public/' . $admin->gambar)) {
                Storage::delete('public/' . $admin->gambar);
            }

            // Upload foto baru
            $file = $request->file('gambar');
            $path = $file->store('profiles', 'public');
            $validated['gambar'] = $path;
        }

        $admin->update($validated);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
