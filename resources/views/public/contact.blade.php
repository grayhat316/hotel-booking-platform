@extends('layouts.public')

@section('title', 'Contact Us - The Grand Hotel & Spa')

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

    .contact-info-card {
        background: #fff;
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        height: 100%;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-3px);
    }

    .contact-info-card .icon {
        font-size: 2.25rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .contact-info-card h5 {
        color: var(--navy);
        margin-bottom: 0.5rem;
    }

    .contact-info-card p {
        color: #666;
        margin: 0;
    }

    .contact-form-card {
        background: #fff;
        border-radius: 0.5rem;
        padding: 2.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .contact-form-card h3 {
        color: var(--navy);
        margin-bottom: 1.5rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 0.2rem rgba(201, 169, 110, 0.25);
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We would love to hear from you</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <!-- Contact Info Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <i class="bi bi-geo-alt-fill icon"></i>
                    <h5>Address</h5>
                    <p>123 Grand Avenue<br>City Center, Nairobi</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <i class="bi bi-telephone-fill icon"></i>
                    <h5>Phone</h5>
                    <p>+254 (712) 345-678<br>+254 (700) 123-456</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <i class="bi bi-envelope-fill icon"></i>
                    <h5>Email</h5>
                    <p>info@grandhotel.com<br>reservations@grandhotel.com</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <i class="bi bi-clock-fill icon"></i>
                    <h5>Office Hours</h5>
                    <p>Front Desk: 24/7<br>Admin: 8am - 6pm</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <h3>Send Us a Message</h3>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ url('/contact') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+254 7XX XXX XXX">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label fw-semibold">Subject *</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Booking Inquiry" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold">Message *</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gold btn-lg w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
