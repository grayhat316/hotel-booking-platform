@extends('layouts.admin')

@section('title', 'Dashboard')

@section('dashboard_active')
active
@endsection

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h2>
    <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card stat-card-blue h-100">
            <div class="card-body text-center text-white">
                <i class="fas fa-bed fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['rooms'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Rooms</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card stat-card-blue h-100">
            <div class="card-body text-center text-white">
                <i class="fas fa-calendar-check fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['bookings'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Bookings</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card h-100" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">
            <div class="card-body text-center text-white">
                <i class="fas fa-utensils fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['foods'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Foods</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card h-100" style="background: linear-gradient(135deg, #8e44ad, #9b59b6);">
            <div class="card-body text-center text-white">
                <i class="fas fa-images fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['gallery'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Gallery</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card h-100" style="background: linear-gradient(135deg, #16a085, #1abc9c);">
            <div class="card-body text-center text-white">
                <i class="fas fa-concierge-bell fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['services'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Services</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card h-100" style="background: linear-gradient(135deg, #f39c12, #f1c40f);">
            <div class="card-body text-center text-white">
                <i class="fas fa-clock fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['pending_bookings'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Pending</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
        <div class="card h-100" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">
            <div class="card-body text-center text-white">
                <i class="fas fa-check-circle fa-2x mb-2 opacity-75"></i>
                <h3 class="mb-0">{{ $stats['confirmed_bookings'] ?? 0 }}</h3>
                <p class="mb-0 small text-uppercase">Confirmed Bookings</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Recent Bookings</h5>
        <a href="{{ url('/admin/bookings') }}" class="btn btn-sm btn-gold">View All <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td><strong>#{{ $booking->id }}</strong></td>
                            <td>
                                <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="text-decoration-none fw-semibold">
                                    {{ $booking->user->name ?? 'N/A' }}
                                </a>
                            </td>
                            <td>{{ $booking->room->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                            <td>
                                @if($booking->status === 'confirmed')
                                    <span class="badge bg-success rounded-pill">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status === 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge bg-danger rounded-pill">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status === 'completed')
                                    <span class="badge bg-secondary rounded-pill">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/admin/bookings/' . $booking->id) }}" class="btn btn-sm btn-outline-primary me-1" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}" class="btn btn-sm btn-gold" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No recent bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
