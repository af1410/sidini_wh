<div class="sidebar" id="sidebar">
    <button class="sidebar-toggle" id="sidebarToggleBtn" title="Toggle Sidebar">
        <i class="bi bi-chevron-left"></i>
    </button>

    <ul class="nav flex-column">
        <li class="nav-section-title">MENU UTAMA</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('kepsek/dashboard') ? 'active' : '' }}" href="{{ route('kepsek.dashboard') }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">MONITORING AKADEMIK</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('kepsek/guru*') ? 'active' : '' }}" href="{{ route('kepsek.guru.index') }}">
                <i class="bi bi-person-badge"></i> <span>Data Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('kepsek/kelas*') ? 'active' : '' }}" href="{{ route('kepsek.kelas.index') }}">
                <i class="bi bi-house"></i> <span>Data Kelas</span>
            </a>
        </li>

        <li class="nav-section-title mt-3">Data Pribadi</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('kepsek/profile*') ? 'active' : '' }}" href="{{ route('kepsek.profile.index') }}">
                <i class="bi bi-person"></i> <span>Profil</span>
            </a>
        </li>
    </ul>
</div>
