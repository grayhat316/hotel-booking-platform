@extends('layouts.admin')

@section('title', 'Dashboard')

@section('dashboard_active')
active
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col">
        <div class="stat-card stat-card-blue text-center">
            <h3>{{ $stats['rooms'] ?? 0 }}</h3>
            <p class="mb-0">Rooms</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-gold text-center">
            <h3>{{ $stats['bookings'] ?? 0 }}</h3>
            <p class="mb-0">Bookings</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-green text-center">
            <h3>{{ $stats['foods'] ?? 0 }}</h3>
            <p class="mb-0">Foods</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-red text-center">
            <h3>{{ $stats['gallery'] ?? 0 }}</h3>
            <p class="mb-0">Gallery</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-blue text-center">
            <h3>{{ $stats['services'] ?? 0 }}</h3>
            <p class="mb-0">Services</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-gold text-center">
            <h3>{{ $stats['pending_bookings'] ?? 0 }}</h3>
            <p class="mb-0">Pending Bookings</p>
        </div>
    </div>
    <div class="col">
        <div class="stat-card stat-card-green text-center">
            <h3>{{ $stats['confirmed_bookings'] ?? 0 }}</h3>
            <p class="mb-0">Confirmed Bookings</p>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Recent Bookings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>{{ $booking->room->name ?? 'N/A' }}</td>
                            <td>{{ $booking->check_in }}</td>
                            <td>{{ $booking->check_out }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : ($booking->status === 'cancelled' ? 'danger' : 'secondary')) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-gold">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No recent bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
