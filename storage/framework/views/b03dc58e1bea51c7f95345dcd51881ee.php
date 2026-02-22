
<?php $__env->startSection('content'); ?>
<h1>Manage Pages</h1>
<ul>
<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><a href="<?php echo e(route('admin.pages.edit', $page)); ?>"><?php echo e($page->title); ?></a> (<?php echo e($page->sections_count); ?> sections)</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>