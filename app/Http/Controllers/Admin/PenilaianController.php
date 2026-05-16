<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use App\Models\NilaiFormatif;
use App\Models\NilaiSumatif;
use App\Models\NilaiSumatifTugas;
use App\Models\NilaiAkhir;
use Illuminate\Support\Facades\DB;


class PenilaianController extends Controller
{
    public function index()
    {
        $data = Penilaian::with(['mapel', 'kelas', 'guru'])
            ->withCount(['nilaiFormatif', 'nilaiSumatif'])
            ->latest()
            ->get();

        return view('admin.penilaian.index', compact('data'));
    }

    public function create()
    {
        $mapel = Mapel::with('guru')->get();
        $kelas = Kelas::all();
        $gurus = Guru::select('id_guru', 'nama_guru')
            ->orderBy('nama_guru')
            ->get();
        return view('admin.penilaian.create', compact('mapel', 'kelas', 'gurus'));
    }

    public function store(Request $request)
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

        Penilaian::create([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'semester' => $request->semester,
            'jenis_penilaian' => $request->jenis_penilaian,
            'bab_ke' => $request->bab_ke,
            'judul_bab' => $request->judul_bab,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_buka' => 'dibuka',
            'status_approval' => 'normal',
            'dibuka_oleh' => auth('guru')->id(),
        ]);

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dibuka.');
    }

    public function show($id)
    {
        $pembukaan = Penilaian::with(['mapel', 'kelas', 'guru'])->findOrFail($id);

        if ($pembukaan->jenis_penilaian === 'formatif') {
            $nilai = NilaiFormatif::with('siswa')
                ->where('id_penilaian', $id)
                ->get();
        } else {
            $nilai = NilaiSumatif::with(['siswa', 'tugas'])
                ->where('id_penilaian', $id)
                ->get();
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

        return back()->with('success', 'Data berhasil di-approve.');
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
}
