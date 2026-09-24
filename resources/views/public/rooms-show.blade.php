@extends('layouts.public')

@section('title', $room->name . ' - The Grand Hotel & Spa')

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
    }

    .room-detail-img {
        border-radius: 0.5rem;
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    .amenity-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
        color: #555;
    }

    .amenity-item i {
        color: var(--gold);
        font-size: 1.2rem;
    }

    .related-img {
        height: 180px;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>{{ $room->name }}</h1>
    </div>
</section>

<!-- Room Detail -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Image -->
            <div class="col-lg-7">
                <img src="{{ $room->image && str_starts_with($room->image, 'http') ? $room->image : asset($room->image ? 'uploads/rooms/' . $room->image : 'images/room.svg') }}" alt="{{ $room->name }}" class="room-detail-img">
            </div>
            <!-- Info -->
            <div class="col-lg-5">
                <h2 class="text-navy mb-3">{{ $room->name }}</h2>
                <p class="text-muted">{{ $room->description }}</p>

                <div class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Price per night</span>
                        <span class="price fs-4">KES {{ number_format($room->price, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Capacity</span>
                        <strong>{{ $room->capacity }} Guest{{ $room->capacity > 1 ? 's' : '' }}</strong>
                    </div>
                </div>

                <h5 class="text-navy mt-4 mb-3">Amenities</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="amenity-item"><i class="bi bi-wifi"></i> WiFi</div>
                    </div>
                    <div class="col-6">
                        <div class="amenity-item"><i class="bi bi-tv"></i> Smart TV</div>
                    </div>
                    <div class="col-6">
                        <div class="amenity-item"><i class="bi bi-snow"></i> Air Conditioning</div>
                    </div>
                    <div class="col-6">
                        <div class="amenity-item"><i class="bi bi-cup-straw"></i> Mini-bar</div>
                    </div>
                </div>

                <a href="{{ url('/booking/' . $room->id) }}" class="btn btn-gold btn-lg w-100 mt-4">Book Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Related Rooms -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-heading">
            <h2>Other Rooms You May Like</h2>
            <span class="gold-line"></span>
        </div>
        <div class="row g-4">
            @foreach($relatedRooms as $related)
                <div class="col-md-4">
                    <div class="card card-room">
                        <img src="{{ $related->image && str_starts_with($related->image, 'http') ? $related->image : asset($related->image ? 'uploads/rooms/' . $related->image : 'images/room.svg') }}" alt="{{ $related->name }}" class="related-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $related->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($related->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">KES {{ number_format($related->price, 0) }}</span>
                                <a href="{{ url('/rooms/' . $related->id) }}" class="btn btn-outline-gold btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
