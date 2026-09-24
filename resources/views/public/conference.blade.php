@extends('layouts.public')

@section('title', 'Conference & Events - The Grand Hotel & Spa')

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

    .conference-card {
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        background: #fff;
    }

    .conference-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .conference-card .card-body {
        padding: 1.75rem;
    }

    .conference-card .card-title {
        color: var(--navy);
        font-size: 1.25rem;
    }

    .conference-card .capacity-badge {
        background-color: var(--navy);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .conference-card .price {
        color: var(--gold);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .cta-conference {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
        border-radius: 0.5rem;
        padding: 3rem 2rem;
        text-align: center;
        color: #fff;
    }

    .cta-conference h2 {
        color: #fff;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Conference & Events</h1>
        <p>World-class facilities for meetings and gatherings</p>
    </div>
</section>

<!-- Conference Services -->
<section class="py-5">
    <div class="container">
        <div class="section-heading">
            <h2>Conference Services</h2>
            <span class="gold-line"></span>
            <p class="text-muted mt-2">Professional spaces designed for productivity</p>
        </div>
        <div class="row g-4">
            @forelse($services->where('type', 'conferencing') as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="conference-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">{{ $service->name }}</h5>
                                <span class="capacity-badge"><i class="bi bi-people-fill me-1"></i>{{ $service->capacity ?? 50 }}</span>
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
                    <p class="text-muted fs-5">No conferencing services available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="cta-conference">
            <h2>Need a Custom Conference Setup?</h2>
            <p class="text-white-50 mb-4">Our team will tailor the perfect environment for your event.</p>
            <a href="{{ url('/contact') }}" class="btn btn-gold btn-lg">Get in Touch</a>
        </div>
    </div>
</section>
@endsection
