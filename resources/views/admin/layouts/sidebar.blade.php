<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
        <i class="bi bi-chevron-left"></i>
    </button>
    <ul class="nav flex-column">
        <li class="nav-section-title">MENU UTAMA</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}"
                href="{{ route('admin.profile.index') }}">
                <i class="bi bi-person"></i> <span>Profile</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">MANAJEMEN DATA</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/siswa*') ? 'active' : '' }}"
                href="{{ route('admin.siswa.index') }}">
                <i class="bi bi-people"></i> <span>Kelola Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/guru*') ? 'active' : '' }}"
                href="{{ route('admin.guru.index') }}">
                <i class="bi bi-person-badge"></i> <span>Kelola Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/kelas*') ? 'active' : '' }}"
                href="{{ route('admin.kelas.index') }}">
                <i class="bi bi-house"></i> <span>Kelola Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/mapel*') ? 'active' : '' }}"
                href="{{ route('admin.mapel.index') }}">
                <i class="bi bi-book"></i> <span>Kelola Mata Pelajaran</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">AKADEMIK</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-calendar2-week"></i> <span>Jadwal Pelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/presensi*') ? 'active' : '' }}"
                href="{{ route('admin.presensi.index') }}">
                <i class="bi bi-check-circle"></i> <span>Presensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/penilaian*') ? 'active' : '' }}"
                href="{{ route('admin.penilaian.index') }}">
                <i class="bi bi-file-earmark-text"></i> <span>Penilaian</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">LAPORAN</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-bar-chart"></i> <span>Laporan Akademik</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-file-pdf"></i> <span>Export Data</span>
            </a>
        </li>
    </ul>
</div>
