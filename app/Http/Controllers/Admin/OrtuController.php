<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ortu;
use Illuminate\Http\Request;

class OrtuController extends Controller
{
    public function index()
    {
        $ortus = Ortu::orderBy('nama_ortu')->paginate(50);
        return view('admin.ortu.index', compact('ortus'));
    }

    public function create()
    {
        return view('admin.ortu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|string|unique:ortu,nik',
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|unique:ortu,no_hp',
            'email' => 'nullable|email|unique:ortu,email',
        ]);

        // Model Ortu akan meng-handle username/password otomatis dari no_hp
        Ortu::create($data);

        return redirect()->route('admin.ortu.index')->with('success', 'Data orang tua berhasil disimpan.');
    }

    public function edit(Ortu $ortu)
    {
        return view('admin.ortu.edit', compact('ortu'));
    }

    public function update(Request $request, Ortu $ortu)
    {
        $data = $request->validate([
            'nik' => 'required|string|unique:ortu,nik,' . $ortu->id_ortu . ',id_ortu',
            'nama_ortu' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|unique:ortu,no_hp,' . $ortu->id_ortu . ',id_ortu',
            'email' => 'nullable|email|unique:ortu,email,' . $ortu->id_ortu . ',id_ortu',
        ]);

        // username otomatis disinkronkan di model ketika perlu
        $ortu->update($data);

        return redirect()->route('admin.ortu.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function destroy(Ortu $ortu)
    {
        $ortu->delete();
        return redirect()->route('admin.ortu.index')->with('success', 'Data orang tua berhasil dihapus.');
    }
}
