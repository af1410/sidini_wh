<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index1()
    {
        $gurus = Guru::orderBy('nama_guru')->paginate(50);
        return view('admin.guru.index', compact('gurus'));
    }

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

        return view('admin.guru.index', compact(
            'data',
            'keyword'
        ));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|string|unique:guru,nip',
            'nik' => 'required|string|unique:guru,nik',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:guru,email',
            'jabatan' => 'required|in:guru,admin,kepala_sekolah',
            'pendidikan' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Auto-generate username dan password dari NIP
        $data['username'] = explode('@', $data['email'])[0];
        $data['password'] = bcrypt(Carbon::parse($data['tanggal_lahir'])->format('dmY'));

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil disimpan. Username dan password otomatis dari NIP.');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nip' => 'required|string|unique:guru,nip,' . $guru->id_guru . ',id_guru',
            'nik' => 'required|string|unique:guru,nik,' . $guru->id_guru . ',id_guru',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:guru,email,' . $guru->id_guru . ',id_guru',
            'password' => 'sometimes|string|min:6|confirmed',
            'jabatan' => 'required|in:guru,admin,kepala_sekolah',
            'pendidikan' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif',
        ]);



        $data['username'] = explode('@', $data['email'])[0];

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function resetPassword(Guru $guru)
    {
        if (!$guru->nip) {
            return back()->with('error', 'Guru tidak memiliki NIP, password tidak bisa direset.');
        }

        $guru->update([
            'password' => Hash::make(Carbon::parse($guru->tanggal_lahir)->format('dmY')),
        ]);

        return back()->with('success', 'Password guru berhasil direset menjadi NIP.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }

    public function updateStatus(Request $request, Guru $guru)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $guru->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Status guru berhasil diperbarui.');
    }

    public function bulkStatus(Request $request)
    {
        $request->validate([
            'guru' => 'required|array',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Guru::whereIn('id_guru', $request->guru)
            ->update([
                'status' => $request->status,
            ]);

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'success',
                count($request->guru) . ' guru berhasil diperbarui.'
            );
    }
}
