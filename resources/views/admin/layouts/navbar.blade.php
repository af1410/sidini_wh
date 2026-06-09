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
                @php
                    $approvalNotif = \App\Models\Penilaian::with(['guru', 'mapel', 'kelas'])
                        ->where('status_approval', 'menunggu_approval')
                        ->latest()
                        ->take(5)
                        ->get();

                    $jumlahNotif = $approvalNotif->count();
                @endphp
                <li class="nav-item dropdown">

                    <button class="nav-link position-relative" data-bs-toggle="dropdown">

                        <i class="bi bi-bell fs-5"></i>

                        @if ($jumlahNotif > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                                {{ $jumlahNotif }}

                            </span>
                        @endif

                    </button>

                    <div class="dropdown-menu dropdown-menu-end p-0" style="width:400px">

                        <div class="p-3 border-bottom">

                            <strong>
                                Permintaan Approval
                            </strong>

                        </div>

                        @forelse($approvalNotif as $item)
                            <div class="p-3 border-bottom">

                                <div class="fw-bold">

                                    {{ $item->guru->nama_guru }}

                                </div>

                                <small class="text-muted">

                                    {{ $item->mapel->nama_mapel }}

                                    -

                                    {{ $item->kelas->nama_kelas }}

                                </small>

                                <br>

                                <small>

                                    @if ($item->tipe_sumatif)
                                        {{ strtoupper($item->tipe_sumatif) }}
                                    @else
                                        Bab {{ $item->bab_ke }}
                                    @endif

                                </small>

                                <div class="mt-2 d-flex gap-2">

                                    <form action="{{ route('admin.approval.approve', $item->id) }}" method="POST">

                                        @csrf

                                        <button class="btn btn-success btn-sm">

                                            ✓

                                        </button>

                                    </form>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#tolakModal{{ $item->id }}">

                                        ✕

                                    </button>

                                </div>

                            </div>

                        @empty

                            <div class="p-3 text-center text-muted">

                                Tidak ada notifikasi

                            </div>
                        @endforelse

                        <div class="p-2 text-center">

                            <a href="{{ route('admin.approval.index') }}">

                                Lihat Semua

                            </a>

                        </div>

                    </div>

                </li>
                <li class="nav-item dropdown user-dropdown">
                    @php
                        $user = Auth::guard('guru')->user();
                        $gambar = $user->gambar ?? null;
                    @endphp

                    <button class="nav-link dropdown-toggle user-profile-link border-0 bg-transparent" id="userDropdown"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">

                        @if ($gambar && file_exists(public_path('storage/' . $gambar)))
                            <img src="{{ asset('storage/' . $gambar) }}" alt="Profile" class="rounded-circle"
                                style="width: 34px; height: 34px; object-fit: cover;">
                        @else
                            <i class="bi bi-person-circle" style="font-size: 1.6rem;"></i>
                        @endif

                        <span class="user-profile-name">
                            {{ $user->nama_guru ?? 'Guru' }}
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                <i class="bi bi-person"></i> Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Logout
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">

                <i class="bi bi-box-arrow-right text-danger" style="font-size:4rem;"></i>

                <h5 class="mt-3">
                    Apakah Anda yakin ingin logout?
                </h5>

                <p class="text-muted mb-0">
                    Anda akan keluar dari sistem SIDINI.
                </p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Ya, Logout
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>
