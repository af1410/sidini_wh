<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Penilaian;
use App\Models\GuruMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasMapelController extends Controller
{
    public function index($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        $mapelsSelected = $kelas->mapels->pluck('id_mapel')->toArray();

        $mapelsAvailable = Mapel::with('guruMapels.guru')
            ->where('tahun_ajaran', $kelas->tahun_ajar)
            ->orderBy('jenis_mapel')
            ->orderBy('nama_mapel')
            ->get();


        $guruSelected = DB::table('kelas_mapel')
            ->join('guru', 'guru.id_guru', '=', 'kelas_mapel.id_guru')
            ->where('kelas_mapel.id_kelas', $id_kelas)
            ->pluck('guru.nama_guru', 'kelas_mapel.id_mapel');

        $guruSelectedId = DB::table('kelas_mapel')
            ->where('id_kelas', $id_kelas)
            ->pluck('id_guru', 'id_mapel');

        return view(
            'admin.kelas_mapel.index',
            compact('kelas', 'mapelsSelected', 'mapelsAvailable', 'guruSelected', 'guruSelectedId')
        );
    }
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'mapels' => ['nullable', 'array'],
            'mapels.*' => ['exists:mapel,id_mapel'],
            'guru_mapel' => ['nullable', 'array'],
        ]);

        DB::transaction(function () use ($request, $id_kelas) {

            $kelas = Kelas::findOrFail($id_kelas);

            $selectedMapels = $request->input('mapels', []);

            /*
        |--------------------------------------------------------------------------
        | Sync Mata Pelajaran
        |--------------------------------------------------------------------------
        */
            $syncData = [];

            foreach ($selectedMapels as $id_mapel) {
                $syncData[$id_mapel] = [
                    'id_guru' => $request->guru_mapel[$id_mapel] ?? null,
                ];
            }

            $kelas->mapels()->sync($syncData);

            /*
        |--------------------------------------------------------------------------
        | Buat Penilaian Ganjil & Genap
        |--------------------------------------------------------------------------
        */

            $semesters = ['ganjil', 'genap'];

            foreach ($selectedMapels as $id_mapel) {

                $id_guru = $request->guru_mapel[$id_mapel] ?? null;

                foreach ($semesters as $semester) {

                    Penilaian::updateOrCreate(
                        [
                            'id_kelas'          => $kelas->id_kelas,
                            'id_mapel'          => $id_mapel,
                            'id_guru'           => $id_guru,
                            'semester'          => $semester,
                            'jenis_penilaian'   => 'formatif',
                            'bab_ke'            => 1,
                        ],
                        [
                            'judul_bab'         => null,

                            // Belum dibuka oleh admin
                            'tanggal_mulai'     => null,
                            'tanggal_selesai'   => null,

                            'status_buka'       => 'ditutup',
                            'status_approval'   => 'normal',

                            'dibuka_oleh'       => auth('guru')->id()
                                ?? auth('guru')->id()
                                ?? 1,

                            'approved_oleh'     => null,
                            'approved_at'       => null,
                            'catatan'           => null,
                        ]
                    );

                    Penilaian::updateOrCreate(
                        [
                            'id_kelas'          => $kelas->id_kelas,
                            'id_mapel'          => $id_mapel,
                            'id_guru'           => $id_guru,
                            'semester'          => $semester,
                            'jenis_penilaian'   => 'sumatif',
                            'bab_ke'            => 1,
                        ],
                        [
                            'judul_bab'         => 'Bab 1',

                            // Belum dibuka oleh admin
                            'tanggal_mulai'     => null,
                            'tanggal_selesai'   => null,

                            'status_buka'       => 'ditutup',
                            'status_approval'   => 'normal',

                            'dibuka_oleh'       => auth('guru')->id()
                                ?? auth('guru')->id()
                                ?? 1,

                            'approved_oleh'     => null,
                            'approved_at'       => null,
                            'catatan'           => null,
                        ]
                    );
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Hapus Penilaian yang Mapelnya Tidak Dipilih Lagi
        |--------------------------------------------------------------------------
        */

            Penilaian::where('id_kelas', $kelas->id_kelas)
                ->whereNotIn('id_mapel', $selectedMapels)
                ->delete();
        });

        return redirect()->route('admin.kelas.index')->with(
            'success',
            'Mata pelajaran berhasil disimpan. Penilaian semester ganjil dan genap berhasil dibuat.'
        );
    }
}
