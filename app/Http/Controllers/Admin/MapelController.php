<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $data = Mapel::with('guru')->when($keyword, function ($query) use ($keyword) {
            $query->where('nama_mapel', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_mapel', 'like', '%' . $keyword . '%')
                ->orWhere('tahun_ajaran', 'like', '%' . $keyword . '%');
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.mapel.index', compact('data', 'keyword'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama_guru')->get();
        return view('admin.mapel.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenis_mapel' => 'required|string|max:50',
            'tahun_ajaran' => 'required',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);

        // M
        $prefixMapel = 'M';

        // Huruf pertama jenis mapel
        // wajib -> W
        $prefixJenis = strtoupper(substr($request->jenis_mapel, 0, 1));

        // 2025-2026 -> 2526
        $tahun = str_replace('-', '', substr($request->tahun_ajaran, 2, 2) . substr($request->tahun_ajaran, 7, 2));

        // Prefix akhir
        $prefix = $prefixMapel . $prefixJenis . $tahun;

        // Cari id terakhir
        $lastMapel = Mapel::where('id_mapel', 'like', $prefix . '%')
            ->orderBy('id_mapel', 'desc')
            ->first();

        if ($lastMapel) {
            // Ambil 3 digit terakhir
            $lastNumber = (int) substr($lastMapel->id_mapel, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format 001
        $urutan = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Final ID
        $idMapel = $prefix . $urutan;

        Mapel::create([
            'id_mapel' => $idMapel,
            'nama_mapel' => $request->nama_mapel,
            'jenis_mapel' => $request->jenis_mapel,
            'tahun_ajaran' => $request->tahun_ajaran,
            'id_guru' => $request->id_guru,
        ]);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $gurus = Guru::orderBy('nama_guru')->get();
        return view('admin.mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenis_mapel' => 'required|string|max:50',
            'tahun_ajaran' => 'required',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'jenis_mapel' => $request->jenis_mapel,
            'tahun_ajaran' => $request->tahun_ajaran,
            'id_guru' => $request->id_guru,
        ]);

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil dihapus.');
    }
}
