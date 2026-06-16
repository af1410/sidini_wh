<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
        <i class="bi bi-chevron-left"></i>
    </button>
    <ul class="nav flex-column">
        <li class="nav-section-title">MENU UTAMA</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}"
                href="{{ route('siswa.dashboard') }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">AKADEMIK</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/nilai*') ? 'active' : '' }}"
                href="{{ route('siswa.nilai.index') }}">
                <i class="bi bi-file-earmark"></i> <span>Nilai Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/presensi*') ? 'active' : '' }}"
                href="{{ route('siswa.presensi.index') }}">
                <i class="bi bi-check-circle"></i> <span>Presensi Saya</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-calendar2-week"></i> <span>Jadwal Pelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-book"></i> <span>Tugas</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">KOMUNIKASI</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-chat-dots"></i> <span>Pesan dari Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-megaphone"></i> <span>Pengumuman</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">TAMBAHAN</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-file-pdf"></i> <span>Download Rapor</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-award"></i> <span>Prestasi</span>
            </a>
        </li>
    </ul>
</div>
