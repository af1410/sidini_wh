<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIDINI | @yield('title', '')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #29ab87;
            --secondary-color: #1e7f5f;
            --light-color: #f0f7f5;
            --navbar-height: 72px;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            --bs-primary: var(--primary-color);
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            min-height: var(--navbar-height);
            z-index: 1040;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            white-space: nowrap;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: color 0.3s;
        }

        .navbar .nav-link:hover {
            color: white !important;
        }

        .navbar .btn-light {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            font-size: 1.1rem;
            transition: all 0.2s ease;
            padding: 0.375rem 0.6rem !important;
            margin-right: 0.5rem;
        }

        .navbar .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: white !important;
            transform: scale(1.05);
        }

        .user-dropdown .dropdown-menu {
            min-width: 230px;
        }

        .user-dropdown img {
            border: 2px solid white;
        }

        .user-profile-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.95) !important;
            max-width: 240px;
        }

        .user-profile-link:hover {
            color: #fff !important;
        }

        .user-profile-name {
            display: inline-block;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sidebar {
            background: white;
            height: calc(100vh - var(--navbar-height));
            position: fixed;
            left: 0;
            top: var(--navbar-height);
            width: var(--sidebar-width);
            padding-top: 1rem;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid #e0e0e0;
            transition: width 0.3s ease, transform 0.3s ease;
            z-index: 1030;
        }

        .sidebar::-webkit-scrollbar {
            width: 0;
            height: 0;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar .nav-link {
            color: #333;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
            display: flex;
            align-items: center;
            white-space: normal;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.75rem;
            justify-content: center;
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
            color: var(--primary-color);
            font-size: 1.25rem;
            min-width: 20px;
            text-align: center;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar .nav-link:hover {
            background-color: var(--light-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }

        .sidebar .nav-link.active {
            background-color: var(--light-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar .nav-section-title {
            padding: 1rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar-toggle {
            position: absolute;
            top: 15px;
            right: -35px;
            width: 35px;
            height: 35px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 1041;
        }

        .sidebar-toggle:hover {
            background: var(--secondary-color);
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 2rem;
            transition: margin-left 0.3s ease;
            flex: 1;
            min-width: 0;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .app-footer {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .app-footer.expanded {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: var(--light-color);
            border-bottom: 2px solid var(--primary-color);
            border-radius: 8px 8px 0 0 !important;
        }

        .badge-primary {
            background-color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
                transform: translateX(-100%);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.08);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.collapsed {
                width: 250px;
            }

            .sidebar .nav-section-title {
                display: block;
            }

            .sidebar .nav-link span {
                display: inline;
            }

            .main-content,
            .main-content.expanded {
                margin-left: 0;
                padding: 1rem;
            }

            .app-footer,
            .app-footer.expanded {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: none;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .user-profile-name {
                max-width: 130px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }

            .user-dropdown .dropdown-menu {
                min-width: 210px;
            }

            .main-content {
                padding: 0.85rem;
            }

            .navbar .btn-light {
                margin-right: 0.35rem;
            }

            .user-profile-name {
                max-width: 95px;
                font-size: 0.92rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('kepsek.layouts.navbar')
    @include('kepsek.layouts.sidebar')

    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-check-circle-fill me-2"></i>Berhasil
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <i class="bi bi-check-circle-fill text-success"
                            style="font-size:70px"></i>

                        <h5 class="mt-3">
                            {{ session('success') }}
                        </h5>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success"
                            data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            Gagal
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size:70px"></i>
                        <h5 class="mt-3">
                            {{ session('error') }}
                        </h5>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('kepsek.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            const mainContent = document.getElementById('mainContent');
            const footer = document.querySelector('.app-footer');

            function isMobile() {
                return window.innerWidth <= 992;
            }

            const modalEl = document.getElementById('successModal');
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
            setTimeout(function() {
                let alert = document.querySelector('.alert-success');
                if (alert) {
                    bootstrap.Alert.getOrCreateInstance(alert).close();
                }
            }, 2500);

            function updateToggleIcon() {
                if (!sidebarToggleBtn) return;
                const icon = sidebarToggleBtn.querySelector('i');
                if (!icon) return;

                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('bi-chevron-left');
                    icon.classList.add('bi-chevron-right');
                } else {
                    icon.classList.remove('bi-chevron-right');
                    icon.classList.add('bi-chevron-left');
                }
            }

            function applyLayoutByWidth() {
                if (isMobile()) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    if (footer) footer.classList.remove('expanded');
                } else {
                    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    sidebar.classList.toggle('collapsed', isCollapsed);
                    mainContent.classList.toggle('expanded', isCollapsed);
                    if (footer) footer.classList.toggle('expanded', isCollapsed);
                    updateToggleIcon();
                }
            }

            function toggleSidebar() {
                if (isMobile()) {
                    sidebar.classList.toggle('show');
                } else {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                    if (footer) footer.classList.toggle('expanded');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                    updateToggleIcon();
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }

            if (sidebarToggleBtn) {
                sidebarToggleBtn.addEventListener('click', toggleSidebar);
            }

            document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (isMobile()) {
                        sidebar.classList.remove('show');
                    }
                });
            });

            applyLayoutByWidth();

            window.addEventListener('resize', function() {
                applyLayoutByWidth();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"][data-image-preview]').forEach(function(input) {
                const targetSelector = input.dataset.imagePreview;
                const wrapperSelector = input.dataset.imagePreviewWrapper;
                const target = targetSelector ? document.querySelector(targetSelector) : null;
                const wrapper = wrapperSelector ? document.querySelector(wrapperSelector) : null;

                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (target && target.tagName === 'IMG') {
                            target.src = e.target.result;
                        } else if (wrapper) {
                            wrapper.innerHTML = '<img src="' + e.target.result +
                                '" alt="Preview" class="img-fluid rounded" style="max-width: 100%; height: auto;">';
                        }
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

    @stack('scripts')
    @include('partials.session-messages')

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('a[href="#"]').forEach(function(link) {

                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = '/fitur-belum-tersedia';
                });

            });

        });
    </script>
</body>

</html>
