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
                <i class="bi bi-file-earmark"></i> <span>Detail Nilai</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/presensi*') ? 'active' : '' }}"
                href="{{ route('siswa.presensi.index') }}">
                <i class="bi bi-check-circle"></i> <span>Presensi</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/raporsaya*') ? 'active' : '' }}"
                href="{{ route('siswa.raporsaya.index') }}">
                <i class="bi bi-journal-check"></i> <span>Rapor</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">DATA PRIBADI</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('siswa/profile*') ? ' active' : '' }}"
                href="{{ route('siswa.profile.index') }}">
                <i class="bi bi-person"></i> <span>Profile</span>
            </a>
        </li>
    </ul>
</div>
