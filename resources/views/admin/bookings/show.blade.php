@extends('layouts.admin')

@section('title', 'Booking Details')
@section('bookings_active', 'active')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-calendar-check me-2"></i>Booking Details</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ url('/admin/bookings') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Bookings
        </a>
    </div>
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

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Booking Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="30%">Booking ID:</th>
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
                            <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : ($booking->status === 'pending' ? 'bg-warning text-dark' : ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-info')) }} fs-6">
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

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Guest Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th>Name:</th>
                        <td><strong>{{ $booking->guest_name ?? 'N/A' }}</strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $booking->guest_email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $booking->guest_phone ?? 'N/A' }}</td>
                    </tr>
                    @if($booking->special_requests)
                    <tr>
                        <th>Special Requests:</th>
                        <td>{{ $booking->special_requests }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Room Information</h5>
            </div>
            <div class="card-body">
                @if($booking->room)
                <table class="table table-borderless mb-0">
                    <tr>
                        <th>Room:</th>
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

<div class="card mb-4">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><i class="fas fa-sync me-2"></i>Quick Status Update</h5>
    </div>
    <div class="card-body">
        <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="check_in" value="{{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}">
            <input type="hidden" name="check_out" value="{{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}">
            <input type="hidden" name="guests" value="{{ $booking->guests }}">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="status" class="form-label fw-bold"><i class="fas fa-tag me-1"></i>Change Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update Status
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="d-flex justify-content-between">
    <a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}" class="btn btn-outline-primary">
        <i class="fas fa-edit me-1"></i>Edit Full Details
    </a>
    <form action="{{ url('/admin/bookings/' . $booking->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">
            <i class="fas fa-trash me-1"></i>Delete Booking
        </button>
    </form>
</div>
@endsection
