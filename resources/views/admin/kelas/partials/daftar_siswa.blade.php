<div class="card-body p-0">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="fw-semibold">
            Daftar Siswa
        </span>

        <span class="badge bg-success">
            Dipilih: <span id="selectedCount">0</span> siswa
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50" class="text-center">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th width="70">No</th>
                    <th>NIM</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                </tr>
            </thead>

            <tbody>
                @forelse($siswas as $siswa)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox"
                                class="form-check-input siswa-checkbox"
                                name="siswa[]"
                                value="{{ $siswa->id_siswa }}">
                        </td>

                        <td>
                            {{ $loop->iteration + ($siswas->firstItem() - 1) }}
                        </td>

                        <td>{{ $siswa->nim }}</td>

                        <td>{{ $siswa->nama_siswa }}</td>

                        <td>{{ $siswa->jenis_kelamin }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            Tidak ada data ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($siswas->count())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <div>
            {{ $siswas->links() }}
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.kelas.siswa', $kelas) }}"
                class="btn btn-secondary">
                <i class="bi bi-x-circle"></i>
                Batal
            </a>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i>
                Tambahkan ke Kelas
            </button>
        </div>
    </div>
@endif
