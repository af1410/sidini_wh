<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapor {{ $siswa->nama_siswa }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">


    <style>
        @page {
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 11px;
            color: #000;
        }

        * {
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
        }

        .logo {
            width: 70px;
        }

        .school {
            text-align: center;
        }

        .school h2,
        .school h3,
        .school p {
            margin: 0;
        }

        .school h2 {
            font-size: 20px;
        }

        .school h3 {
            font-size: 16px;
        }

        .school p {
            font-size: 12px;
        }

        .divider {
            border-bottom: 2px solid #000;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .student-info td {
            border: none;
            padding: 2px;
            vertical-align: top;
        }

        .title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin: 15px 0;
        }

        .nilai-table th,
        .nilai-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .nilai-table th {
            text-align: center;
            font-weight: bold;
        }

        .group-row td {
            background: #f2f2f2;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .page-break {
            page-break-before: always;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .box {
            border: 1px solid #000;
            padding: 8px;
        }

        .signature-wrapper {
            margin-top: 30px;
        }

        .signature-left {
            width: 45%;
            float: left;
            text-align: center;
        }

        .signature-right {
            width: 45%;
            float: right;
            text-align: center;
        }

        .sign-space {
            height: 80px;
        }

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }

        .small {
            font-size: 10px;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td width="15%">
                <img src="{{ asset('img/kemenag.png') }}" class="logo">
            </td>

            <td width="70%" class="school">
                <h3>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h3>
                <h2>MAS WASILATUL HUDA</h2>
                <p>JL. IR. H. JUANDA NO. 6</p>
                <p>Kecamatan Cicalengka, Kabupaten Bandung - Jawa Barat</p>
            </td>

            <td width="15%"></td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- IDENTITAS SISWA --}}
    <table class="student-info">
        <tr>
            <td width="15%">Nama</td>
            <td width="35%">: {{ $siswa->nama_siswa }}</td>

            <td width="15%">Kelas</td>
            <td width="35%">: {{ $kelas->nama_kelas }}</td>
        </tr>

        <tr>
            <td>NIS/NISN</td>
            <td>: {{ $siswa->nim ?? '-' }}/{{ $siswa->nisn ?? '-' }}</td>

            <td>Semester</td>
            <td>: {{ $semester ?? 'Ganjil' }}</td>
            {{-- <td>Fase</td>
            <td>: {{ $kelas->fase ?? '-' }}</td> --}}
        </tr>

        <tr>
            <td>Madrasah</td>
            <td>: MAS WASILATUL HUDA</td>

            <td>Tahun Ajaran</td>
            <td>: {{ $kelas->tahun_ajar }}</td>
            {{-- <td>Semester</td>
            <td>: {{ $semester ?? 'Ganjil' }}</td> --}}
        </tr>

        <tr>
            <td>Alamat</td>
            <td>: {{ $siswa->alamat }}</td>

            {{-- <td>Tahun Ajaran</td>
            <td>: {{ $kelas->tahun_ajar }}</td> --}}
        </tr>
    </table>

    {{-- JUDUL --}}
    <div class="title">
        CAPAIAN HASIL BELAJAR
    </div>

    {{-- TABEL NILAI --}}
    <table class="nilai-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Mata Pelajaran</th>
                <th width="10%">Nilai Akhir</th>
                <th>Capaian Kompetensi</th>
            </tr>
        </thead>

        <tbody>

            {{-- UMUM --}}
            <tr class="group-row">
                <td colspan="4">
                    Kelompok Mata Pelajaran Umum
                </td>
            </tr>

            @php
                $no = 1;
            @endphp

            @foreach ($mapelUmum as $mapel)
                <tr>
                    <td class="center">{{ $no++ }}</td>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td class="center">{{ $mapel->nilai_akhir }}</td>
                    <td>{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @endforeach

            {{-- PILIHAN --}}
            <tr class="group-row">
                <td colspan="4">
                    Kelompok Mata Pelajaran Pilihan
                </td>
            </tr>

            @php
                $no = 1;
            @endphp

            @foreach ($mapelPilihan as $mapel)
                <tr>
                    <td class="center">{{ $no++ }}</td>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td class="center">{{ $mapel->nilai_akhir }}</td>
                    <td>{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @endforeach

            {{-- VOKASI --}}
            <tr class="group-row">
                <td colspan="4">
                    Kelompok Mata Pelajaran Vokasi/Keterampilan
                </td>
            </tr>

            @php
                $no = 1;
            @endphp

            @foreach ($mapelVokasi as $mapel)
                <tr>
                    <td class="center">{{ $no++ }}</td>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td class="center">{{ $mapel->nilai_akhir }}</td>
                    <td>{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" class="right">
                    <b>Jumlah</b>
                </td>
                <td class="center">
                    <b>{{ $totalNilai ?? 0 }}</b>
                </td>
                <td></td>
            </tr>

        </tbody>
    </table>

    {{-- HALAMAN 2 --}}
    <div class="page-break"></div>

    {{-- KOKURIKULER --}}
    <div class="section-title">
        Kokurikuler
    </div>

    <div class="box">
        {{ $kokurikuler ?? '-' }}
    </div>

    {{-- EKSTRAKURIKULER --}}
    <div class="section-title">
        Ekstrakurikuler
    </div>

    <table class="nilai-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Kegiatan Ekstrakurikuler</th>
                <th width="20%">Nilai</th>
                <th width="35%">Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse($ekstrakurikuler as $i => $item)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="center">{{ $item->nilai }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="center">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PRESTASI --}}
    <div class="section-title">
        Prestasi
    </div>

    <table class="nilai-table">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Jenis Prestasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse($prestasi as $i => $item)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $item->nama_prestasi }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td>1</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- KETIDAKHADIRAN --}}
    <div class="section-title">
        Ketidakhadiran
    </div>

    <table class="nilai-table">
        <tr>
            <td width="50%">Sakit</td>
            <td>{{ $sakit ?? 0 }} Hari</td>
        </tr>
        <tr>
            <td>Izin</td>
            <td>{{ $izin ?? 0 }} Hari</td>
        </tr>
        <tr>
            <td>Alpa</td>
            <td>{{ $alpa ?? 0 }} Hari</td>
        </tr>
    </table>

    {{-- CATATAN WALI --}}
    <div class="section-title">
        Catatan Wali Kelas
    </div>

    <div class="box" style="height:80px;">
        {{ $catatan_wali ?? '-' }}
    </div>

    {{-- TANGGAPAN ORTU --}}
    <div class="section-title">
        Tanggapan Orang Tua/Wali
    </div>

    <div class="box" style="height:90px;"></div>

    {{-- TTD --}}
    <div class="signature-wrapper clearfix">

        <div class="signature-left">
            Orang Tua/Wali

            <div class="sign-space"></div>

            ______________________
        </div>

        <div class="signature-right">
            Kabupaten Bandung,
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br>
            Wali Kelas

            <div class="sign-space"></div>

            <b>
                {{ optional($kelas->waliKelas)->nama_guru }}
            </b>
        </div>

    </div>

    <div class="clearfix"></div>

    <br><br>

    <div style="text-align:center">
        Mengetahui,
        <br>
        Kepala Madrasah

        <div class="sign-space"></div>

        <b>{{ $kepalaMadrasah ?? 'KEPALA MADRASAH' }}</b>
    </div>

</body>

</html>
