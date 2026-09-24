@extends('layouts.public')

@section('title', 'Event Spaces - The Grand Hotel & Spa')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(rgba(26, 58, 92, 0.75), rgba(26, 58, 92, 0.85)),
                    url('https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&w=1920') center/cover no-repeat;
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

    .event-card {
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        background: #fff;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .event-card .card-body {
        padding: 1.75rem;
    }

    .event-card .card-title {
        color: var(--navy);
        font-size: 1.25rem;
    }

    .event-card .capacity-badge {
        background-color: var(--gold);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .event-card .price {
        color: var(--navy);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .cta-events {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        border-radius: 0.5rem;
        padding: 3rem 2rem;
        text-align: center;
        color: #fff;
    }

    .cta-events h2 {
        color: #fff;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Event Spaces</h1>
        <p>Beautiful venues for unforgettable celebrations</p>
    </div>
</section>

<!-- Event Services -->
<section class="py-5">
    <div class="container">
        <div class="section-heading">
            <h2>Event Venues</h2>
            <span class="gold-line"></span>
            <p class="text-muted mt-2">Elegant spaces for weddings, galas, and celebrations</p>
        </div>
        <div class="row g-4">
            @forelse($services->where('type', 'event') as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="event-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">{{ $service->name }}</h5>
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>{{ $service->capacity ?? 100 }}</span>
                            </div>
                            <p class="text-muted">{{ Str::limit($service->description, 120) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price">KES {{ number_format($service->price, 0) }}</span>
                                <a href="{{ url('/contact') }}" class="btn btn-outline-gold btn-sm">Inquire</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No event spaces available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="cta-events">
            <h2>Host Your Dream Event With Us</h2>
            <p class="mb-4">Let our dedicated team bring your vision to life.</p>
            <a href="{{ url('/contact') }}" class="btn btn-navy btn-lg">Plan Your Event</a>
        </div>
    </div>
</section>
@endsection
