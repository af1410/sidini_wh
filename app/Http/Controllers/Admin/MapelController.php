<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\GuruMapel;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $data = Mapel::with('guruMapels.guru', 'tahunAjar')
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($q) use ($keyword) {

                    $q->where('nama_mapel', 'like', "%{$keyword}%")
                        ->orWhere('jenis_mapel', 'like', "%{$keyword}%")
                        ->orWhere('tahun_ajaran', 'like', "%{$keyword}%")
                        ->orWhereHas('guruMapels.guru', function ($guru) use ($keyword) {

                            $guru->where(
                                'nama_guru',
                                'like',
                                "%{$keyword}%"
                            );
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.mapel.index', compact('data', 'keyword'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama_guru')->get();
        $tahunAjars = TahunAjar::orderBy('tahun_mulai', 'desc')->get();
        return view('admin.mapel.create', compact('gurus', 'tahunAjars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenis_mapel' => 'required|string|max:50',
            'id_tahun_ajar' => 'required|exists:tahun_ajar,id_tahun_ajar',
            'id_guru' => 'required|array',
            'id_guru.*' => 'exists:guru,id_guru',
        ]);

        // Get tahun ajar
        $tahunAjar = TahunAjar::find($request->id_tahun_ajar);

        // M
        $prefixMapel = 'M';

        // Huruf pertama jenis mapel
        // wajib -> W
        $prefixJenis = strtoupper(substr($request->jenis_mapel, 0, 1));

        // 2025-2026 -> 2526
        $tahun = str_replace('-', '', substr($tahunAjar->tahun_ajar, 2, 2) . substr($tahunAjar->tahun_ajar, 7, 2));

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
            'tahun_ajaran' => $tahunAjar->tahun_ajar,
            'id_tahun_ajar' => $request->id_tahun_ajar,
        ]);

        foreach ($request->id_guru as $idGuru) {

            GuruMapel::create([
                'id_mapel' => $idMapel,
                'id_guru' => $idGuru,
            ]);
        }

        return redirect()
            ->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::with('guruMapels')->findOrFail($id);

        $gurus = Guru::orderBy('nama_guru')->get();
        $tahunAjars = TahunAjar::orderBy('tahun_mulai', 'desc')->get();

        $selectedGuru = $mapel->guruMapels
            ->pluck('id_guru')
            ->toArray();

        return view(
            'admin.mapel.edit',
            compact(
                'mapel',
                'gurus',
                'tahunAjars',
                'selectedGuru'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'jenis_mapel' => 'required|string|max:50',
            'id_tahun_ajar' => 'required|exists:tahun_ajar,id_tahun_ajar',

            'id_guru' => 'required|array',
            'id_guru.*' => 'exists:guru,id_guru',
        ]);

        $tahunAjar = TahunAjar::find($request->id_tahun_ajar);
        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'jenis_mapel' => $request->jenis_mapel,
            'tahun_ajaran' => $tahunAjar->tahun_ajar,
            'id_tahun_ajar' => $request->id_tahun_ajar,
        ]);

        GuruMapel::where(
            'id_mapel',
            $mapel->id_mapel
        )->delete();
        foreach ($request->id_guru as $idGuru) {

            GuruMapel::create([
                'id_mapel' => $mapel->id_mapel,
                'id_guru' => $idGuru,
            ]);
        }

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
            ->with('error', 'Mapel berhasil dihapus.');
    }
}
