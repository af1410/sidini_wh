<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();
        $tanggal = now()->format('Y-m-d');
        $siswa = Siswa::with('dataKelas')->orderBy('nama_siswa')->get();

        $presensiHariIni = Presensi::whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('id_siswa');

        $hadirCount = $presensiHariIni->whereIn('status', ['Hadir', 'Terlambat'])->count();
        $terlambatCount = $presensiHariIni->where('status', 'Terlambat')->count();
        $izinCount = $presensiHariIni->where('status', 'Izin')->count();
        $sakitCount = $presensiHariIni->where('status', 'Sakit')->count();
        $alphaCount = $presensiHariIni->where('status', 'Alpha')->count();
        $belumCount = $siswa->count() - $presensiHariIni->count();

        return view('guru.presensi.index', compact(
            'guru',
            'siswa',
            'presensiHariIni',
            'tanggal',
            'hadirCount',
            'terlambatCount',
            'izinCount',
            'sakitCount',
            'alphaCount',
            'belumCount'
        ));
    }

    public function markStatus(Request $request, $id_siswa)
    {
        $request->validate([
            'status' => 'required|in:Alpha,Izin,Sakit',
        ]);

        $siswa = Siswa::findOrFail($id_siswa);
        $tanggal = now()->format('Y-m-d');

        $presensi = Presensi::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($presensi && in_array($presensi->status, ['Hadir', 'Terlambat'])) {
            return redirect()->route('guru.presensi.index')
                ->with('error', "Status tidak bisa diubah karena siswa {$siswa->nama_siswa} sudah hadir.");
        }

        if ($presensi) {
            $presensi->update([
                'status' => $request->status,
                'waktu_masuk' => null,
            ]);
        } else {
            Presensi::create([
                'id_siswa' => $siswa->id_siswa,
                'tanggal' => $tanggal,
                'waktu_masuk' => null,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('guru.presensi.index')
            ->with('success', "Status siswa {$siswa->nama_siswa} berhasil diperbarui menjadi {$request->status}.");
    }
}
