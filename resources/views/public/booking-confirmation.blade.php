@extends('layouts.public')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container py-5">
    <div class="confirmation-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2>Booking Confirmed!</h2>
        <p class="text-muted">Thank you for choosing our hotel. Your booking request has been received.</p>

        <div class="booking-details text-start">
            <h5 class="mb-3">Booking Details</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Guest Name:</strong> {{ $booking->guest_name }}</p>
                    <p><strong>Email:</strong> {{ $booking->guest_email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->guest_phone }}</p>
                    <p><strong>Room:</strong> {{ $booking->room->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('F j, Y') }}</p>
                    <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('F j, Y') }}</p>
                    <p><strong>Guests:</strong> {{ $booking->guests }}</p>
                    <p><strong>Total:</strong> KES {{ number_format($booking->total_price, 0) }}</p>
                </div>
            </div>
            @if($booking->special_requests)
            <div class="mt-3">
                <p><strong>Special Requests:</strong></p>
                <p class="text-muted">{{ $booking->special_requests }}</p>
            </div>
            @endif
            <div class="mt-3">
                <p><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ url('/') }}" class="btn btn-navy me-2">Back to Home</a>
            <a href="{{ url('/rooms') }}" class="btn btn-outline-primary">View More Rooms</a>
        </div>
    </div>
</div>
@endsection
