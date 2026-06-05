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


        $query = Siswa::with('dataKelas');

        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        $siswa = $query->orderBy('nama_siswa')
            ->paginate(50)
            ->withQueryString();

        $totalCount = Siswa::count();
        $selectedCount = $siswa->total();

        return view('admin.siswa.index', compact(
            'siswa',
            'kelasOptions',
            'totalCount',
            'selectedCount'
        ));
    }

    public function create()
    {
        $kelasOptions = Kelas::all();


        return view('admin.siswa.create', compact('kelasOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:siswa,nim',
            'nik' => 'required|string|unique:siswa,nik',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:siswa,email',
            'uid_kartu' => 'nullable|string|unique:siswa,uid_kartu',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        // Auto-generate username dari NIM
        $data['username'] = $data['nim'];

        // Auto-generate password dari NIM
        $data['password'] = bcrypt($data['nim']);

        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan. Username dan password otomatis dari NIM.');
    }

    public function edit(Siswa $siswa)
    {
        $kelasOptions = Kelas::all();


        return view('admin.siswa.edit', compact('siswa', 'kelasOptions'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:siswa,nim,' . $siswa->id_siswa . ',id_siswa',
            'nik' => 'required|string|unique:siswa,nik,' . $siswa->id_siswa . ',id_siswa',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:25',
            'email' => 'required|email|unique:siswa,email,' . $siswa->id_siswa . ',id_siswa',
            'uid_kartu' => 'nullable|string|unique:siswa,uid_kartu,' . $siswa->id_siswa . ',id_siswa',
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        // Auto-generate username dari NIM
        $data['username'] = $data['nim'];

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
