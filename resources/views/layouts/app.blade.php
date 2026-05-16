<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIDINI - Sistem Informasi Digitalisasi Nilai')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #29ab87;
            --secondary-color: #1e7f5f;
            --light-color: #f0f7f5;
        }

        * {
            --bs-primary: var(--primary-color);
        }

        body {
            background-color: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: color 0.3s;
        }

        .navbar .nav-link:hover {
            color: white !important;
        }

        .user-dropdown .dropdown-menu {
            min-width: 250px;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding-top: 80px;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid #e0e0e0;
            transition: width 0.3s ease;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .nav-link {
            color: #333;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            position: relative;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.75rem;
            justify-content: center;
        }

        .sidebar .nav-link i {
            margin-right: 0.75rem;
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar .nav-link:hover {
            background-color: var(--light-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
        }

        .sidebar.collapsed .nav-link:hover {
            background-color: var(--light-color);
        }

        .sidebar .nav-link.active {
            background-color: var(--light-color);
            border-left-color: var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        .sidebar.collapsed .nav-link.active {
            background-color: var(--light-color);
        }

        .sidebar .nav-section-title {
            padding: 1rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .nav-section-title {
            display: none;
        }

        .navbar .btn-light {
            background-color: var(--primary-color) !important;
            color: white !important;
            border: none;
            font-size: 1.25rem;
            transition: all 0.2s ease;
        }

        .navbar .btn-light:hover {
            background-color: var(--secondary-color) !important;
            color: white !important;
            transform: scale(1.1);
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: absolute;
            top: 15px;
            right: -35px;
            width: 35px;
            height: 35px;
            background: transparent;
            color: white;
            border: none;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 1001;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 80px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 0;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }

            .main-content {
                margin-left: 0;
                margin-top: 0;
                padding: 1rem;
            }

            .navbar {
                position: relative;
            }
        }

        /* Cards */
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

        /* Badges */
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
    </style>
    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-mortarboard"></i> SIDINI
            </a>
            <button type="button" class="btn btn-light btn-sm ms-2" id="sidebarToggle" title="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-person"></i> Profile
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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

    <!-- Sidebar -->
    @yield('sidebar')

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            const mainContent = document.querySelector('.main-content');

            // Load sidebar state from localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
                updateToggleIcon();
            }

            // Toggle function
            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                updateToggleIcon();
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }

            // Update icon based on state
            function updateToggleIcon() {
                const icon = sidebarToggleBtn.querySelector('i');
                if (sidebar.classList.contains('collapsed')) {
                    icon.classList.remove('bi-chevron-left');
                    icon.classList.add('bi-chevron-right');
                } else {
                    icon.classList.remove('bi-chevron-right');
                    icon.classList.add('bi-chevron-left');
                }
            }

            // Event listeners
            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }
            if (sidebarToggleBtn) {
                sidebarToggleBtn.addEventListener('click', toggleSidebar);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"][data-image-preview]').forEach(function(input) {
                const targetSelector = input.dataset.imagePreview;
                const wrapperSelector = input.dataset.imagePreviewWrapper;
                const target = targetSelector ? document.querySelector(targetSelector) : null;
                const wrapper = wrapperSelector ? document.querySelector(wrapperSelector) : null;

                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (!file) {
                        return;
                    }

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
</body>

</html>
