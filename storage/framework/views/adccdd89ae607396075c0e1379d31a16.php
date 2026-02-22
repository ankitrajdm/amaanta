

<?php $__env->startSection('content'); ?>
<h1><?php echo e($settings['website_name']); ?></h1>
<?php $__currentLoopData = ($page?->sections ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section style="margin: 1rem 0; border:1px solid #ddd; padding:1rem;">
        <h2><?php echo e($section->heading); ?></h2>
        <p><?php echo e($section->content); ?></p>
    </section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if($testimonials->isNotEmpty()): ?>
<h3>Testimonials</h3>
<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <blockquote>“<?php echo e($testimonial->quote); ?>” — <?php echo e($testimonial->author_name); ?></blockquote>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if($posts->isNotEmpty()): ?>
<h3>Latest Blog Posts</h3>
<ul>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($post->title); ?> (<?php echo e($post->category); ?>)</li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/home.blade.php ENDPATH**/ ?>