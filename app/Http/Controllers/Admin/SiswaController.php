<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelasOptions = Kelas::all();

        $angkatanOptions = Siswa::query()
            ->whereNotNull('angkatan')
            ->where('angkatan', '<>', '')
            ->distinct()
            ->orderBy('angkatan')
            ->pluck('angkatan');

        $query = Siswa::with('dataKelas');

        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        $siswa = $query->orderBy('nama_siswa')
            ->paginate(50)
            ->withQueryString();

        $totalCount = Siswa::count();
        $selectedCount = $siswa->total();

        return view('admin.siswa.index', compact(
            'siswa',
            'kelasOptions',
            'angkatanOptions',
            'totalCount',
            'selectedCount'
        ));
    }

    public function create()
    {
        $kelasOptions = Kelas::all();
        $angkatanOptions = Kelas::pluck('tahun_ajar')
            ->map(function ($item) {
                return substr($item, -4);
            })
            ->unique()
            ->values()
            ->toArray();

        return view('admin.siswa.create', compact('kelasOptions', 'angkatanOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:siswa,nim',
            'nik' => 'required|string|unique:siswa,nik',
            'nama_siswa' => 'required|string|max:255',
            'jenim_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:siswa,email',
            'username' => 'nullable|string|unique:siswa,username',
            'uid_kartu' => 'nullable|string|unique:siswa,uid_kartu',
            'password' => 'nullable|string|min:6|confirmed',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'angkatan' => 'nullable|string|max:100',
        ]);

        // Jika username kosong, isi dengan NIS
        $data['username'] = $data['username'] ?? $data['nim'];

        // Jika password kosong, isi dengan NIS lalu hash
        $data['password'] = !empty($data['password'])
            ? bcrypt($data['password'])
            : bcrypt($data['nim']);
        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelasOptions = Kelas::all();
        $angkatanOptions = Kelas::pluck('tahun_ajar')
            ->map(function ($item) {
                return substr($item, -4);
            })
            ->unique()
            ->values()
            ->toArray();

        return view('admin.siswa.edit', compact('siswa', 'kelasOptions', 'angkatanOptions'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:siswa,nim,' . $siswa->id_siswa . ',id_siswa',
            'nik' => 'required|string|unique:siswa,nik,' . $siswa->id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:255',
            'jenim_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:siswa,email,' . $siswa->id_siswa . ',id_siswa',
            'username' => 'required|string|unique:siswa,username,' . $siswa->id_siswa . ',id_siswa',
            'uid_kartu' => 'nullable|string|unique:siswa,uid_kartu,' . $siswa->id_siswa . ',id_siswa',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
            'password' => 'nullable|string|min:6|confirmed',
            'angkatan' => 'nullable|string|max:100',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
