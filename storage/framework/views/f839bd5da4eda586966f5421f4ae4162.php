

<?php $__env->startSection('content'); ?>
<h1>Admin Panel Overview</h1>
<p>All website pages and sections are managed from this panel.</p>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">
    <tr><th>Module</th><th>Action</th></tr>
    <tr><td>Dashboard</td><td><a href="<?php echo e(route('admin.dashboard')); ?>">Open</a></td></tr>
    <tr><td>Pages</td><td><a href="<?php echo e(route('admin.pages.index')); ?>">Manage sections (Home/About/Contact)</a></td></tr>
    <tr><td>Posts / Blog Manager</td><td><a href="<?php echo e(route('admin.posts.index')); ?>">Create / edit / publish posts</a></td></tr>
    <tr><td>Gallery Images</td><td><a href="<?php echo e(route('admin.gallery.index')); ?>">Manage memorybook gallery</a></td></tr>
    <tr><td>Testimonials</td><td><a href="<?php echo e(route('admin.testimonials.index')); ?>">Add / edit testimonials</a></td></tr>
    <tr><td>Contact Form Management</td><td><a href="<?php echo e(route('admin.enquiries.index')); ?>">View all enquiries</a></td></tr>
    <tr><td>Menu</td><td><a href="<?php echo e(route('admin.menus.index')); ?>">Header / footer menu items</a></td></tr>
    <?php if(auth()->user()->isAdmin()): ?><tr><td>Website Settings</td><td><a href="<?php echo e(route('admin.settings.index')); ?>">Logo, social links, copyright</a></td></tr><?php endif; ?>
</table>

<ul>
    <li>Users: <?php echo e($stats['users']); ?></li>
    <li>Pages: <?php echo e($stats['pages']); ?></li>
    <li>Posts: <?php echo e($stats['posts']); ?></li>
    <li>Testimonials: <?php echo e($stats['testimonials']); ?></li>
    <li>Gallery Images: <?php echo e($stats['gallery']); ?></li>
    <li>Enquiries: <?php echo e($stats['enquiries']); ?></li>
</ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>