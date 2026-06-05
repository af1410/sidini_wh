    @extends('admin.layouts.app')

    @section('title', 'Kelola Siswa')

    @section('content')
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1">Kelola Siswa</h4>
                        <p class="text-muted mb-0">Menampilkan <strong>{{ $siswa->count() }}</strong> siswa dari
                            <strong>{{ $totalCount }}</strong> total.
                        </p>
                    </div>
                    <a href="{{ route('admin.siswa.create') }}" class="btn btn-success">+ Tambah Siswa</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Filter Data</h5>
                        <small class="text-muted">Gunakan filter untuk mempersempit daftar siswa.</small>
                    </div>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-sm btn-outline-secondary">Reset Semua</a>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.siswa.index') }}" class="row gy-3 gx-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelasOptions as $kelas)
                                    <option value="{{ $kelas->id_kelas }}"
                                        {{ request('kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                            <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Bersihkan</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>UID Kartu</th>
                                <th>Angkatan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->nama_siswa }}</td>
                                    <td>{{ $item->dataKelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $item->uid_kartu ?? '-' }}</td>
                                    <td>{{ $item->angkatan ?? '-' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.siswa.edit', $item->id_siswa) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus siswa ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada siswa ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small>Menampilkan halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}</small>
                    <div>{{ $siswa->links() }}</div>
                </div>
            </div>
        </div>
    @endsection
