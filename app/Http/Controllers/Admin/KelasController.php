<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas')->orderBy('tahun_ajar')->orderBy('kelas')->paginate(50);
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama_guru')->get();
        return view('admin.kelas.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_ajar' => ['required', 'string', 'max:255'],
            'kelas' => 'required|string|max:255',
            'rombel' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);

        // Buat nama_kelas otomatis, contoh: "XI A"
        $data['nama_kelas'] = $data['kelas'] . ' ' . $data['rombel'];

        if (preg_match('/^(\d{4})-(\d{4})$/', $data['tahun_ajar'], $matches)) {
            $prefix = 'K' . substr($matches[1], 2) . substr($matches[2], 2);
        } else {
            $prefix = 'K' . substr($data['tahun_ajar'], -4);
        }

        $lastKelas = Kelas::where('tahun_ajar', $data['tahun_ajar'])
            ->where('id_kelas', 'like', $prefix . '%')
            ->orderBy('id_kelas', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastKelas) {
            $lastNumber = intval(substr($lastKelas->id_kelas, -3));
            $nextNumber = $lastNumber + 1;
        }

        $data['id_kelas'] = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil disimpan.');
    }

    public function edit(Kelas $kelas)
    {
        $guru = Guru::orderBy('nama_guru')->get();
        return view('admin.kelas.edit', compact('kelas', 'guru'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'tahun_ajar' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'nama_kelas' => 'required|string|max:255',
            'rombel' => 'nullable|string|max:255',
            'id_guru' => 'nullable|exists:guru,id_guru',
        ]);

        $kelas->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
