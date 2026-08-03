<?php

namespace App\Http\Controllers\Kepsek;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $data = Guru::when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_guru', 'like', "%{$keyword}%")
                    ->orWhere('nip', 'like', "%{$keyword}%")
                    ->orWhere('username', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        })
            ->when($request->filled('jabatan'), function ($query) use ($request) {
                $query->where('jabatan', $request->jabatan);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('nama_guru')
            ->paginate(20)
            ->withQueryString();

        return view('kepsek.guru.index', compact(
            'data',
            'keyword'
        ));
    }
}
