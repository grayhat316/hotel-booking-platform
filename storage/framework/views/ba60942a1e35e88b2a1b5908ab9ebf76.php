

<?php $__env->startSection('title', 'Dining - The Grand Hotel & Spa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .page-header {
        background: linear-gradient(rgba(26, 58, 92, 0.75), rgba(26, 58, 92, 0.85)),
                    url("<?php echo e(asset('images/food.svg')); ?>") center/cover no-repeat;
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

    .filter-tabs {
        justify-content: center;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .filter-tabs .nav-link {
        border: 1px solid var(--gold);
        color: var(--navy);
        border-radius: 2rem;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-tabs .nav-link:hover,
    .filter-tabs .nav-link.active {
        background-color: var(--gold);
        color: #fff;
        border-color: var(--gold);
    }

    .food-img {
        height: 200px;
        object-fit: cover;
    }

    .category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Dining</h1>
        <p>Indulge in culinary excellence</p>
    </div>
</section>

<!-- Dining Content -->
<section class="py-5">
    <div class="container">
        <!-- Filter Tabs -->
        <ul class="nav nav-pills filter-tabs" id="dining-filters" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" type="button" data-filter="all">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" type="button" data-filter="Main Course">Main Course</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" type="button" data-filter="Beverages">Beverages</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" type="button" data-filter="Grills">Grills</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" type="button" data-filter="Vegetarian">Vegetarian</button>
            </li>
        </ul>

        <!-- Food Grid -->
        <div class="row g-4" id="food-grid">
            <?php $__empty_1 = true; $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-3 col-md-4 col-sm-6 food-item" data-category="<?php echo e($food->category); ?>">
                    <div class="card card-room position-relative">
                        <img src="<?php echo e($food->image_url); ?>" alt="<?php echo e($food->name); ?>" class="food-img">
                        <span class="badge bg-gold category-badge"><?php echo e($food->category); ?></span>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($food->name); ?></h5>
                            <p class="text-muted small"><?php echo e(Str::limit($food->description, 60)); ?></p>
                            <span class="price">KES <?php echo e(number_format($food->price, 0)); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No dining items available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.querySelectorAll('#dining-filters .nav-link').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#dining-filters .nav-link').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.food-item').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/public/dining.blade.php ENDPATH**/ ?>