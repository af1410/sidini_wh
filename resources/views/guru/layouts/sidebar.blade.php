<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
        <i class="bi bi-chevron-left"></i>
    </button>
    <ul class="nav flex-column">
        <li class="nav-section-title">MENU UTAMA</li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">MANAJEMEN SISWA</li>
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
        </li>

        <li class="nav-section-title mt-3">MANAJEMEN KELAS</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-calendar2-week"></i> <span>Jadwal Mengajar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-book"></i> <span>Materi Pembelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-clipboard-check"></i> <span>Tugas & Ujian</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">LAPORAN</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-bar-chart"></i> <span>Laporan Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-file-pdf"></i> <span>Rapor Siswa</span>
            </a>
        </li>
    </ul>
</div>
