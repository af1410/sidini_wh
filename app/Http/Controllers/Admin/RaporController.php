<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PerlengkapanRapor;
use App\Services\RaporService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RaporController extends Controller
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


        return view('admin.rapor_siswa.index', compact('kelas'));
    }


    public function show($id_kelas)
    {
        $kelas = Kelas::with('siswas')
            ->findOrFail($id_kelas);

        $rapors = PerlengkapanRapor::where('id_kelas', $id_kelas)
            ->get()
            ->keyBy('id_siswa');

        return view(
            'admin.rapor_siswa.show',
            compact('kelas', 'rapors')
        );
    }

    public function preview($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);

        $kelas = Kelas::findOrFail($siswa->id_kelas);

        $raporData = $this->raporService
            ->prepareRaporData($kelas, $siswa);

        $pdf = Pdf::loadView(
            'admin.rapor_siswa.rapor_pdf',
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
}
