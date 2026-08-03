<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjar;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiFormatif;
use App\Models\NilaiSumatif;
use App\Models\GuruMapel;
use App\Models\KelasMapel;
use App\Models\SumatifUjian;
use Illuminate\Support\Facades\DB;


class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $semester = $request->semester ?? 'ganjil';

        $tahunAjarDb = TahunAjar::where('status', 'aktif')->first();
        $tahunAjar = $request->tahun_ajar ?? $tahunAjarDb?->tahun_ajar;

        $formatifSumatif = Penilaian::with([
            'mapel',
            'kelas',
            'guru'
        ])
            ->whereNull('tipe_sumatif')
            ->where('semester', $semester)
            ->whereHas('kelas', function ($q) use ($tahunAjar) {
                $q->where('tahun_ajar', $tahunAjar);
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->id_kelas . '_' . $item->id_mapel;
            });

        $psts = Penilaian::with([
            'mapel',
            'kelas',
            'guru'
        ])
            ->where('tipe_sumatif', 'PSTS')
            ->where('semester', $semester)
            ->whereHas('kelas', function ($q) use ($tahunAjar) {
                $q->where('tahun_ajar', $tahunAjar);
            })
            ->get();

        $psas = Penilaian::with([
            'mapel',
            'kelas',
            'guru'
        ])
            ->where('tipe_sumatif', 'PSAS')
            ->where('semester', $semester)
            ->whereHas('kelas', function ($q) use ($tahunAjar) {
                $q->where('tahun_ajar', $tahunAjar);
            })
            ->get();

        $tahunAjarList = TahunAjar::orderByDesc('tahun_mulai')
            ->pluck('tahun_ajar');

        $activeTab = $request->tab ?? 'formatif';

        return view('admin.penilaian.index', compact(
            'semester',
            'tahunAjar',
            'tahunAjarList',
            'formatifSumatif',
            'psts',
            'psas',
            'activeTab'
        ));
    }

    public function create()
    {
        $tahunAjarAktif = TahunAjar::where('status', 'aktif')->first();
        $mapel = Mapel::with('guru')
            ->when($tahunAjarAktif, function ($q) use ($tahunAjarAktif) {
                $q->where('id_tahun_ajar', $tahunAjarAktif->id_tahun_ajar);
            })
            ->get();
        $kelas = Kelas::when($tahunAjarAktif, function ($q) use ($tahunAjarAktif) {
            $q->where('id_tahun_ajar', $tahunAjarAktif->id_tahun_ajar);
        })
            ->get();
        $gurus = Guru::select('id_guru', 'nama_guru')
            ->orderBy('nama_guru')
            ->get();

        $guruMapel = GuruMapel::all();
        $kelasMapel = KelasMapel::all();
        $tahunAjars = TahunAjar::orderBy('tahun_mulai', 'desc')->get();

        return view('admin.penilaian.create', compact('mapel', 'kelas', 'gurus', 'guruMapel', 'kelasMapel', 'tahunAjars', 'tahunAjarAktif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id_guru',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'semester' => 'required',
            'jenis_penilaian' => 'required|in:formatif,sumatif',
            'tipe_sumatif' => 'required|in:PSTS,PSAS',
            'bab_ke' => 'nullable|integer',
            'judul_bab' => 'nullable|string|max:150',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'id_tahun_ajar' => 'required|exists:tahun_ajar,id_tahun_ajar',
        ]);

        Penilaian::create([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'semester' => $request->semester,
            'jenis_penilaian' => $request->jenis_penilaian,
            'tipe_sumatif' => $request->tipe_sumatif,
            'bab_ke' => null,
            'judul_bab' => $request->judul_bab,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_buka' => 'dibuka',
            'status_approval' => 'draft',
            'dibuka_oleh' => auth('guru')->id(),
            'id_tahun_ajar' => $request->id_tahun_ajar,
        ]);

        return redirect()->route('admin.penilaian.index', [
            'tab' => strtolower($request->tipe_sumatif)
        ])->with('success', 'Penilaian berhasil dibuka.');
    }

    public function show($id)
    {
        $pembukaan = Penilaian::with(['mapel', 'kelas', 'guru'])->findOrFail($id);

        if ($pembukaan->jenis_penilaian === 'formatif') {
            $nilai = NilaiFormatif::with('siswa')
                ->where('id_penilaian', $id)
                ->get();
        } else if ($pembukaan->jenis_penilaian === 'sumatif' && $pembukaan->tipe_sumatif === null) {
            $nilai = NilaiSumatif::with(['siswa', 'tugas'])
                ->where('id_penilaian', $id)
                ->get();
        } else {
            if ($pembukaan->tipe_sumatif) {
                $nilai = SumatifUjian::with('siswa')
                    ->where('id_penilaian', $id)
                    ->get();
            } else {
                $nilai = NilaiSumatif::with(['siswa', 'tugas'])
                    ->where('id_penilaian', $id)
                    ->get();
            }
        }

        return view('admin.penilaian.show', compact('pembukaan', 'nilai'));
    }

    public function edit($id)
    {
        $pembukaan = Penilaian::findOrFail($id);
        $mapel = Mapel::with('guru')->get();
        $kelas = Kelas::all();
        $gurus = Guru::select('id_guru', 'nama_guru')
            ->orderBy('nama_guru')
            ->get();
        return view('admin.penilaian.create', compact('mapel', 'kelas', 'gurus', 'pembukaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id_guru',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'semester' => 'required',
            'jenis_penilaian' => 'required|in:formatif,sumatif',
            'bab_ke' => 'nullable|integer',
            'judul_bab' => 'nullable|string|max:150',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $data = Penilaian::findOrFail($id);
        $data->update([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'semester' => $request->semester,
            'jenis_penilaian' => $request->jenis_penilaian,
            'bab_ke' => $request->bab_ke,
            'judul_bab' => $request->judul_bab,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = Penilaian::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

    public function approve($id)
    {
        $data = Penilaian::findOrFail($id);
        $data->update([
            'status_approval' => 'disetujui',
            'approved_oleh' => auth('guru')->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Penilaian berhasil di-Approve!');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $data = Penilaian::findOrFail($id);
        $data->update([
            'status_approval' => 'ditolak',
            'approved_oleh' => auth('guru')->id(),
            'approved_at' => now(),
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Data berhasil ditolak.');
    }

    public function publish($id)
    {
        $data = Penilaian::findOrFail($id);

        $data->update([
            'status_approval' => 'publish',
        ]);

        return back()->with(
            'success',
            'Nilai berhasil dipublikasikan.'
        );
    }

    public function bukapenilaian(Request $request)
    {

        $request->validate([
            'semester' => 'required',
            'penilaian' => 'required|array'
        ]);

        foreach ($request->penilaian as $item) {

            [$kelas, $mapel] = explode('|', $item);

            Penilaian::where('id_kelas', $kelas)
                ->where('id_mapel', $mapel)
                ->where('semester', $request->semester)
                ->whereIn('jenis_penilaian', [
                    'formatif',
                    'sumatif'
                ])
                ->update([
                    'status_buka' => 'dibuka'
                ]);
        }

        return back()->with(
            'success',
            'Penilaian berhasil dibuka.'
        );
    }

    public function tutuppenilain(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'penilaian' => 'required|array'
        ]);

        foreach ($request->penilaian as $item) {

            [$kelas, $mapel] = explode('|', $item);

            Penilaian::where('id_kelas', $kelas)
                ->where('id_mapel', $mapel)
                ->where('semester', $request->semester)
                ->whereIn('jenis_penilaian', [
                    'formatif',
                    'sumatif'
                ])
                ->update([
                    'status_buka' => 'ditutup'
                ]);
        }

        return back()->with(
            'error',
            'Penilaian berhasil ditutup.'
        );
    }

    public function bukaKembali($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $penilaian->update([
            'status_buka' => 'dibuka',
        ]);

        return back()->with('success', 'Penilaian berhasil dibuka kembali.');
    }
}
