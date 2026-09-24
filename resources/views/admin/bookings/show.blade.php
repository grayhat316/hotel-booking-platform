@extends('layouts.admin')

@section('title', 'Booking Details')
@section('bookings_active', 'active')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-calendar-check me-2"></i>Booking Details</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Bookings
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Booking Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="40%">Booking ID:</th>
                        <td><strong>#{{ $booking->id }}</strong></td>
                    </tr>
                    <tr>
                        <th>Check-in:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('l, M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Check-out:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('l, M d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Guests:</th>
                        <td>{{ $booking->guests }} person(s)</td>
                    </tr>
                    <tr>
                        <th>Total Price:</th>
                        <td><strong>KES {{ number_format($booking->total_price, 2) }}</strong></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : ($booking->status === 'cancelled' ? 'danger' : 'secondary')) }} fs-6">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $booking->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At:</th>
                        <td>{{ $booking->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Guest Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="35%">Name:</th>
                        <td><strong>{{ $booking->guest_name ?? 'N/A' }}</strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $booking->guest_email ?? 'N/A' }}</td>                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $booking->guest_phone ?? 'N/A' }}</td>                    </tr>
                    @if($booking->special_requests)
                    <tr>
                        <th>Special Requests:</th>
                        <td>{{ $booking->special_requests }}</td>                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Room Information</h5>
            </div>
            <div class="card-body">
                @if($booking->room)
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="35%">Room:</th>
                        <td><strong>{{ $booking->room->name }}</strong></td>
                    </tr>
                    @if(isset($booking->room->type))
                    <tr>
                        <th>Type:</th>
                        <td>{{ $booking->room->type }}</td>
                    </tr>
                    @endif
                    @if(isset($booking->room->capacity))
                    <tr>
                        <th>Capacity:</th>
                        <td>{{ $booking->room->capacity }} guests</td>
                    </tr>
                    @endif
                </table>
                @else
                <p class="text-muted">Room information not available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="text-end">
    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Booking
    </a>
</div>
@endsection
