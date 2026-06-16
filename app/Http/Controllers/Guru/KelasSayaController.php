<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\NilaiAkhir;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\KelasMapel;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelasSayaController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }



        $kelas = Kelas::with(['waliKelas', 'siswas'])
            ->where('id_guru', $guru->id_guru)
            ->first();

        if (!$kelas) {
            return view('guru.kelas_saya.index', [
                'kelas' => null
            ]);
        }
        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get()
            ->pluck('mapel');

        $nilaiAkhir = NilaiAkhir::where('id_kelas', $kelas->id_kelas)
            ->get()
            ->groupBy(['id_siswa', 'id_mapel']);

        return view('guru.kelas_saya.index', compact('kelas', 'nilaiAkhir', 'mapels'));
    }

    public function raporIndex()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with(['waliKelas', 'siswas'])
            ->where('id_guru', $guru->id_guru)
            ->first();

        if (!$kelas) {
            return view('guru.kelas_saya.rapor_index', [
                'kelas' => null,
                'siswas' => collect([]),
            ]);
        }

        $siswas = $kelas->siswas;

        return view('guru.kelas_saya.rapor_index', compact('kelas', 'siswas'));
    }

    public function raporPdf($id_siswa)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $siswa = Siswa::where('id_siswa', $id_siswa)
            ->where('id_kelas', $kelas->id_kelas)
            ->firstOrFail();

        $raporData = $this->prepareRaporData($kelas, $siswa);

        $filename = sprintf(
            'rapor_%s_%s_%s.pdf',
            Str::slug($siswa->nama_siswa, '_'),
            Str::slug($kelas->nama_kelas, '_'),
            Str::slug($kelas->tahun_ajar ?? now()->year, '_')
        );

        $pdf = Pdf::loadView('guru.kelas_saya.rapor_pdf', array_merge(
            compact('kelas', 'siswa'),
            $raporData
        ))->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }

    public function raporPdfDownload($id_siswa)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $siswa = Siswa::where('id_siswa', $id_siswa)
            ->where('id_kelas', $kelas->id_kelas)
            ->firstOrFail();

        $raporData = $this->prepareRaporData($kelas, $siswa);

        $filename = sprintf(
            'rapor_%s_%s_%s.pdf',
            Str::slug($siswa->nama_siswa, '_'),
            Str::slug($kelas->nama_kelas, '_'),
            Str::slug($kelas->tahun_ajar ?? now()->year, '_')
        );

        $pdf = Pdf::loadView('guru.kelas_saya.rapor_pdf', array_merge(
            compact('kelas', 'siswa'),
            $raporData
        ))->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }

    public function downloadAllRapor()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with('siswas')
            ->where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $siswas = $kelas->siswas;

        $zipName = tempnam(sys_get_temp_dir(), 'rapor_');
        $zip = new \ZipArchive();

        if ($zip->open($zipName, \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat arsip ZIP rapor.');
        }

        foreach ($siswas as $siswa) {
            $raporData = $this->prepareRaporData($kelas, $siswa);

            $pdf = Pdf::loadView('guru.kelas_saya.rapor_pdf', array_merge(
                compact('kelas', 'siswa'),
                $raporData
            ))->setPaper('a4', 'portrait');

            $pdfName = sprintf(
                'rapor_%s_%s_%s.pdf',
                Str::slug($siswa->nama_siswa, '_'),
                Str::slug($kelas->nama_kelas, '_'),
                Str::slug($kelas->tahun_ajar ?? now()->year, '_')
            );

            $zip->addFromString($pdfName, $pdf->output());
        }

        $zip->close();

        return response()->download($zipName, sprintf('rapor_semua_%s_%s.zip', Str::slug($kelas->nama_kelas, '_'), Str::slug($kelas->tahun_ajar ?? now()->year, '_')))
            ->deleteFileAfterSend(true);
    }

    private function prepareRaporData(Kelas $kelas, Siswa $siswa): array
    {
        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get()
            ->pluck('mapel');

        $nilaiAkhir = NilaiAkhir::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_siswa', $siswa->id_siswa)
            ->get()
            ->keyBy('id_mapel');

        $mapelWithScores = $mapels->map(function ($mapel) use ($nilaiAkhir) {
            $nilai = $nilaiAkhir->get($mapel->id_mapel);
            $nilaiAkhirValue = $nilai->nilai_akhir ?? 0;
            $deskripsi = $nilai->keterangan ?? '-';

            return (object) [
                'id_mapel' => $mapel->id_mapel,
                'nama_mapel' => $mapel->nama_mapel,
                'jenis_mapel' => $mapel->jenis_mapel,
                'tahun_ajaran' => $mapel->tahun_ajaran,
                'nilai_akhir' => $nilaiAkhirValue,
                'deskripsi' => $deskripsi,
            ];
        });

        $mapelUmum = $mapelWithScores->filter(fn($mapel) => strtolower($mapel->jenis_mapel) === 'wajib')->values();
        $mapelPilihan = $mapelWithScores->filter(fn($mapel) => strtolower($mapel->jenis_mapel) === 'minat')->values();
        $mapelVokasi = $mapelWithScores->filter(fn($mapel) => !in_array(strtolower($mapel->jenis_mapel), ['wajib', 'minat']))->values();

        $totalNilai = $mapelWithScores->sum('nilai_akhir');
        $semester = $nilaiAkhir->first()?->semester;
        $tahunAjar = $kelas->tahun_ajar;

        [$tahunMulai, $tahunSelesai] = explode('/', $tahunAjar);

        if ($semester === 'Ganjil') {
            $tanggalMulai = Carbon::create($tahunMulai, 7, 1)->startOfDay();
            $tanggalSelesai = Carbon::create($tahunMulai, 12, 31)->endOfDay();
        } else {
            $tanggalMulai = Carbon::create($tahunSelesai, 1, 1)->startOfDay();
            $tanggalSelesai = Carbon::create($tahunSelesai, 6, 30)->endOfDay();
        }

        $presensi = Presensi::where('id_siswa', $siswa->id_siswa)
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);

        $sakit = (clone $presensi)->where('status', 'Sakit')->count();
        $izin  = (clone $presensi)->where('status', 'Izin')->count();
        $alpa  = (clone $presensi)->where('status', 'Alpha')->count();
        return [
            'mapelUmum' => $mapelUmum,
            'mapelPilihan' => $mapelPilihan,
            'mapelVokasi' => $mapelVokasi,
            'totalNilai' => $totalNilai,
            'semester' => 'Ganjil',
            'kokurikuler' => '-',
            'ekstrakurikuler' => collect([]),
            'prestasi' => collect([]),
            'sakit' => $sakit,
            'izin' => $izin,
            'alpa' => $alpa,
            'catatan_wali' => '-',
            'kepalaMadrasah' => null,
        ];
    }
}
