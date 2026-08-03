<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\SiswaKelas;
use App\Models\PerlengkapanRapor;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas', 'tahunAjar')->orderBy('tahun_ajar')->orderBy('kelas')->paginate(50);
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama_guru')->get();
        $tahunAjars = TahunAjar::orderBy('tahun_mulai', 'desc')->get();
        return view('admin.kelas.create', compact('gurus', 'tahunAjars'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_tahun_ajar' => 'required|exists:tahun_ajar,id_tahun_ajar',
            'kelas' => 'required|string|max:255',
            'rombel' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);

        // Ambil tahun ajar
        $tahunAjar = TahunAjar::find($data['id_tahun_ajar']);

        // Buat nama_kelas otomatis, contoh: "XI A"
        $data['nama_kelas'] = $data['kelas'] . ' ' . $data['rombel'];
        $data['tahun_ajar'] = $tahunAjar->tahun_ajar;

        // Ambil tahun ajar
        $tahunAjar = TahunAjar::findOrFail($data['id_tahun_ajar']);

        $data['nama_kelas'] = $data['kelas'] . ' ' . $data['rombel'];
        $data['tahun_ajar'] = $tahunAjar->tahun_ajar;

        // Prefix Kelas
        $prefixKelas = 'K';

        // X / XI / XII
        $prefixTingkat = strtoupper($request->kelas);

        // 2025-2026 -> 2526
        $tahun = str_replace(
            '-',
            '',
            substr($tahunAjar->tahun_ajar, 2, 2) .
                substr($tahunAjar->tahun_ajar, 7, 2)
        );

        // Prefix akhir
        $prefix = $prefixKelas . $prefixTingkat . $tahun;

        // Cari ID terakhir
        $lastKelas = Kelas::where('id_kelas', 'like', $prefix . '%')
            ->orderBy('id_kelas', 'desc')
            ->first();

        if ($lastKelas) {
            $lastNumber = (int) substr($lastKelas->id_kelas, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format 001
        $urutan = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Final ID
        $data['id_kelas'] = $prefix . $urutan;

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil disimpan.');
    }

    public function edit(Kelas $kelas)
    {
        $guru = Guru::orderBy('nama_guru')->get();
        $tahunAjars = TahunAjar::where('status', 'aktif')
            ->orderBy('tahun_mulai', 'desc')
            ->get();
        return view('admin.kelas.edit', compact('kelas', 'guru', 'tahunAjars'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $nama_kelas = $request->kelas . ' ' . $request->rombel;
        $data = $request->validate([
            'id_tahun_ajar' => 'nullable|exists:tahun_ajar,id_tahun_ajar',
            'kelas' => 'nullable|string|max:255',
            'nama_kelas' => $request->kelas . ' ' . $request->rombel,
            'rombel' => 'nullable|string|max:255',
            'id_guru' => 'nullable|exists:guru,id_guru',
        ]);

        $kelas->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }



    public function siswa(Kelas $kelas)
    {
        $siswas = Siswa::where('id_kelas', $kelas->id_kelas)
            ->orderBy('nama_siswa')
            ->paginate(20);

        return view('admin.kelas.siswa', compact('kelas', 'siswas'));
    }

    public function TambahSiswa(Request $request, Kelas $kelas)
    {
        $query = Siswa::whereNull('id_kelas');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_siswa', 'like', "%{$request->search}%")
                    ->orWhere('nim', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('angkatan')) {
            $query->whereYear('created_at', $request->angkatan);
        }

        $siswas = $query->orderBy('nama_siswa')
            ->paginate(20)
            ->withQueryString();

        $angkatanOptions = Siswa::selectRaw('YEAR(created_at) as angkatan')
            ->distinct()
            ->orderByDesc('angkatan')
            ->pluck('angkatan');

        if ($request->ajax()) {
            return view('admin.kelas.partials.daftar_siswa', compact('kelas', 'siswas'))->render();
        }

        return view('admin.kelas.tambah_siswa', compact(
            'kelas',
            'siswas',
            'angkatanOptions'
        ));
    }

    public function SimpanSiswa(Request $request, Kelas $kelas)
    {
        $request->validate([
            'siswa_dipilih' => 'required|json',
        ]);

        $tahunAjar = TahunAjar::where('status', 'aktif')->firstOrFail();

        $angkatan = $tahunAjar->tahun_mulai;

        $siswaIds = json_decode($request->siswa_dipilih, true);
        if (empty($siswaIds)) {
            return back()->withErrors([
                'selected_students' => 'Pilih minimal satu siswa.'
            ]);
        }

        $siswas = Siswa::whereIn('id_siswa', $siswaIds)->get();

        foreach ($siswas as $siswa) {

            // Update kelas aktif pada tabel siswa
            $siswa->id_kelas = $kelas->id_kelas;

            // Isi angkatan hanya sekali
            if (is_null($siswa->angkatan)) {
                $siswa->angkatan = $angkatan;
            }

            $siswa->save();

            // Riwayat kelas sebelumnya dianggap naik kelas
            SiswaKelas::where('id_siswa', $siswa->id_siswa)
                ->where('status', 'aktif')
                ->update([
                    'status' => 'naik_kelas'
                ]);

            // Simpan kelas baru
            SiswaKelas::updateOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_tahun_ajar' => $tahunAjar->id_tahun_ajar,
                ],
                [
                    'id_kelas' => $kelas->id_kelas,
                    'status' => 'aktif',
                ]
            );

            PerlengkapanRapor::firstOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_kelas' => $kelas->id_kelas,
                    'id_tahun_ajar' => $tahunAjar->id_tahun_ajar,
                ],
                [
                    'status_acc' => 'menunggu',
                ]
            );
        }

        return redirect()
            ->route('admin.kelas.siswa', $kelas)
            ->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }

    public function HapusSiswa(Kelas $kelas, Siswa $siswa)
    {
        $siswa->update([
            'id_kelas' => null
        ]);

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas.');
    }

    public function PindahSiswa(Kelas $kelas, Siswa $siswa)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('admin.kelas.pindah_siswa', compact(
            'kelas',
            'siswa',
            'kelasList'
        ));
    }

    public function UpdatePindahSiswa(Request $request, Kelas $kelas, Siswa $siswa)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas'
        ]);

        $tahunAjar = TahunAjar::where('status', 'aktif')->firstOrFail();

        // Update kelas pada tabel siswa
        $siswa->update([
            'id_kelas' => $request->id_kelas
        ]);

        // Update riwayat kelas yang aktif
        SiswaKelas::where('id_siswa', $siswa->id_siswa)
            ->where('id_tahun_ajar', $tahunAjar->id_tahun_ajar)
            ->where('status', 'aktif')
            ->update([
                'id_kelas' => $request->id_kelas
            ]);

        // Update kelas pada perlengkapan rapor
        PerlengkapanRapor::where('id_siswa', $siswa->id_siswa)
            ->where('id_tahun_ajar', $tahunAjar->id_tahun_ajar)
            ->update([
                'id_kelas' => $request->id_kelas
            ]);

        return redirect()
            ->route('admin.kelas.siswa', $request->id_kelas)
            ->with('success', 'Siswa berhasil dipindahkan.');
    }

    public function UpdatePindahSiswa1(Request $request, Kelas $kelas, Siswa $siswa)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas'
        ]);

        $siswa->update([
            'id_kelas' => $request->id_kelas
        ]);

        return redirect()
            ->route('admin.kelas.siswa', $request->id_kelas)
            ->with('success', 'Siswa berhasil dipindahkan.');
    }
}
