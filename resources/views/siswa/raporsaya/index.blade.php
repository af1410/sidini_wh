<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapor {{ $siswa->nama_siswa }}</title>


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
                <img src="{{ public_path('img/kemenag.png') }}" class="logo">
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


            <td>Fase</td>
            <td>: F</td>
        </tr>

        <tr>
            <td>Madrasah</td>
            <td>: MAS WASILATUL HUDA</td>

            <td>Semester</td>
            <td>: {{ $semester ?? 'Ganjil' }}</td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>: {{ $siswa->alamat }}</td>

            <td>Tahun Ajaran</td>
            <td>: {{ $kelas->tahunAjar->tahun_ajar }}</td>
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
                    <td class="center">{{ round($mapel->nilai_akhir) }}</td>
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
                    <td class="center">{{ round($mapel->nilai_akhir) }}</td>
                    <td>{{ $mapel->deskripsi ?? '-' }}</td>
                </tr>
            @endforeach


            <tr>
                <td colspan="2" class="right">
                    <b>Jumlah</b>
                </td>
                <td class="center">
                    <b>{{ round($totalNilai) ?? 0 }}</b>
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

    <div class="box" style="text-align: justify; line-height: 1.5;">
        Siswa sangat baik dalam menunjukkan kecintaan kepada Allah SWT dan Rasulullah SAW melalui akhlak terpuji,
        keteladanan sikap, dan pengamalan ajaran Islam dalam kehidupan sehari-hari. Sangat baik dalam menunjukkan sikap
        iman dan takwa yang baik melalui kedisiplinan pribadi, adab keseharian, serta pengamalan nilai-nilai keislaman
        dalam setiap kegiatan. Dan sangat baik dalam mampu memahami permasalahan kegiatan dengan baik serta menyampaikan
        pendapat dan solusi secara logis, santun, dan bertanggung jawab.
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
            @forelse(optional($perlengkapanRapor)->ekskul ?? [] as $i => $item)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $item->nama_ekskul }}</td>
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
            @forelse(optional($perlengkapanRapor)->prestasi ?? [] as $i => $item)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ $item->prestasi }}</td>
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
            <td>{{ $perlengkapanRapor->sakit ?? 0 }} Hari</td>
        </tr>
        <tr>
            <td>Izin</td>
            <td>{{ $perlengkapanRapor->izin ?? 0 }} Hari</td>
        </tr>
        <tr>
            <td>Alpa</td>
            <td>{{ $perlengkapanRapor->alpa ?? 0 }} Hari</td>
        </tr>
    </table>

    {{-- CATATAN WALI --}}
    <div class="section-title">
        Catatan Wali Kelas
    </div>

    <div class="box" style="height:80px;">
        {{ $perlengkapanRapor->catatan_wali_kelas ?? '-' }}
    </div>

    {{-- TANGGAPAN ORTU --}}
    <div class="section-title">
        Tanggapan Orang Tua/Wali
    </div>

    <div class="box" style="height:90px;"></div>

    {{-- TTD --}}
    <div class="signature-wrapper clearfix">

        {{-- Orang Tua --}}
        <div class="signature-left">
            Orang Tua/Wali

            <div class="sign-space"></div>

            ______________________
        </div>

        {{-- Wali Kelas --}}
        <div class="signature-right">
            Kabupaten Bandung,
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <br>
            Wali Kelas

            <div class="sign-space" style="position:relative;">

                @if (!empty($waliKelas?->ttd))
                    <img src="{{ public_path('storage/' . $waliKelas->ttd) }}"
                        style="position:absolute;
                       width:80px;
                       left:48%;
                       transform:translateX(-50%);
                       top:5px;">
                @else
                    <div style="height:70px"></div>
                @endif
            </div>
            <b>{{ $waliKelas?->nama_guru }}</b><br>
            NIP. {{ $waliKelas?->nip ?? '-' }}
        </div>

    </div>

    <div class="clearfix"></div>

    <br><br>
    <div style="text-align:center">
        Mengetahui,
        <br>
        Kepala Madrasah

        <div class="sign-space" style="position:relative;">

            @if (optional($perlengkapanRapor)->status_acc == 'disetujui')
                <img src="{{ public_path('img/cap_sekolah.png') }}"
                    style="position:absolute;
                       opacity: 75%;
                       width:250px;
                       left:42%;
                       transform:translateX(-50%);
                       top:-25px;">

                <img src="{{ public_path('img/ttd_kepsek.png') }}"
                    style="position:absolute;
                       width:120px;
                       left:48%;
                       transform:translateX(-50%);
                       top:5px;">
            @endif

        </div>

        @if (optional($perlengkapanRapor)->status_acc == 'disetujui')

            <b>{{ optional($perlengkapanRapor->approver)->nama_guru }}</b>

            @if (optional($perlengkapanRapor->approver)->nip)
                <br>
                NIP. {{ $perlengkapanRapor->approver->nip }}
            @endif

        @endif

    </div>
</body>

</html>
