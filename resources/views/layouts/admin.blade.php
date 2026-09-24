<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6fa; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a3a5c 0%, #2c5282 100%);
            color: #fff;
            position: fixed;
            top: 0; left: 0;
            width: 250px;
            z-index: 100;
        }
        .sidebar .brand {
            padding: 20px;
            font-size: 1.3rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 12px 20px;
            display: block;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        .sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .topbar {
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border-radius: 8px;
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
        .stat-card h3 { font-size: 2rem; font-weight: 700; }
        .stat-card-blue { background: linear-gradient(135deg, #1a3a5c, #2c5282); }
        .stat-card-gold { background: linear-gradient(135deg, #c9a96e, #d4af37); }
        .stat-card-green { background: linear-gradient(135deg, #27ae60, #2ecc71); }
        .stat-card-red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .btn-gold { background: #c9a96e; border-color: #c9a96e; color: #fff; }
        .btn-gold:hover { background: #b8964c; border-color: #b8964c; color: #fff; }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="brand">
            <i class="fas fa-hotel me-2"></i> Hotel Admin
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
        <div class="topbar d-flex justify-content-between align-items-center">
            <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
