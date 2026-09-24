@extends('layouts.public')

@section('title', $room->name . ' - Book Now')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/rooms') }}">Rooms</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/rooms/' . $room->id) }}">{{ $room->name }}</a></li>
                <li class="breadcrumb-item active">Book Now</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="booking-card">
                <h3 class="mb-4">Book {{ $room->name }}</h3>
                <form action="{{ url('/booking/' . $room->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guest_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="guest_name" name="guest_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guest_email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="guest_email" name="guest_email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guest_phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control" id="guest_phone" name="guest_phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="guests" class="form-label">Number of Guests *</label>
                            <select class="form-select" id="guests" name="guests" required>
                                @for($i = 1; $i <= $room->capacity; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="check_in" class="form-label">Check-in Date *</label>
                            <input type="date" class="form-control" id="check_in" name="check_in" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="check_out" class="form-label">Check-out Date *</label>
                            <input type="date" class="form-control" id="check_out" name="check_out" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="special_requests" class="form-label">Special Requests</label>
                        <textarea class="form-control" id="special_requests" name="special_requests" rows="3" placeholder="Any special requirements or requests..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-navy text-white w-100 py-3">Submit Booking Request</button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="booking-card">
                <h5 class="mb-3">Booking Summary</h5>
                <div class="price-summary mb-3">
                    <h6>{{ $room->name }}</h6>
                    <p class="text-muted small mb-1">{{ $room->capacity }} guests max</p>
                    <p class="price mb-0">KES {{ number_format($room->price, 0) }} <small class="text-muted">/ night</small></p>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span>Room Type</span>
                    <strong>{{ $room->name }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Capacity</span>
                    <strong>{{ $room->capacity }} guests</strong>
                </div>
                <hr>
                <p class="text-muted small">Total will be calculated based on your stay duration.</p>
            </div>
        </div>
    </div>
</div>
@endsection
