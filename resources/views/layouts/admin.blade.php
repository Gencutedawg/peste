<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Dashboard') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: #1D3557;
            overflow-y: auto;
            z-index: 1000;
            padding-top: 60px;
        }
        
        .sidebar-close-btn {
            display: none;
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
            z-index: 1001;
        }
        
        .sidebar-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 10px 16px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        
        .nav-link:hover {
            color: white !important;
            background-color: #6EA8DA;
            border-left-color: #fff;
            padding-left: 26px;
        }
        
        .nav-link.active {
            color: white !important;
            background-color: #2C6CB0;
            border-left-color: #fff;
        }
        
        .nav-link i {
            margin-right: 8px;
            width: 18px;
        }

        .nav-dropdown-toggle {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 10px 16px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 13px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .nav-dropdown-toggle:hover {
            color: white !important;
            background-color: #6EA8DA;
            border-left-color: #fff;
            padding-left: 26px;
        }

        .nav-dropdown-toggle i:first-child {
            margin-right: 8px;
            width: 18px;
        }

        .nav-dropdown-toggle .dropdown-arrow {
            width: auto;
            margin-right: 0;
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .nav-dropdown-toggle.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .nav-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .nav-dropdown.show {
            max-height: 500px;
        }

        .nav-dropdown .nav-item {
            margin: 0;
        }

        .nav-dropdown .nav-link {
            padding: 8px 16px;
            padding-left: 40px;
            font-size: 12px;
            border-left: 3px solid transparent;
        }

        .nav-dropdown .nav-link:hover {
            background-color: rgba(106, 168, 218, 0.5);
            padding-left: 48px;
        }

        .nav-dropdown .nav-link.active {
            background-color: rgba(44, 108, 176, 0.6);
            border-left-color: #fff;
        }
        
        .sidebar .nav-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            padding: 15px 16px 8px;
            letter-spacing: 0.5px;
        }
        
        .topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 60px;
            background: white;
            border-bottom: 2px solid #e3e6f0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            width: calc(100% - 260px);
        }
        
        .topbar .topbar-nav {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .user-menu:hover {
            background-color: #EAF2F8;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2C6CB0, #6EA8DA);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 1px 4px rgba(44, 108, 176, 0.2);
        }
        
        .main-content {
            position: relative;
            z-index: 1;
            margin-left: 260px;
            width: calc(100% - 260px);
            margin-top: 60px;
            padding: 24px;
            min-height: auto;
            padding-bottom: 32px;
            overflow: visible;
        }
        
        .footer {
            margin-left: 260px;
            background: white;
            border-top: 1px solid #e3e6f0;
            padding: 16px 24px;
            text-align: center;
            color: #6c757d;
            font-size: 13px;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 24px;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: #2C6CB0;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #6EA8DA;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 108, 176, 0.4);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            margin-top: 8px;
        }
        
        .dropdown-item {
            padding: 8px 16px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:first-child {
            border-radius: 8px 8px 0 0;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
            border-radius: 0 0 8px 8px;
        }
        
        .dropdown-item:hover {
            background-color: #EAF2F8;
            color: #2C6CB0;
            padding-left: 24px;
        }
        
        .dropdown-divider {
            margin: 6px 0 !important;
            background-color: #f0f0f0;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
        }
        
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead th {
            background: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
            color: #2d3748;
            font-weight: 600;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .badge-admin {
            background: #1D3557;
            color: white;
        }
        
        .badge-moderator {
            background: #2C6CB0;
            color: white;
        }
        
        .badge-user {
            background: #6EA8DA;
            color: white;
        }
        
        .dropdown {
            position: relative;
        }
        
        .dropdown .btn-link {
            color: #2d3748 !important;
            font-weight: 500;
            padding: 0 !important;
        }
        
        .dropdown .btn-link:hover {
            color: #2C6CB0 !important;
        }
        
        .dropdown-toggle::after {
            display: none;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                padding-top: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }
            
            .sidebar.show {
                max-height: 500px;
                padding-top: 50px;
            }
            
            .sidebar.show .sidebar-close-btn {
                display: block;
            }
            
            .topbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                margin-top: 60px;
            }

            .sidebar.show ~ .main-content {
                margin-top: 520px;
            }
            
            .footer {
                margin-left: 0;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <button class="sidebar-close-btn d-lg-none" id="sidebarCloseBtn" title="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="nav-label">Main Menu</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
        </ul>
        
        <div class="nav-label mt-3">Management</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                   href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i> User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('plates.index') ? 'active' : '' }}"
                   href="{{ route('plates.index') }}">
                    <i class="bi bi-layers"></i> Plate Type Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('booths.index') ? 'active' : '' }}"
                   href="{{ route('booths.index') }}">
                    <i class="bi bi-shop"></i> Curing Booth Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('spc-report.*') ? 'active' : '' }}"
                   href="javascript:void(0);">
                    <i class="bi bi-file-earmark-text"></i> SPC Report
                </a>
            </li>
        </ul>
    </nav>

    <!-- Topbar -->
    <nav class="topbar">
        <div class="d-flex align-items-center">
            <button class="btn btn-link d-lg-none" id="sidebarToggle" style="text-decoration: none; color: #2C6CB0; padding: 6px 10px;">
                <i class="bi bi-list" style="font-size: 20px;"></i>
            </button>
        </div>
        
        <div class="topbar-nav">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" 
                        aria-expanded="false" style="text-decoration: none; color: #2d3748;">
                    <div class="user-menu">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px;">
                                {{ Auth::user()->first_name ? Auth::user()->first_name . ' ' . Auth::user()->last_name : Auth::user()->name }}
                            </div>
                            <div style="font-size: 11px; color: #6c757d;">
                                {{ ucfirst(Auth::user()->role) }}
                            </div>
                        </div>
                    </div>
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="text-decoration: none; border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Alert Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Dashboard') }}. All rights reserved. | Admin Dashboard</p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // Sidebar Toggle for Mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        
        function toggleSidebar() {
            sidebar.classList.toggle('show');
        }
        
        function closeSidebar() {
            sidebar.classList.remove('show');
        }
        
        sidebarToggle?.addEventListener('click', toggleSidebar);
        sidebarCloseBtn?.addEventListener('click', closeSidebar);
        
        // Close sidebar when a link is clicked (on mobile)
        const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
        
        // SweetAlert for success messages
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#2C6CB0',
                timer: 3000
            });
        @endif

        // SweetAlert for error messages
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc3545'
            });
        @endif

        // SweetAlert for validation errors
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: '<ul style="text-align: left;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                confirmButtonColor: '#dc3545'
            });
        @endif
    </script>
    
    @yield('scripts')
</body>
</html>
