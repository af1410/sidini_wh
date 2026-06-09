<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalNilaiController extends Controller
{
    public function index()
    {
        $data = Penilaian::with([
            'guru',
            'mapel',
            'kelas'
        ])
            ->where('status_approval', 'menunggu_approval')
            ->latest()
            ->paginate(10);

        return view(
            'admin.approval.index',
            compact('data')
        );
    }

    public function approve($id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $penilaian->update([
            'status_approval' => 'disetujui',
            'approved_oleh'   => Auth::guard('guru')->user()->id_guru,
            'approved_at'     => now(),
        ]);

        return back()->with(
            'success',
            'Permintaan berhasil disetujui.'
        );
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:500'
        ]);

        $penilaian = Penilaian::findOrFail($id);

        $penilaian->update([
            'status_approval' => 'ditolak',
            'approved_oleh'   => Auth::guard('guru')->user()->id_guru,
            'approved_at'     => now(),
            'catatan'         => $request->catatan
        ]);

        return back()->with(
            'success',
            'Permintaan berhasil ditolak.'
        );
    }
}
