<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('nama_guru')->paginate(50);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|string|unique:guru,nip',
            'nik' => 'required|string|unique:guru,nik',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:guru,email',
            'jabatan' => 'required|in:guru,admin,kepala_sekolah',
        ]);

        // Auto-generate username dan password dari NIP
        $data['username'] = $data['nip'];
        $data['password'] = bcrypt($data['nip']);

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan. Username dan password otomatis dari NIP.');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nip' => 'required|string|unique:guru,nip,' . $guru->id_guru . ',id_guru',
            'nik' => 'required|string|unique:guru,nik,' . $guru->id_guru . ',id_guru',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:guru,email,' . $guru->id_guru . ',id_guru',
            'password' => 'nullable|string|min:6|confirmed',
            'jabatan' => 'required|in:guru,admin,kepala_sekolah',
        ]);

        // Update username ke NIP (jika NIP berubah)
        $data['username'] = $data['nip'];

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function resetPassword(Guru $guru)
    {
        if (!$guru->nip) {
            return back()->with('error', 'Guru tidak memiliki NIP, password tidak bisa direset.');
        }

        $guru->update([
            'password' => Hash::make($guru->nip),
        ]);

        return back()->with('success', 'Password guru berhasil direset menjadi NIP.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
