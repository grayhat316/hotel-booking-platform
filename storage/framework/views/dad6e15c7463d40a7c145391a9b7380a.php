

<?php $__env->startSection('title', 'Event Spaces - The Grand Hotel & Spa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .page-header {
        background: linear-gradient(rgba(26, 58, 92, 0.80), rgba(26, 58, 92, 0.90)),
                    url("<?php echo e(asset('images/gallery.svg')); ?>") center/cover no-repeat;
        padding: 6rem 0;
        text-align: center;
        color: #fff;
    }

    .page-header h1 {
        color: #fff;
        font-size: 2.75rem;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        font-size: 1.15rem;
        font-weight: 300;
        opacity: 0.9;
    }

    .service-card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        height: 100%;
        background: #fff;
        position: relative;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(201, 169, 110, 0.18);
    }

    .service-card .card-img-top {
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .service-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .service-card .card-body {
        padding: 1.5rem;
    }

    .service-card .card-title {
        color: var(--navy);
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
    }

    .service-card .card-text {
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .service-card .capacity-badge {
        background-color: var(--gold);
        color: #fff;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .service-card .price-tag {
        color: var(--navy);
        font-weight: 700;
        font-size: 1.15rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .cta-events {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        border-radius: 0.75rem;
        padding: 3.5rem 2rem;
        text-align: center;
        color: #fff;
    }

    .cta-events h2 {
        color: #fff;
        margin-bottom: 1rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Event Spaces</h1>
        <p>Beautiful venues for unforgettable celebrations and occasions</p>
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
            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <img src="<?php echo e($service->image_url); ?>" alt="<?php echo e($service->name); ?>" class="card-img-top">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0"><?php echo e($service->name); ?></h5>
                            </div>
                            <p class="card-text text-muted mb-3"><?php echo e(Str::limit($service->description, 100)); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="capacity-badge"><i class="bi bi-people-fill"></i><?php echo e($service->capacity ?? 'N/A'); ?></span>
                                <span class="price-tag"><i class="bi bi-tag-fill"></i>KES <?php echo e(number_format($service->price, 0)); ?></span>
                            </div>
                            <a href="<?php echo e(url('/contact')); ?>" class="btn btn-gold btn-sm w-100 mt-3">
                                <i class="bi bi-envelope me-1"></i>Book Inquiry
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-calendar-x fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted fs-5">No event spaces available at the moment.</p>
                    <a href="<?php echo e(url('/contact')); ?>" class="btn btn-outline-gold">Contact Us for Availability</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="cta-events">
            <h2>Host Your Dream Event With Us</h2>
            <p class="mb-4">Let our dedicated team bring your vision to life, from décor to catering.</p>
            <a href="<?php echo e(url('/contact')); ?>" class="btn btn-navy btn-lg">
                <i class="bi bi-chat-dots me-2"></i>Plan Your Event
            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/public/events.blade.php ENDPATH**/ ?>