<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\NilaiAkhir;
use App\Models\Siswa;
use App\Models\KelasMapel;
use App\Services\RaporService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelasSayaController extends Controller
{
    protected RaporService $raporService;

    public function __construct(RaporService $raporService)
    {
        $this->raporService = $raporService;
    }

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

        return view('guru.kelas_saya.index', compact(
            'kelas',
            'nilaiAkhir',
            'mapels'
        ));
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

        $kelas = Kelas::with('waliKelas')
            ->where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $siswa = Siswa::where('id_siswa', $id_siswa)
            ->where('id_kelas', $kelas->id_kelas)
            ->firstOrFail();

        // Mengambil seluruh data rapor dari service
        $raporData = $this->raporService->prepareRaporData($kelas, $siswa);

        $filename = sprintf(
            'rapor_%s_%s_%s.pdf',
            Str::slug($siswa->nama_siswa, '_'),
            Str::slug($kelas->nama_kelas, '_'),
            Str::slug($kelas->tahun_ajar ?? now()->year, '_')
        );

        $pdf = Pdf::loadView(
            'guru.kelas_saya.rapor_pdf',
            array_merge(

                compact('kelas', 'siswa'),
                $raporData
            )
        )->setPaper('a4', 'portrait');

        return $pdf->stream($filename);
    }
    public function raporPdfDownload($id_siswa)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with('waliKelas')
            ->where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $siswa = Siswa::where('id_siswa', $id_siswa)
            ->where('id_kelas', $kelas->id_kelas)
            ->firstOrFail();

        // Ambil seluruh data rapor dari service
        $raporData = $this->raporService->prepareRaporData($kelas, $siswa);

        $filename = sprintf(
            'rapor_%s_%s_%s.pdf',
            Str::slug($siswa->nama_siswa, '_'),
            Str::slug($kelas->nama_kelas, '_'),
            Str::slug($kelas->tahun_ajar ?? now()->year, '_')
        );

        $pdf = Pdf::loadView(
            'guru.kelas_saya.rapor_pdf',
            array_merge(
                compact('kelas', 'siswa'),
                $raporData
            )
        )->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }
    public function downloadAllRapor()
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403, 'Guru belum login.');
        }

        $kelas = Kelas::with([
            'waliKelas',
            'siswas'
        ])
            ->where('id_guru', $guru->id_guru)
            ->firstOrFail();

        $zipName = tempnam(sys_get_temp_dir(), 'rapor_');

        $zip = new \ZipArchive();

        if ($zip->open($zipName, \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat arsip ZIP rapor.');
        }

        foreach ($kelas->siswas as $siswa) {

            $raporData = $this->raporService->prepareRaporData($kelas, $siswa);

            $pdf = Pdf::loadView(
                'guru.kelas_saya.rapor_pdf',
                array_merge(
                    compact('kelas', 'siswa'),
                    $raporData
                )
            )->setPaper('a4', 'portrait');

            $pdfName = sprintf(
                'rapor_%s_%s_%s.pdf',
                Str::slug($siswa->nama_siswa, '_'),
                Str::slug($kelas->nama_kelas, '_'),
                Str::slug($kelas->tahun_ajar ?? now()->year, '_')
            );

            $zip->addFromString($pdfName, $pdf->output());
        }

        $zip->close();

        return response()->download(
            $zipName,
            sprintf(
                'rapor_semua_%s_%s.zip',
                Str::slug($kelas->nama_kelas, '_'),
                Str::slug($kelas->tahun_ajar ?? now()->year, '_')
            )
        )->deleteFileAfterSend(true);
    }
}
