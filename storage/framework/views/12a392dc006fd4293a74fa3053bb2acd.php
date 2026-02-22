

<?php $__env->startSection('content'); ?>
<h1><?php echo e($page?->title ?? 'Contact'); ?></h1>
<p>Phone: <?php echo e($settings['contact_no'] ?? 'N/A'); ?></p>
<p>Email: <?php echo e($settings['contact_email'] ?? 'N/A'); ?></p>
<p>Address: <?php echo e($settings['address'] ?? 'N/A'); ?></p>

<form method="POST" action="<?php echo e(route('contact.store')); ?>" style="display:grid; gap:0.5rem; max-width:500px;">
    <?php echo csrf_field(); ?>
    <input name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone">
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Submit Enquiry</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/contact.blade.php ENDPATH**/ ?>