

<?php $__env->startSection('title', $room->name . ' - The Grand Hotel & Spa'); ?>

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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1><?php echo e($room->name); ?></h1>
    </div>
</section>

<!-- Room Detail -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Image -->
            <div class="col-lg-7">
                <img src="<?php echo e($room->image_url); ?>" alt="<?php echo e($room->name); ?>" class="room-detail-img">
            </div>
            <!-- Info -->
            <div class="col-lg-5">
                <h2 class="text-navy mb-3"><?php echo e($room->name); ?></h2>
                <p class="text-muted"><?php echo e($room->description); ?></p>

                <div class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Price per night</span>
                        <span class="price fs-4">KES <?php echo e(number_format($room->price, 0)); ?></span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Capacity</span>
                        <strong><?php echo e($room->capacity); ?> Guest<?php echo e($room->capacity > 1 ? 's' : ''); ?></strong>
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

                <a href="<?php echo e(url('/booking/' . $room->id)); ?>" class="btn btn-gold btn-lg w-100 mt-4">Book Now</a>
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
            <?php $__currentLoopData = $relatedRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card card-room">
                        <img src="<?php echo e($related->image_url); ?>" alt="<?php echo e($related->name); ?>" class="related-img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($related->name); ?></h5>
                            <p class="text-muted small"><?php echo e(Str::limit($related->description, 80)); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">KES <?php echo e(number_format($related->price, 0)); ?></span>
                                <a href="<?php echo e(url('/rooms/' . $related->id)); ?>" class="btn btn-outline-gold btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/public/rooms-show.blade.php ENDPATH**/ ?>