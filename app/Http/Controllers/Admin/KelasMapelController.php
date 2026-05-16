<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class KelasMapelController extends Controller
{
    public function index($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        // Use property accessor untuk eager loading
        $mapelsSelected = $kelas->mapels->pluck('id_mapel')->toArray();
        $mapelsAvailable = Mapel::all();

        return view('admin.kelas_mapel.index', compact('kelas', 'mapelsSelected', 'mapelsAvailable'));
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'mapels' => 'required|array',
            'mapels.*' => 'required|string|exists:mapel,id_mapel',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);
        
        // Sync the mapels
        $kelas->mapels()->sync($request->mapels);

        return redirect()->route('admin.kelas.index')->with('success', 'Mata pelajaran berhasil diperbarui untuk kelas ' . $kelas->nama_kelas);
    }
}
