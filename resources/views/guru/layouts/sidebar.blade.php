<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
        <i class="bi bi-chevron-left"></i>
    </button>

    <ul class="nav flex-column">
        <li class="nav-section-title">MENU UTAMA</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('guru/dashboard') ? 'active' : '' }}"
                href="{{ route('guru.dashboard') }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>

        {{-- <li class="nav-section-title mt-3">MANAJEMEN SISWA</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-people"></i> <span>Daftar Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('guru/nilai*') ? 'active' : '' }}"
                href="{{ route('guru.nilai.index') }}">
                <i class="bi bi-file-earmark-text"></i> <span>Input Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('guru/presensi*') ? 'active' : '' }}"
                href="{{ route('guru.presensi.index') }}">
                <i class="bi bi-check-circle"></i> <span>Presensi Siswa</span>
            </a>
        </li> --}}


        @if (auth()->guard('guru')->user()->kelas->isNotEmpty())
            <li class="nav-section-title mt-3">MANAJEMEN KELAS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guru.kelas.*') && !request()->routeIs('guru.kelas.rapor.*') ? 'active' : '' }}"
                    href="{{ route('guru.kelas.index') }}">
                    <i class="bi bi-house"></i>
                    <span>Kelas</span>
                </a>
            </li>
        @endif
        @if (\App\Models\GuruMapel::where('id_guru', auth()->guard('guru')->user()->id_guru)->exists())
            <li class="nav-section-title mt-3">MANAJEMEN MATA PELAJARAN</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('guru/mapel_saya*') ? 'active' : '' }}"
                    href="{{ route('guru.mapel.index') }}">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Mapel</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('guru/nilai*') ? 'active' : '' }}"
                    href="{{ route('guru.nilai.index') }}">
                    <i class="bi bi-file-earmark-text"></i> <span>Penilaian</span>
                </a>
            </li>
        @endif
        {{-- <li class="nav-section-title mt-3">LAPORAN</li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="bi bi-bar-chart"></i> <span>Laporan Nilai</span>
            </a>
        </li> --}}
        @if (auth()->guard('guru')->user()->kelas->isNotEmpty())
            <li class="nav-section-title mt-3">LAPORAN</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('guru.kelas.rapor.*') ? ' active' : '' }}"
                    href="{{ route('guru.kelas.rapor.index') }}">
                    <i class="bi bi-file-pdf"></i> <span>Rapor Siswa</span>
                </a>
            </li>
        @endif

        <li class="nav-section-title mt-3">DATA PRIBADI</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('guru/profile*') ? ' active' : '' }}"
                href="{{ route('guru.profile.index') }}">
                <i class="bi bi-person"></i> <span>Profile</span>
            </a>
        </li>
    </ul>
</div>
