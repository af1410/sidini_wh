<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    public function index()
    {
        $tahunAjar = TahunAjar::orderBy('tahun_mulai', 'desc')->paginate(10);
        return view('admin.tahun_ajar.index', compact('tahunAjar'));
    }

    public function create()
    {
        return view('admin.tahun_ajar.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_ajar' => 'required|string|unique:tahun_ajar,tahun_ajar',
            'tahun_mulai' => 'required|integer|min:2000|max:2100',
            'tahun_selesai' => 'required|integer|min:2000|max:2100|gt:tahun_mulai',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        // Jika status aktif, nonaktifkan tahun ajar lainnya
        if ($data['status'] === 'aktif') {
            TahunAjar::where('status', 'aktif')->update(['status' => 'nonaktif']);
        }

        TahunAjar::create($data);

        return redirect()->route('admin.tahun_ajar.index')->with('success', 'Tahun ajar berhasil ditambahkan.');
    }

    public function edit(TahunAjar $tahunAjar)
    {
        return view('admin.tahun_ajar.edit', compact('tahunAjar'));
    }

    public function update(Request $request, TahunAjar $tahunAjar)
    {
        $data = $request->validate([
            'tahun_ajar' => 'required|string|unique:tahun_ajar,tahun_ajar,' . $tahunAjar->id_tahun_ajar . ',id_tahun_ajar',
            'tahun_mulai' => 'required|integer|min:2000|max:2100',
            'tahun_selesai' => 'required|integer|min:2000|max:2100|gt:tahun_mulai',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'keterangan' => 'nullable|string',
        ]);

        // Jika diubah menjadi aktif, nonaktifkan tahun ajar lainnya
        if ($data['status'] === 'aktif' && $tahunAjar->status !== 'aktif') {
            TahunAjar::where('status', 'aktif')->update(['status' => 'nonaktif']);
        }

        $tahunAjar->update($data);

        return redirect()->route('admin.tahun_ajar.index')->with('success', 'Tahun ajar berhasil diperbarui.');
    }

    public function destroy(TahunAjar $tahunAjar)
    {
        // Cegah penghapusan jika ada data kelas yang terkait
        if ($tahunAjar->kelas()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus tahun ajar yang masih memiliki kelas.');
        }

        $tahunAjar->delete();

        return redirect()->route('admin.tahun_ajar.index')->with('success', 'Tahun ajar berhasil dihapus.');
    }

    public function setAktif(TahunAjar $tahunAjar)
    {
        // Nonaktifkan tahun ajar lainnya
        TahunAjar::where('status', 'aktif')->update(['status' => 'nonaktif']);

        // Aktifkan tahun ajar yang dipilih
        $tahunAjar->update(['status' => 'aktif']);

        return back()->with('success', 'Tahun ajar berhasil diatur sebagai aktif.');
    }
}
