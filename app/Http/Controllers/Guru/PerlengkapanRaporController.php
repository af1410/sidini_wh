<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PerlengkapanRapor;
use App\Models\Siswa;
use App\Models\Ekskul;
use App\Models\Prestasi;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class PerlengkapanRaporController extends Controller
{
    public function edit($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $tahunAjar = TahunAjar::where('status', 'aktif')->firstOrFail();


        $rapor = PerlengkapanRapor::with([
            'ekskul',
            'prestasi'
        ])->firstOrCreate(
            [
                'id_siswa' => $id_siswa,
                'id_tahun_ajar' => $tahunAjar->id_tahun_ajar
            ],
            ['id_kelas' => $siswa->id_kelas]
        );


        return view(
            'guru.kelas_saya.lengkapi_rapor',
            compact('siswa', 'rapor')
        );
    }

    public function update(Request $request, $id_siswa)
    {
        $rapor = PerlengkapanRapor::where(
            'id_siswa',
            $id_siswa
        )->firstOrFail();

        $rapor->update([
            'sakit' => $request->sakit,
            'izin' => $request->izin,
            'alpa' => $request->alpa,
            'catatan_wali_kelas' => $request->catatan_wali_kelas,
        ]);

        // Hapus data lama
        $rapor->ekskul()->delete();
        $rapor->prestasi()->delete();

        // Simpan Ekskul
        if ($request->has('ekskul')) {

            foreach ($request->ekskul as $item) {

                if (empty($item['nama'])) {
                    continue;
                }

                $rapor->ekskul()->create([
                    'nama_ekskul' => $item['nama'],
                    'nilai' => $item['nilai'] ?? null,
                    'keterangan' => $item['keterangan'] ?? null,
                ]);
            }
        }

        // Simpan Prestasi
        if ($request->has('prestasi')) {

            foreach ($request->prestasi as $item) {

                if (empty($item['nama'])) {
                    continue;
                }

                $rapor->prestasi()->create([
                    'prestasi' => $item['nama'],
                    'keterangan' => $item['keterangan'] ?? null,
                ]);
            }
        }

        return redirect()
            ->route('guru.kelas.index')
            ->with(
                'success',
                'Perlengkapan rapor berhasil disimpan!'
            );
    }
}
