<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Pages')</title>
    <meta name="description" content="SPP KEP SPSI - Sistem Pengelolaan Keanggotaan Serikat Pekerja">
    <meta name="keywords" content="SPP, KEP, SPSI, Serikat Pekerja, Keanggotaan, Manajemen Anggota">
    <meta name="author" content="SPP KEP SPSI Team">
    <link rel="icon" href="{{ asset('img-profile/logo-web.png') }}" type="image/png">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Tambahkan di <head> -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #4F46E5;
            --disable-bc: #D9D9D9;
            --disable-txt: #9E9E9E;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --tertary: #BA6D00;
            --secondary: #605D91;
            --info: #0EA5E9;
            --white: #FFFFFF;
            --surface: #F1F5F9;
            --black: #222833;

            /* Hover states */
            --primary-hover: #4338ca;
            --success-hover: #0e9f6e;
            --warning-hover: #d97706;
            --danger-hover: #dc2626;
            --tertary-hover: #9a5900;
            --secondary-hover: #4b4780;

            /* Font Sizes */
            --h1: 3.75rem;
            /* 60px */
            --h2: 2.813rem;
            /* 45px */
            --h3: 2.109rem;
            /* 33.75px */
            --h4: 1.582rem;
            /* 25.3px */
            --h5: 1.187rem;
            /* 19px */
            --h6: 0.89rem;
            /* 14.24px */

            --p1: 1.25rem;
            /* 20px */
            --p2: 1.125rem;
            /* 18px */
            --p3: 1rem;
            /* 16px */
            --p4: 0.875rem;
            /* 14px */
            --p5: 0.8125rem;
            /* 13px */
            --p6: 0.75rem;
            /* 12px */
        }

        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body,
        .main-content {
            overflow-x: hidden;

        }

        /* Top Navigation Bar */
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .navbar-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.5rem;
            margin: 1.5rem 0;
        }

        .profile-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin: 0;
            line-height: 1.2;
        }

        .profile-role {
            font-size: 0.8rem;
            color: #666;
            margin: 0;
            line-height: 1.2;
        }

        /* Layout Container */
        .layout-container {
            display: flex;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }

        /* Sidebar */
        .sidebar {
            width: 300px;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #e9ecef;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: calc(100vh - 70px);
            z-index: 1000;
            left: 0;
            top: 100px;

            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .sidebar-logo {
            margin-bottom: 2rem;
            text-align: center;
            flex-shrink: 0;
        }

        .logo-circle {
            width: 5rem;
            height: auto;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .logo-circle::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
        }

        .logo-circle::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #ff6347 0%, #32cd32 50%, #4169e1 100%);
            border-radius: 50%;
        }

        /* Navigation */
        .sidebar-nav {
            flex: 1;
            overflow-y: visible;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            text-decoration: none;
            color: #666;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .nav-link.active {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .nav-link i {
            margin-right: 12px;
            width: 18px;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Logout */
        .sidebar-logout {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
            flex-shrink: 0;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 300px;
            padding: 2rem;
            background-color: #f5f5f5;
        }

        .content-header {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }

        /* Controls */
        .controls-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .search-wrapper {
            display: flex;
            gap: 0.5rem;
        }

        .search-input {
            width: 300px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 0.875rem;
            background-color: white;
        }

        .search-btn {
            padding: 0.75rem 1rem;
            background-color: #6f42c1;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-btn:hover {
            background-color: #5a359a;
        }

        .add-member-btn {
            padding: 0.75rem 1.5rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
        }

        .add-member-btn:hover {
            background-color: #218838;
        }

        /* wrapper hanya styling, jangan overflow di sini */
        .table-wrapper {
            background: #fff;
            border-radius: .5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            /* buang overflow-x: auto */
        }

        /* area tabel yang scrollable */
        .table-responsive {
            width: 100%;
            /* penuh lebar parent */
            overflow-x: auto;
            /* scroll hanya di sini */
            -webkit-overflow-scrolling: touch;
        }

        /* biarkan tabel selebar kontennya */
        .table-responsive .data-table {
            display: inline-block;
            /* inline-block supaya lebar ditentukan isi */
            width: auto !important;
            /* override kalau ada width:100% */
            white-space: nowrap;
            /* cegah wrap kolom */
        }

        /* (opsional) atur minimal lebar agar scrollbar pasti muncul bila container sempit */
        .table-responsive .data-table {
            min-width: 800px;
            /* sesuaikan: jumlah kolom × lebar minimal per kolom */
        }



        .data-table {
            /* width: 100%; */
            margin: 0;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .data-table thead th {
            background-color: #f8f9fa;
            padding: 1rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
        }

        .data-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f8f9fa;
            color: #495057;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            min-width: 70px;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            transition: all 0.2s;
        }

        .btn-view {
            background-color: #6c757d;
            color: white;
        }

        .btn-view:hover {
            background-color: #5a6268;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
            border-top: 1px solid #f8f9fa;
        }

        .pagination-nav {
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            border: 1px solid #dee2e6;
            background-color: white;
            color: #6c757d;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .page-btn:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        .page-btn.active {
            background-color: #6f42c1;
            color: white;
            border-color: #6f42c1;
        }

        .page-dots {
            padding: 0 0.5rem;
            color: #adb5bd;
            font-size: 0.875rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 50%;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .top-navbar {
                padding: 1rem;
            }

            .navbar-title {
                font-size: 1.1rem;
            }

            .profile-info {
                display: none;
            }

            .controls-row {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .search-wrapper {
                flex-direction: column;
            }

            .search-input {
                width: 100%;
            }

            .data-table {
                font-size: 0.75rem;
            }

            .data-table thead th,
            .data-table tbody td {
                padding: 0.75rem 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .action-btn {
                width: 28px;
                height: 28px;
            }
        }

        /* Hamburger Menu */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #495057;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>

<!-- Top Navigation Bar -->
<div class="top-navbar">
        <div class="d-flex align-items-center">
            <button class="menu-toggle me-3" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="navbar-title">@yield('menu-title', 'LARAVEL BLOG')</h1>
        </div>

        <div class="navbar-profile">
            <img src="{{ session('avatar') ? asset(session('avatar')) : asset('img-profile/profile.jpg') }}"
                alt="User Avatar" class="profile-avatar" />
            <div class="profile-info">
                <div class="profile-name">{{ session('user_name') ?? 'Default' }}</div>
                <div class="profile-role">{{ session('role_name') ?? 'Anggota' }}</div>
            </div>
        </div>
    </div>

    <div class="layout-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                {{-- <div class="logo-circle"></div> --}}
                <img src="{{ asset('img-profile/logo-web.png') }}" alt="Logo" class="logo-circle" />
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                   
                    <a href=""
                        class="nav-link active">
                        <i class="fas fa-th-large"></i>
                        Dashboard
                    </a>
                    
                </div>

               
            </nav>
            <div class="sidebar-logout">
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        Log Out
                    </button>
                </form>
            </div>


        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')

        </div>
    </div>
<footer class="text-white py-4" style="background-color: var(--danger);">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 LARAVEL BLOG. All rights reserved.</p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.coming-soon');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'info',
                        title: 'Coming Soon',
                        text: 'Fitur ini akan segera hadir. Silakan tunggu pembaruan selanjutnya.',
                        confirmButtonText: 'OK'
                    });
                });
            });
        });
    </script>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menuToggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
    @stack('scripts')

</body>

</html>