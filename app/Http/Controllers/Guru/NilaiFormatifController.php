<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiFormatif;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiFormatifController extends Controller
{
    public function bukaDariKelasMapel($id_kelas, $id_mapel)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        // $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        $penilaian = Penilaian::where('id_kelas', $id_kelas)
            ->where('id_mapel', $id_mapel)
            ->where('id_guru', $guru->id_guru)
            ->where('jenis_penilaian', 'formatif')
            ->where('semester')
            ->first();

        if (!$penilaian) {
            return back()->with('error', 'Penilaian formatif belum tersedia.');
        }

        return redirect()->route('guru.nilai_formatif.show', $penilaian->id);
    }

    public function show($id_kelas, $id_mapel)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        $penilaian = Penilaian::with([
            'kelas.siswas',
            'mapel',
            'nilaiFormatif'
        ])
            ->where('id_kelas', $id_kelas)
            ->where('id_mapel', $id_mapel)
            ->where('id_guru', $guru->id_guru)
            ->where('jenis_penilaian', 'formatif')
            ->where('semester', $semester)
            ->firstOrFail();

        $siswa = $penilaian->kelas->siswas;



        /*
    |--------------------------------------------------------------------------
    | Daftar Bab
    |--------------------------------------------------------------------------
    */

        $babList = $penilaian->nilaiFormatif
            ->pluck('bab_ke')
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        if (empty($babList)) {
            $babList = [1];
        }

        $babAktif = !empty($babList) ? max($babList) : 1;

        $pertemuanTerakhir = $penilaian->nilaiFormatif
            ->where('bab_ke', $babAktif)
            ->max('pertemuan_ke') ?? 0;

        $babBerikutnyaAda = in_array($babAktif + 1, $babList);
        /*
    |--------------------------------------------------------------------------
    | Pivot Nilai
    |--------------------------------------------------------------------------
    | $nilaiPivot[bab][pertemuan][id_siswa]
    |--------------------------------------------------------------------------
    */

        $nilaiPivot = [];

        foreach ($penilaian->nilaiFormatif as $nilai) {
            $nilaiPivot[$nilai->bab_ke][$nilai->pertemuan_ke][$nilai->id_siswa] = $nilai;
        }

        /*
    |--------------------------------------------------------------------------
    | Pertemuan per Bab
    |--------------------------------------------------------------------------
    */

        $pertemuanPerBab = [];

        foreach ($penilaian->nilaiFormatif as $nilai) {
            $pertemuanPerBab[$nilai->bab_ke][] = $nilai->pertemuan_ke;
        }

        foreach ($pertemuanPerBab as $bab => $list) {
            $pertemuanPerBab[$bab] = collect($list)
                ->unique()
                ->sort()
                ->values()
                ->toArray();
        }


        /*
    |--------------------------------------------------------------------------
    | Jika bab belum punya pertemuan
    |--------------------------------------------------------------------------
    */

        foreach ($babList as $bab) {
            if (!isset($pertemuanPerBab[$bab])) {
                $pertemuanPerBab[$bab] = [1];
            }
        }

        return view('guru.nilai_formatif.show', compact(
            'penilaian',
            'siswa',
            'babList',
            'nilaiPivot',
            'pertemuanPerBab',
            'babAktif',
            'pertemuanTerakhir',
            'babBerikutnyaAda'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penilaian' => 'required|exists:penilaian,id',
            'nilai_bab' => 'nullable|array',
            'tanggal_bab' => 'nullable|array',
        ]);

        $idPenilaian = $request->id_penilaian;

        $nilaiBab = $request->nilai_bab ?? [];
        $tanggalBab = $request->tanggal_bab ?? [];

        /*
    |--------------------------------------------------------------------------
    | 1. Simpan nilai formatif per pertemuan
    |--------------------------------------------------------------------------
    */

        foreach ($nilaiBab as $babKe => $pertemuanList) {

            foreach ($pertemuanList as $pertemuanKe => $siswaList) {

                foreach ($siswaList as $idSiswa => $nilai) {

                    if ($nilai === '' || $nilai === null) {
                        continue;
                    }

                    NilaiFormatif::updateOrCreate(
                        [
                            'id_penilaian' => $idPenilaian,
                            'id_siswa' => $idSiswa,
                            'bab_ke' => $babKe,
                            'pertemuan_ke' => $pertemuanKe,
                        ],
                        [
                            'tanggal_input' => $tanggalBab[$babKe][$pertemuanKe]
                                ?? now()->toDateString(),

                            'nilai_formatif' => $nilai,
                            'nilai_bab' => null,

                            'status_data' => 'aktif',
                        ]
                    );
                }
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 2. Hitung nilai_bab berdasarkan seluruh pertemuan dalam setiap bab
    |--------------------------------------------------------------------------
    */

        $dataFormatif = NilaiFormatif::where('id_penilaian', $idPenilaian)
            ->where('status_data', 'aktif')
            ->get()
            ->groupBy([
                'id_siswa',
                'bab_ke'
            ]);


        foreach ($dataFormatif as $idSiswa => $babList) {

            foreach ($babList as $babKe => $nilaiPertemuan) {

                // Hitung rata-rata nilai seluruh pertemuan pada bab tersebut
                $rataBab = $nilaiPertemuan->avg('nilai_formatif');

                // Simpan hasil rata-rata ke setiap record pertemuan
                NilaiFormatif::where('id_penilaian', $idPenilaian)
                    ->where('id_siswa', $idSiswa)
                    ->where('bab_ke', $babKe)
                    ->update([
                        'nilai_bab' => round($rataBab, 2)
                    ]);
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 3. Selesai
    |--------------------------------------------------------------------------
    */

        return back()->with(
            'success',
            'Nilai formatif berhasil disimpan dan nilai per bab berhasil dihitung.'
        );
    }

    public function tambahBab($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $babTerakhir = NilaiFormatif::where('id_penilaian', $id)
            ->max('bab_ke');

        $babBaru = ($babTerakhir ?? 0) + 1;

        return response()->json([
            'success' => true,
            'bab_baru' => $babBaru,
        ]);
    }

    public function tambahPertemuan($id, $bab)
    {
        $pertemuanTerakhir = NilaiFormatif::where('id_penilaian', $id)
            ->where('bab_ke', $bab)
            ->max('pertemuan_ke');

        $pertemuanBaru = ($pertemuanTerakhir ?? 0) + 1;

        return response()->json([
            'success' => true,
            'pertemuan_baru' => $pertemuanBaru,
        ]);
    }
}
