

<?php $__env->startSection('content'); ?>
<h1><?php echo e($page?->title ?? 'About'); ?></h1>
<?php $__currentLoopData = ($page?->sections ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section style="margin-bottom:1rem;">
        <h2><?php echo e($section->heading); ?></h2>
        <p><?php echo e($section->content); ?></p>
    </section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/about.blade.php ENDPATH**/ ?>