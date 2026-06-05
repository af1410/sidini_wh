<nav class="navbar navbar-expand navbar-dark fixed-top">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand me-2" href="{{ url('/') }}">
            <i class="bi bi-mortarboard"></i> SIDINI
        </a>

        <button type="button" class="btn btn-light btn-sm" id="sidebarToggle" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>

        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown user-dropdown">
                    @php
                        $user = Auth::guard('siswa')->user();
                        $gambar = $user->gambar ?? null;
                    @endphp

                    <a class="nav-link dropdown-toggle user-profile-link" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        @if ($gambar && file_exists(public_path('storage/' . $gambar)))
                            <img src="{{ asset('storage/' . $gambar) }}" alt="Profile" class="rounded-circle"
                                style="width: 34px; height: 34px; object-fit: cover;">
                        @else
                            <i class="bi bi-person-circle" style="font-size: 1.6rem;"></i>
                        @endif

                        <span class="user-profile-name">
                            {{ $user->nama_siswa ?? 'Siswa' }}
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person"></i> Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
