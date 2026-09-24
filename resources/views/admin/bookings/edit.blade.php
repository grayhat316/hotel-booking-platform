@extends('layouts.admin')

@section('title', 'Edit Booking')
@section('bookings_active', 'active')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-edit me-2"></i>Edit Booking #{{ $booking->id }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Booking
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Update Booking Details</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-triangle me-1"></i>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="check_in" class="form-label"><i class="fas fa-sign-in-alt me-1"></i>Check-in Date</label>
                            <input type="date" class="form-control @error('check_in') is-invalid @enderror" id="check_in" name="check_in" value="{{ old('check_in', \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d')) }}" required>
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="check_out" class="form-label"><i class="fas fa-sign-out-alt me-1"></i>Check-out Date</label>
                            <input type="date" class="form-control @error('check_out') is-invalid @enderror" id="check_out" name="check_out" value="{{ old('check_out', \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d')) }}" required>
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="guests" class="form-label"><i class="fas fa-users me-1"></i>Number of Guests</label>
                            <input type="number" min="1" class="form-control @error('guests') is-invalid @enderror" id="guests" name="guests" value="{{ old('guests', $booking->guests) }}" required>
                            @error('guests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label"><i class="fas fa-tag me-1"></i>Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ old('status', $booking->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
