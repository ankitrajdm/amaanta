

<?php $__env->startSection('title', 'Testimonials'); ?>
<?php $__env->startSection('page-title', 'Testimonials'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Testimonials</h1>
        <a href="<?php echo e(route('admin.testimonials.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Testimonial
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-start">
                <div>
                    <strong><?php echo e($t->author_name); ?></strong> <span class="text-muted">— <?php echo e($t->author_title); ?></span>
                    <p class="mb-0"><?php echo e($t->quote); ?></p>
                </div>
                <div>
                    <a href="<?php echo e(route('admin.testimonials.edit', $t)); ?>" class="btn btn-sm btn-info">Edit</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>