<div class="mb-3">
    <table class="table table-borderless">
        <tr>
            <th width="180">NIM</th>
            <td>{{ $siswa->nim }}</td>
        </tr>
        <tr>
            <th>Nama Siswa</th>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $kelas->nama_kelas }}</td>
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                @foreach ($semuaBab as $bab)
                    <th>Bab {{ $bab }}</th>
                @endforeach
                <th>Rata-rata Bab</th>
                <th>PSTS</th>
                <th>PSAS</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataMapel as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['mapel']->nama_mapel }}</td>
                    @foreach ($semuaBab as $bab)
                        <td class="text-center">
                            {{ number_format($item['detail_bab'][$bab] ?? 0, 2) }}
                        </td>
                    @endforeach
                    <td>{{ number_format($item['rata_bab'], 2) }}</td>
                    <td>{{ number_format($item['psts'], 2) }}</td>
                    <td>{{ number_format($item['psas'], 2) }}</td>
                    <td class="fw-bold">
                        {{ number_format($item['nilai_akhir'], 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
