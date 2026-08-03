<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelasMapel;
use App\Models\Penilaian;
use App\Models\NilaiSumatif;
use App\Models\SumatifUjian;
use App\Models\NilaiAkhir;
use App\Models\PerlengkapanRapor;
use App\Services\RaporService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    protected $raporService;

    public function __construct(RaporService $raporService)
    {
        $this->raporService = $raporService;
    }


    public function index()
    {
        $kelas = Kelas::with([
            'tahunAjar',
            'waliKelas',
            'siswas',
        ])->get();



        foreach ($kelas as $item) {
            $item->jumlah_acc = PerlengkapanRapor::where('id_kelas', $item->id_kelas)
                ->where('status_acc', 'disetujui')
                ->count();

            $item->jumlah_menunggu = $item->siswas->count() - $item->jumlah_acc;
        }


        return view('kepsek.kelas.index', compact('kelas'));
    }


    public function show($id_kelas)
    {
        $kelas = Kelas::with('siswas')
            ->findOrFail($id_kelas);

        $rapors = PerlengkapanRapor::where('id_kelas', $id_kelas)
            ->get()
            ->keyBy('id_siswa');

        return view(
            'kepsek.kelas.show',
            compact('kelas', 'rapors')
        );
    }

    public function detailNilai($id_siswa)
    {
        // Ambil data siswa
        $siswa = Siswa::findOrFail($id_siswa);

        // Ambil kelas siswa
        $kelas = Kelas::findOrFail($siswa->id_kelas);

        // Semester aktif
        $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        // Semua mapel pada kelas
        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get();

        $dataMapel = [];

        foreach ($mapels as $item) {

            $mapel = $item->mapel;

            // Nilai akhir
            $nilaiAkhir = NilaiAkhir::where([
                'id_siswa' => $siswa->id_siswa,
                'id_kelas' => $kelas->id_kelas,
                'id_mapel' => $mapel->id_mapel,
                'semester' => $semester,
            ])->first();

            // Daftar BAB
            $babPenilaian = Penilaian::where([
                'id_kelas'        => $kelas->id_kelas,
                'id_mapel'        => $mapel->id_mapel,
                'id_tahun_ajar'   => $kelas->id_tahun_ajar,
                'semester'        => $semester,
                'jenis_penilaian' => 'sumatif',
            ])
                ->whereNull('tipe_sumatif')
                ->orderBy('bab_ke')
                ->get();

            $detailBab = [];

            foreach ($babPenilaian as $bab) {

                $detailBab[$bab->bab_ke] = NilaiSumatif::where([
                    'id_penilaian' => $bab->id,
                    'id_siswa'     => $siswa->id_siswa,
                ])->value('nilai_bab');
            }

            // PSTS
            $penilaianPSTS = Penilaian::where([
                'id_kelas' => $kelas->id_kelas,
                'id_mapel' => $mapel->id_mapel,
                'semester' => $semester,
                'jenis_penilaian' => 'sumatif',
                'tipe_sumatif' => 'PSTS',
            ])->first();

            $psts = null;

            if ($penilaianPSTS) {
                $psts = SumatifUjian::where([
                    'id_penilaian' => $penilaianPSTS->id,
                    'id_siswa' => $siswa->id_siswa,
                ])->value('nilai_ujian');
            }

            // PSAS
            $penilaianPSAS = Penilaian::where([
                'id_kelas' => $kelas->id_kelas,
                'id_mapel' => $mapel->id_mapel,
                'semester' => $semester,
                'jenis_penilaian' => 'sumatif',
                'tipe_sumatif' => 'PSAS',
            ])->first();

            $psas = null;

            if ($penilaianPSAS) {
                $psas = SumatifUjian::where([
                    'id_penilaian' => $penilaianPSAS->id,
                    'id_siswa' => $siswa->id_siswa,
                ])->value('nilai_ujian');
            }

            $dataMapel[] = [
                'mapel'       => $mapel,
                'detail_bab'  => $detailBab,
                'rata_bab'    => $nilaiAkhir?->rata_bab,
                'psts'        => $psts,
                'psas'        => $psas,
                'nilai_akhir' => $nilaiAkhir?->nilai_akhir,
            ];
        }

        // Semua BAB untuk header tabel
        $semuaBab = Penilaian::where([
            'jenis_penilaian' => 'sumatif',
            'semester' => $semester,
        ])
            ->whereNull('tipe_sumatif')
            ->pluck('bab_ke')
            ->unique()
            ->sort()
            ->values();

        return view(
            'kepsek.kelas.detail_nilai',
            compact(
                'siswa',
                'kelas',
                'dataMapel',
                'semuaBab'
            )
        );
    }

    public function preview($id)
    {
        $siswa = Siswa::findOrFail($id);

        $kelas = Kelas::findOrFail($siswa->id_kelas);

        $raporData = $this->raporService
            ->prepareRaporData($kelas, $siswa);

        $pdf = Pdf::loadView(
            'kepsek.rapor_siswa.rapor_pdf',
            array_merge(
                compact(
                    'kelas',
                    'siswa'
                ),
                $raporData
            )
        )->setPaper('a4', 'portrait');

        return $pdf->stream(
            'rapor_' .
                Str::slug($siswa->nama_siswa, '_') .
                '.pdf'
        );
    }

    public function acc($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);

        $rapor = PerlengkapanRapor::firstOrCreate(
            [
                'id_siswa' => $siswa->id_siswa
            ],
            [
                'id_kelas' => $siswa->id_kelas
            ]
        );

        $rapor->update([
            'status_acc' => 'disetujui',
            'approved_at' => now(),
            'approved_by' => Auth::guard('guru')->id(),
        ]);

        return back()->with(
            'success',
            'Rapor berhasil disetujui.'
        );
    }

    public function batalAcc($id_siswa)
    {
        $rapor = PerlengkapanRapor::where(
            'id_siswa',
            $id_siswa
        )->firstOrFail();

        $rapor->update([
            'status_acc' => 'menunggu',
            'approved_at' => null,
            'approved_by' => null,
        ]);

        return back()->with(
            'success',
            'ACC rapor berhasil dibatalkan.'
        );
    }

    public function accSelected(Request $request)
    {
        $request->validate([
            'siswa' => 'required|array'
        ]);

        PerlengkapanRapor::whereIn('id_siswa', $request->siswa)
            ->update([
                'status_acc' => 'disetujui',
                'approved_by' => auth()->guard('guru')->id(),
                'approved_at' => now(),
            ]);

        return back()->with('success', 'Rapor berhasil di ACC.');
    }

    public function batalSelected(Request $request)
    {
        $request->validate([
            'siswa' => 'required|array'
        ]);

        PerlengkapanRapor::whereIn('id_siswa', $request->siswa)
            ->update([
                'status_acc' => 'menunggu',
                'approved_by' => null,
                'approved_at' => null,
            ]);

        return back()->with('success', 'ACC berhasil dibatalkan.');
    }
}
