<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --navy: #1a3a5c;
            --navy-dark: #0f2540;
            --gold: #c9a96e;
            --gold-light: #d4af37;
        }
        
        body { background: #f0f2f5; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        
        /* Sidebar - Desktop */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--navy-dark) 0%, var(--navy) 100%);
            color: #fff;
            position: fixed;
            top: 0; left: 0;
            width: 250px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar .brand {
            padding: 20px;
            font-size: 1.3rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar .brand .toggle-close {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        
        .sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
        }
        
        /* Mobile overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
        
        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        
        .topbar {
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topbar .toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--navy);
            cursor: pointer;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        
        .stat-card {
            padding: 20px;
            border-radius: 10px;
            color: #fff;
        }
        .stat-card h3 { font-size: 2rem; font-weight: 700; margin: 0; }
        .stat-card p { margin: 0; opacity: 0.9; font-size: 0.9rem; }
        .stat-card-blue { background: linear-gradient(135deg, var(--navy), #2c5282); }
        .stat-card-gold { background: linear-gradient(135deg, var(--gold), var(--gold-light)); }
        .stat-card-green { background: linear-gradient(135deg, #27ae60, #2ecc71); }
        .stat-card-red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        
        .btn-gold { background: var(--gold); border-color: var(--gold); color: #fff; }
        .btn-gold:hover { background: var(--gold-light); border-color: var(--gold-light); color: #fff; }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar .brand .toggle-close {
                display: block;
            }
            .main-content {
                margin-left: 0;
            }
            .topbar .toggle-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <nav class="sidebar" id="sidebar">
        <div class="brand">
            <span><i class="fas fa-hotel me-2"></i> Admin</span>
            <button class="toggle-close" onclick="toggleSidebar()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="nav flex-column">
            <li><a class="nav-link @yield('dashboard_active')" href="{{ url('/admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a class="nav-link @yield('rooms_active')" href="{{ url('/admin/rooms') }}"><i class="fas fa-bed"></i> Rooms</a></li>
            <li><a class="nav-link @yield('foods_active')" href="{{ url('/admin/foods') }}"><i class="fas fa-utensils"></i> Dining</a></li>
            <li><a class="nav-link @yield('services_active')" href="{{ url('/admin/services') }}"><i class="fas fa-concierge-bell"></i> Services</a></li>
            <li><a class="nav-link @yield('gallery_active')" href="{{ url('/admin/gallery') }}"><i class="fas fa-images"></i> Gallery</a></li>
            <li><a class="nav-link @yield('bookings_active')" href="{{ url('/admin/bookings') }}"><i class="fas fa-calendar-check"></i> Bookings</a></li>
            <li class="mt-3"><a class="nav-link" href="{{ url('/') }}" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a></li>
            <li>
                <form action="{{ url('/logout') }}" method="POST" class="nav-link">
                    @csrf
                    <button type="submit" class="btn btn-link text-warning p-0" style="text-decoration:none;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
            </div>
            <span class="text-muted"><i class="fas fa-user me-1"></i> {{ Auth::user()->name }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }
        
        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
    </script>
    @stack('scripts')
</body>
</html>
