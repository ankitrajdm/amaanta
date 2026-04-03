

<?php $__env->startSection('content'); ?>
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #333;">New Contact Form Submission</h2>

    <div style="background-color: #f9f9f9; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h3>Contact Details:</h3>
        <p><strong>Name:</strong> <?php echo e($contactForm->name); ?></p>
        <p><strong>Email:</strong> <?php echo e($contactForm->email); ?></p>
        <p><strong>Phone:</strong> <?php echo e($contactForm->phone); ?></p>
        <p><strong>Event Type:</strong> <?php echo e($contactForm->event_type); ?></p>
        <p><strong>Event Date:</strong> <?php echo e($contactForm->event_date ? $contactForm->event_date->format('d M Y') : 'Not specified'); ?></p>
        <p><strong>Number of Guests:</strong> <?php echo e($contactForm->guests); ?></p>
        <p><strong>Services Required:</strong> <?php echo e($contactForm->services ? implode(', ', $contactForm->services) : 'None'); ?></p>
        <p><strong>Budget:</strong> <?php echo e($contactForm->budget); ?></p>
    </div>

    <div style="background-color: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ddd; border-radius: 5px;">
        <h3>Message:</h3>
        <p style="white-space: pre-wrap;"><?php echo e($contactForm->message); ?></p>
    </div>

    <p style="color: #666; font-size: 12px;">
        This email was sent from the Amaanta Farms contact form on <?php echo e(now()->format('d M Y \a\t H:i')); ?>.
    </p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\emails\contact-form-submitted.blade.php ENDPATH**/ ?>