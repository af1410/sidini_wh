<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand me-2" href="{{ url('/') }}">
            <i class="bi bi-mortarboard"></i> SIDINI
        </a>
        <button type="button" class="btn btn-light btn-sm" id="sidebarToggle" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" style="text-decoration: none;">
                        @php
                            $user = Auth::guard('guru')->user();
                            $gambar = $user->gambar ?? null;
                        @endphp

                        <!-- Profile Photo / Icon -->
                        @if ($gambar && file_exists(public_path('storage/' . $gambar)))
                            <img src="{{ asset('storage/' . $gambar) }}" alt="Profile" class="rounded-circle"
                                style="width: 32px; height: 32px; object-fit: cover; border: 2px solid white;">
                        @else
                            <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                        @endif

                        <!-- Username (hidden on small screens) -->
                        <span class="d-none d-lg-inline">
                            {{ $user->nama_guru ?? 'Guru' }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
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
