@extends('layouts.public')

@section('title', 'Our Rooms - The Grand Hotel & Spa')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(rgba(26, 58, 92, 0.75), rgba(26, 58, 92, 0.85)),
                    url("{{ asset('images/gallery.svg') }}") center/cover no-repeat;
        padding: 5rem 0;
        text-align: center;
        color: #fff;
    }

    .page-header h1 {
        color: #fff;
        font-size: 2.75rem;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        font-size: 1.1rem;
        font-weight: 300;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Our Rooms</h1>
        <p>Discover the perfect room for your stay</p>
    </div>
</section>

<!-- Rooms Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="card card-room">
                        <img src="{{ $room->image && str_starts_with($room->image, 'http') ? $room->image : asset($room->image ? 'uploads/rooms/' . $room->image : 'images/room.svg') }}" alt="{{ $room->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($room->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="price">KES {{ number_format($room->price, 0) }} <small class="text-muted">/ night</small></span>
                                <span class="badge bg-navy text-white">{{ $room->capacity }} Guest{{ $room->capacity > 1 ? 's' : '' }}</span>
                            </div>
                            <a href="{{ url('/rooms/' . $room->id) }}" class="btn btn-outline-gold btn-sm w-100 mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
