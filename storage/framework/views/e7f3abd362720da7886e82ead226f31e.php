

<?php $__env->startSection('title', 'Our Rooms - The Grand Hotel & Spa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .page-header {
        background: linear-gradient(rgba(26, 58, 92, 0.75), rgba(26, 58, 92, 0.85)),
                    url("<?php echo e(asset('images/gallery.svg')); ?>") center/cover no-repeat;
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
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
            <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-room">
                        <img src="<?php echo e($room->image_url); ?>" alt="<?php echo e($room->name); ?>" class="card-room-img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($room->name); ?></h5>
                            <p class="text-muted small"><?php echo e(Str::limit($room->description, 100)); ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="price">KES <?php echo e(number_format($room->price, 0)); ?> <small class="text-muted">/ night</small></span>
                                <span class="badge bg-navy text-white"><?php echo e($room->capacity); ?> Guest<?php echo e($room->capacity > 1 ? 's' : ''); ?></span>
                            </div>
                            <a href="<?php echo e(url('/rooms/' . $room->id)); ?>" class="btn btn-outline-gold btn-sm w-100 mt-2">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No rooms available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/public/rooms.blade.php ENDPATH**/ ?>