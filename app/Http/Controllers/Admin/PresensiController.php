<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('guru')->user();
        $tanggal = now()->format('Y-m-d');
        $siswa = Siswa::with('dataKelas')->orderBy('nama_siswa')->get();
        $presensiHariIni = Presensi::whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('id_siswa');

        return view('admin.presensi.index', compact('admin', 'siswa', 'presensiHariIni', 'tanggal'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            'uid_kartu' => 'required|string',
        ]);

        $uid = trim($request->input('uid_kartu'));

        $siswa = Siswa::where('uid_kartu', $uid)
            ->orWhere('nim', $uid)
            ->first();

        if (! $siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Kartu tidak dikenali. Periksa UID kartu siswa.',
            ], 404);
        }

        $tanggal = now()->format('Y-m-d');
        $presensi = Presensi::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($presensi) {
            return response()->json([
                'success' => false,
                'message' => "Siswa {$siswa->nama_siswa} sudah terdaftar hadir pada {$presensi->waktu_masuk}.",
                'already_present' => true,
                'data' => [
                    'id_siswa' => $siswa->id_siswa,
                    'nama_siswa' => $siswa->nama_siswa,
                    'kelas' => $siswa->dataKelas->nama_kelas ?? '-',
                    'status' => $presensi->status,
                    'waktu_masuk' => $presensi->waktu_masuk,
                ],
            ], 200);
        }

        $currentTime = now();
        $status = $currentTime->greaterThan($currentTime->copy()->setTime(7, 0, 0)) ? 'Terlambat' : 'Hadir';

        $hadir = Presensi::create([
            'id_siswa' => $siswa->id_siswa,
            'tanggal' => $tanggal,
            'waktu_masuk' => $currentTime->format('H:i:s'),
            'status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Siswa {$siswa->nama_siswa} berhasil dicatat hadir.",
            'data' => [
                'id_siswa' => $siswa->id_siswa,
                'nama_siswa' => $siswa->nama_siswa,
                'kelas' => $siswa->dataKelas->nama_kelas ?? '-',
                'status' => $hadir->status,
                'waktu_masuk' => $hadir->waktu_masuk,
            ],
        ]);
    }
}
