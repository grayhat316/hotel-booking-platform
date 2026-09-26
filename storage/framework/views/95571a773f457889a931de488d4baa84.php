

<?php $__env->startSection('title', 'Gallery - The Grand Hotel & Spa'); ?>

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

    .gallery-grid {
        columns: 3;
        column-gap: 1.5rem;
    }

    @media (max-width: 991.98px) {
        .gallery-grid {
            columns: 2;
        }
    }

    @media (max-width: 575.98px) {
        .gallery-grid {
            columns: 1;
        }
    }

    .gallery-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
        position: relative;
        border-radius: 0.5rem;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .gallery-item img {
        width: 100%;
        display: block;
        transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-item .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(26, 58, 92, 0.85));
        color: #fff;
        padding: 2rem 1.25rem 1.25rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .overlay {
        opacity: 1;
    }

    .gallery-item .overlay h5 {
        color: #fff;
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }

    .gallery-item .overlay p {
        font-size: 0.85rem;
        margin: 0;
        opacity: 0.85;
    }

    /* Lightbox */
    .lightbox-modal .modal-dialog {
        max-width: 90vw;
    }

    .lightbox-modal .modal-body {
        padding: 0;
        position: relative;
        background: #000;
    }

    .lightbox-modal .modal-body img {
        width: 100%;
        max-height: 85vh;
        object-fit: contain;
    }

    .lightbox-modal .lightbox-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: #fff;
        padding: 1rem;
        text-align: center;
    }

    .lightbox-close {
        position: absolute;
        top: 10px;
        right: 15px;
        color: #fff;
        font-size: 2rem;
        cursor: pointer;
        z-index: 10;
        text-shadow: 0 0 5px rgba(0,0,0,0.5);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Gallery</h1>
        <p>A visual journey through our hotel</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5">
    <div class="container">
        <div class="gallery-grid">
            <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#lightboxModal"
                                     data-image="<?php echo e($item->image_url); ?>"
                                     data-title="<?php echo e($item->title); ?>"
                                     data-description="<?php echo e($item->description); ?>">
                                    <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>" loading="lazy">
                    <div class="overlay">
                        <h5><?php echo e($item->title); ?></h5>
                        <?php if($item->description): ?>
                            <p><?php echo e(Str::limit($item->description, 60)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No gallery items yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade lightbox-modal" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-body">
            <span class="lightbox-close" data-bs-dismiss="modal">&times;</span>
            <img id="lightboxImage" src="" alt="">
            <div class="lightbox-caption" id="lightboxCaption"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const lightboxModal = document.getElementById('lightboxModal');
    lightboxModal.addEventListener('show.bs.modal', function(event) {
        const trigger = event.relatedTarget;
        const image = trigger.dataset.image;
        const title = trigger.dataset.title;
        const desc = trigger.dataset.description;

        document.getElementById('lightboxImage').src = image;
        const caption = document.getElementById('lightboxCaption');
        caption.innerHTML = '<strong>' + title + '</strong>' + (desc ? '<br><small>' + desc + '</small>' : '');
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\hotel-booking-v2\resources\views/public/gallery.blade.php ENDPATH**/ ?>