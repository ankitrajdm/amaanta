

<?php $__env->startSection('content'); ?>
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #333;">Thank you for your inquiry!</h2>

    <p>Dear <?php echo e($contactForm->name); ?>,</p>

    <p>Thank you for reaching out to Amaanta Farms. We have received your inquiry and will get back to you within 24 hours.</p>

    <div style="background-color: #f9f9f9; padding: 20px; margin: 20px 0; border-radius: 5px;">
        <h3>Your Submission Details:</h3>
        <p><strong>Event Type:</strong> <?php echo e($contactForm->event_type); ?></p>
        <p><strong>Event Date:</strong> <?php echo e($contactForm->event_date ? $contactForm->event_date->format('d M Y') : 'Not specified'); ?></p>
        <p><strong>Number of Guests:</strong> <?php echo e($contactForm->guests); ?></p>
        <p><strong>Services Required:</strong> <?php echo e($contactForm->services ? implode(', ', $contactForm->services) : 'None'); ?></p>
        <p><strong>Budget:</strong> <?php echo e($contactForm->budget); ?></p>
    </div>

    <p>If you have any urgent questions, please call us at +91-9971009669.</p>

    <p>Best regards,<br>
    The Amaanta Farms Team</p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.email', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\emails\contact-form-confirmation.blade.php ENDPATH**/ ?>