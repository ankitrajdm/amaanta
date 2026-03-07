

<?php $__env->startSection('styles'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $sections = $page && $page->sections ? collect($page->sections)->keyBy('section_key') : collect();
?>

<!-- Hero Section -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 100px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;"><?php echo $sections['hero']->heading ?? 'Memorybook & Gallery'; ?></h1>
        <p class="lead"><?php echo $sections['hero']->content ?? 'Captured moments from our events'; ?></p>
    </div>
</section>

<!-- Gallery Section -->
<section>
    <div class="container">
        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $images = \App\Models\GalleryImage::where('event_name', $event->title)->where('is_active', true)->get(); ?>
            <div class="mb-5">
                <h2 class="section-heading" style="text-align: left;"><?php echo e($event->title); ?></h2>

                <?php if($images->count() > 0): ?>
                    <div class="gallery-grid">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="gallery-item">
                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($image->title); ?>">
                                <div class="gallery-overlay">
                                    <a href="<?php echo e(asset('storage/' . $image->image_path)); ?>" data-lightbox="gallery-<?php echo e($loop->index); ?>" title="<?php echo e($image->title); ?>">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">No images available for this event yet.</div>
                <?php endif; ?>
            </div>

            <?php if(!$loop->last): ?>
                <hr class="my-5">
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No events with photos available at the moment.
            </div>
        <?php endif; ?>

        <!-- All Images Gallery -->
        <?php if($allImages && $allImages->count() > 0): ?>
            <div class="mt-5 pt-5 border-top">
                <h2 class="section-heading">All Gallery Images</h2>
                <div class="gallery-grid">
                    <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="gallery-item">
                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($image->title); ?>">
                            <div class="gallery-overlay">
                                <a href="<?php echo e(asset('storage/' . $image->image_path)); ?>" data-lightbox="all-gallery" title="<?php echo e($image->title); ?>">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 80px 0; text-align: center;">
    <div class="container">
        <h2 class="display-5 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Create Your Own Memories</h2>
        <p class="lead mb-4">Let us help you organize your next event</p>
        <a href="/contact" class="btn btn-primary">
            <i class="fas fa-envelope"></i> Plan Your Event
        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': false,
        'albumLabel': 'Photo %1 of %2'
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/gallery.blade.php ENDPATH**/ ?>