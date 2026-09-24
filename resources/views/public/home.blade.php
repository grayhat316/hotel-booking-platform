@extends('layouts.public')

@section('title', 'Welcome - The Grand Hotel & Spa')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(rgba(26, 58, 92, 0.55), rgba(26, 58, 92, 0.65)),
                    url("https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920&q=75") center/cover no-repeat;
        min-height: 90vh;
        display: flex;
        align-items: center;
        text-align: center;
        color: #fff;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 1rem;
    }

    .hero-section .subtitle {
        font-size: 1.25rem;
        font-weight: 300;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .service-card {
        text-align: center;
        padding: 2rem 1.5rem;
        border-radius: 0.5rem;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .service-card .service-icon {
        font-size: 2.5rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .service-card h5 {
        color: var(--navy);
        margin-bottom: 0.5rem;
    }

    .cta-banner {
        background: linear-gradient(rgba(26, 58, 92, 0.85), rgba(26, 58, 92, 0.9)),
                    url("https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920&q=75") center/cover no-repeat fixed;
        padding: 4rem 2rem;
        text-align: center;
        color: #fff;
        border-radius: 0.5rem;
    }

    .cta-banner h2 {
        color: #fff;
        font-size: 2.25rem;
        margin-bottom: 1rem;
    }

    .featured-food-img {
        height: 180px;
        object-fit: cover;
    }

    .card-room img {
        height: 220px;
        object-fit: cover;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>Welcome to Our Hotel</h1>
        <p class="subtitle">Experience unparalleled luxury, comfort, and elegance in the heart of the city. Your perfect stay awaits.</p>
        <a href="{{ url('/rooms') }}" class="btn btn-gold btn-lg">Find Your Room</a>
    </div>
</section>

<!-- Featured Rooms -->
<section class="py-5">
    <div class="container">
        <div class="section-heading">
            <h2>Featured Rooms</h2>
            <span class="gold-line"></span>
            <p class="text-muted mt-2">Handpicked rooms for the finest experience</p>
        </div>
        <div class="row g-4">
            @forelse($rooms->take(3) as $room)
                <div class="col-md-4">
                    <div class="card card-room">
                        <img src="{{ $room->image_url }}" alt="{{ $room->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($room->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price">KES {{ number_format($room->price, 0) }} <small class="text-muted">/ night</small></span>
                                <a href="{{ url('/rooms/' . $room->id) }}" class="btn btn-outline-gold btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Dining -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-heading">
            <h2>Featured Dining</h2>
            <span class="gold-line"></span>
            <p class="text-muted mt-2">Savor our culinary masterpieces</p>
        </div>
        <div class="row g-4">
            @forelse($foods->take(4) as $food)
                <div class="col-md-3">
                    <div class="card card-room">
                        <img src="{{ $food->image_url }}" alt="{{ $food->name }}" class="featured-food-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $food->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($food->description, 60) }}</p>
                            <span class="price">KES {{ number_format($food->price, 0) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No dining items available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="section-heading">
            <h2>Our Services</h2>
            <span class="gold-line"></span>
        </div>
        <div class="row g-4">
            @if(isset($services) && count($services) > 0)
                @foreach($services as $service)
                    <div class="col-md-3">
                        <div class="service-card">
                            <i class="bi bi-gem service-icon"></i>
                            <h5>{{ $service->name }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($service->description, 80) }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-3">
                    <div class="service-card">
                        <i class="bi bi-flower2 service-icon"></i>
                        <h5>Spa</h5>
                        <p class="text-muted small mb-0">Rejuvenate your body and soul at our world-class spa.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card">
                        <i class="bi bi-cup-hot service-icon"></i>
                        <h5>Dining</h5>
                        <p class="text-muted small mb-0">Exquisite cuisine prepared by award-winning chefs.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card">
                        <i class="bi bi-people service-icon"></i>
                        <h5>Conference</h5>
                        <p class="text-muted small mb-0">State-of-the-art meeting and event facilities.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-card">
                        <i class="bi bi-car-front service-icon"></i>
                        <h5>Parking</h5>
                        <p class="text-muted small mb-0">Secure and convenient valet parking available.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="py-5">
    <div class="container">
        <div class="cta-banner">
            <h2>Ready for an Unforgettable Stay?</h2>
            <p class="mb-4">Book your room today and experience luxury like never before.</p>
            <a href="{{ url('/rooms') }}" class="btn btn-gold btn-lg">Book Your Room</a>
        </div>
    </div>
</section>
@endsection
