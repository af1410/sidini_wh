<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasMapelController extends Controller
{
    public function index($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        $mapelsSelected = $kelas->mapels->pluck('id_mapel')->toArray();

        $mapelsAvailable = Mapel::where(
            'tahun_ajaran',
            $kelas->tahun_ajar
        )
            ->orderBy('nama_mapel')
            ->get();

        return view(
            'admin.kelas_mapel.index',
            compact('kelas', 'mapelsSelected', 'mapelsAvailable')
        );
    }
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'mapels' => ['nullable', 'array'],
            'mapels.*' => ['exists:mapel,id_mapel'],
        ]);

        DB::transaction(function () use ($request, $id_kelas) {

            $kelas = Kelas::findOrFail($id_kelas);

            $selectedMapels = $request->input('mapels', []);

            $kelas->mapels()->sync($selectedMapels);

            $semester = now()->month >= 7 ? 'ganjil' : 'genap';

            $tanggalSelesai = $semester === 'ganjil'
                ? now()->year . '-12-31 23:59:59'
                : now()->year . '-06-30 23:59:59';

            foreach ($selectedMapels as $id_mapel) {

                $id_guru = DB::table('mapel')
                    ->where('id_mapel', $id_mapel)
                    ->value('id_guru');

                /*
            |--------------------------------------------------------------------------
            | FORMATIF BAB 1
            |--------------------------------------------------------------------------
            */
                Penilaian::firstOrCreate(
                    [
                        'id_kelas' => $kelas->id_kelas,
                        'id_mapel' => $id_mapel,
                        'semester' => $semester,
                        'jenis_penilaian' => 'formatif',
                        'bab_ke' => 1,
                    ],
                    [
                        'id_guru' => $id_guru,
                        'judul_bab' => null,

                        'tanggal_mulai' => now(),
                        'tanggal_selesai' => $tanggalSelesai,

                        'status_buka' => 'ditutup',
                        'status_approval' => 'normal',

                        'dibuka_oleh' => auth('guru')->id()
                            ?? auth('admin')->id()
                            ?? 1,

                        'approved_oleh' => null,
                        'approved_at' => null,
                        'catatan' => null,
                    ]
                );

                /*
            |--------------------------------------------------------------------------
            | SUMATIF BAB 1
            |--------------------------------------------------------------------------
            */
                Penilaian::firstOrCreate(
                    [
                        'id_kelas' => $kelas->id_kelas,
                        'id_mapel' => $id_mapel,
                        'semester' => $semester,
                        'jenis_penilaian' => 'sumatif',
                        'bab_ke' => 1,
                    ],
                    [
                        'id_guru' => $id_guru,
                        'judul_bab' => 'Bab 1',

                        'tanggal_mulai' => now(),
                        'tanggal_selesai' => $tanggalSelesai,

                        'status_buka' => 'ditutup',
                        'status_approval' => 'normal',

                        'dibuka_oleh' => auth('guru')->id()
                            ?? auth('admin')->id()
                            ?? 1,

                        'approved_oleh' => null,
                        'approved_at' => null,
                        'catatan' => null,
                    ]
                );
            }

            /*
        |--------------------------------------------------------------------------
        | Hapus penilaian mapel yang tidak lagi dipilih
        |--------------------------------------------------------------------------
        */
            Penilaian::where('id_kelas', $kelas->id_kelas)
                ->where('semester', $semester)
                ->whereNotIn('id_mapel', $selectedMapels)
                ->delete();
        });

        return back()->with(
            'success',
            'Mata pelajaran berhasil disimpan. Penilaian formatif dan sumatif otomatis dibuat.'
        );
    }

    public function update1(Request $request, $id_kelas)
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
