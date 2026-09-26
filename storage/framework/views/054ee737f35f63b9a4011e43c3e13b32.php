<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'The Grand Hotel & Spa'); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c9a96e;
            --gold-light: #e0c98e;
            --gold-dark: #a88b4f;
            --navy: #1a3a5c;
            --navy-light: #2a4a6c;
            --navy-dark: #0f2a4c;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: #333;
            background-color: #fff;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar-public {
            background-color: var(--navy) !important;
            padding: 0.75rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold) !important;
            letter-spacing: 1px;
        }

        .navbar-brand:hover {
            color: var(--gold-light) !important;
        }

        .navbar-public .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s ease;
        }

        .navbar-public .nav-link:hover,
        .navbar-public .nav-link.active {
            color: var(--gold) !important;
        }

        .navbar-toggler {
            border-color: var(--gold);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23c9a96e' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Buttons */
        .btn-gold {
            background-color: var(--gold);
            border-color: var(--gold);
            color: #fff;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: var(--gold-dark);
            border-color: var(--gold-dark);
            color: #fff;
        }

        .btn-navy {
            background-color: var(--navy);
            border-color: var(--navy);
            color: #fff;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-navy:hover {
            background-color: var(--navy-dark);
            border-color: var(--navy-dark);
            color: #fff;
        }

        .btn-outline-gold {
            border: 2px solid var(--gold);
            color: var(--gold);
            font-weight: 600;
            padding: 0.55rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-outline-gold:hover {
            background-color: var(--gold);
            color: #fff;
        }

        /* Section headings */
        .section-heading {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-heading h2 {
            font-size: 2.5rem;
            color: var(--navy);
            margin-bottom: 0.5rem;
        }

        .section-heading .gold-line {
            width: 60px;
            height: 3px;
            background-color: var(--gold);
            margin: 0 auto;
            display: block;
        }

        /* Footer */
        .footer {
            background-color: var(--navy);
            color: #fff;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }

        .footer h5 {
            color: var(--gold);
            margin-bottom: 1.5rem;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--gold);
        }

        .footer .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--gold);
            color: var(--gold);
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .footer .social-link:hover {
            background-color: var(--gold);
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(201,169,110,0.2);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: #aaa;
            font-size: 0.9rem;
        }

        /* Cards */
        .card-room {
            border: none;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .card-room:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .card-room img {
            height: 220px;
            object-fit: cover;
        }

        .card-room .card-body {
            padding: 1.5rem;
        }

        .card-room .card-title {
            color: var(--navy);
            font-size: 1.25rem;
        }

        .card-room .price {
            color: var(--gold);
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Utility */
        .text-gold { color: var(--gold) !important; }
        .text-navy { color: var(--navy) !important; }
        .bg-navy { background-color: var(--navy) !important; }
        .bg-gold { background-color: var(--gold) !important; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-public fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <i class="bi bi-gem me-2"></i>The Grand Hotel & Spa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic" aria-controls="navbarPublic" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPublic">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('rooms') ? 'active' : ''); ?>" href="<?php echo e(url('/rooms')); ?>">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('dining') ? 'active' : ''); ?>" href="<?php echo e(url('/dining')); ?>">Dining</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('conference') ? 'active' : ''); ?>" href="<?php echo e(url('/conference')); ?>">Conference</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('events') ? 'active' : ''); ?>" href="<?php echo e(url('/events')); ?>">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('gallery') ? 'active' : ''); ?>" href="<?php echo e(url('/gallery')); ?>">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(url('/contact')); ?>">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-gold btn-sm mt-lg-1" href="<?php echo e(url('/rooms')); ?>">Book Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 70px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5><i class="bi bi-gem me-2"></i>The Grand Hotel & Spa</h5>
                    <p class="text-secondary">Experience luxury and comfort in the heart of the city. Since 1985, we have been providing exceptional hospitality and unforgettable experiences for our guests.</p>
                    <div class="mt-3">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/rooms')); ?>">Rooms & Suites</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/dining')); ?>">Dining</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/conference')); ?>">Conference</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/events')); ?>">Events</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/gallery')); ?>">Gallery</a></li>
                        <li class="mb-2"><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-gold"></i>123 Grand Avenue, Eldoret, Kenya</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2 text-gold"></i>+254 700 000 000</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-gold"></i>info@grandhotel.co.ke</li>
                        <li class="mb-2"><i class="bi bi-clock-fill me-2 text-gold"></i>Open 24 hours, 7 days a week</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Newsletter</h5>
                    <p class="text-secondary">Subscribe to get special offers and updates.</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Your email" aria-label="Email">
                            <button class="btn btn-gold" type="submit"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo e(date('Y')); ?> The Grand Hotel & Spa. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/layouts/public.blade.php ENDPATH**/ ?>