

<?php $__env->startSection('title', 'View Guest Feedback'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Guest Feedback Details</h1>
            <div>
                <a href="<?php echo e(route('admin.guest-feedbacks.edit', $guestFeedback)); ?>" class="btn btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="<?php echo e(route('admin.guest-feedbacks.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>Feedback Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Guest Name:</strong><br>
                        <?php echo e($guestFeedback->guest_name); ?>

                    </div>
                    <div class="col-md-6">
                        <strong>Room Number:</strong><br>
                        <?php echo e($guestFeedback->room_number); ?>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Check-in Date:</strong><br>
                        <?php echo e($guestFeedback->check_in_date ? $guestFeedback->check_in_date->format('d M Y') : '-'); ?>

                    </div>
                    <div class="col-md-6">
                        <strong>Check-out Date:</strong><br>
                        <?php echo e($guestFeedback->check_out_date ? $guestFeedback->check_out_date->format('d M Y') : '-'); ?>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Heard About Us:</strong><br>
                        <span class="badge bg-info"><?php echo e($guestFeedback->heard_about_us); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Reservation Method:</strong><br>
                        <span class="badge bg-info"><?php echo e($guestFeedback->reservation_method); ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Purpose of Visit:</strong><br>
                        <span class="badge bg-primary"><?php echo e($guestFeedback->visit_purpose); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <span class="badge bg-<?php echo e($guestFeedback->status === 'new' ? 'primary' : ($guestFeedback->status === 'reviewed' ? 'success' : 'secondary')); ?>">
                            <?php echo e(ucfirst($guestFeedback->status)); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Ratings</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <div class="rating-item">
                            <h6>Service Quality</h6>
                            <div class="rating-badge <?php echo e($guestFeedback->service_quality === 'Excellent' ? 'excellent' : ($guestFeedback->service_quality === 'Very Good' ? 'very-good' : ($guestFeedback->service_quality === 'Good' ? 'good' : ($guestFeedback->service_quality === 'Satisfactory' ? 'satisfactory' : 'poor')))); ?>">
                                <?php echo e($guestFeedback->service_quality); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="rating-item">
                            <h6>Cleanliness</h6>
                            <div class="rating-badge <?php echo e($guestFeedback->cleanliness === 'Excellent' ? 'excellent' : ($guestFeedback->cleanliness === 'Very Good' ? 'very-good' : ($guestFeedback->cleanliness === 'Good' ? 'good' : ($guestFeedback->cleanliness === 'Satisfactory' ? 'satisfactory' : 'poor')))); ?>">
                                <?php echo e($guestFeedback->cleanliness); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="rating-item">
                            <h6>Staff</h6>
                            <div class="rating-badge <?php echo e($guestFeedback->staff_rating === 'Excellent' ? 'excellent' : ($guestFeedback->staff_rating === 'Very Good' ? 'very-good' : ($guestFeedback->staff_rating === 'Good' ? 'good' : ($guestFeedback->staff_rating === 'Satisfactory' ? 'satisfactory' : 'poor')))); ?>">
                                <?php echo e($guestFeedback->staff_rating); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($guestFeedback->additional_feedback): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h5>Additional Feedback</h5>
            </div>
            <div class="card-body">
                <p class="mb-0"><?php echo e($guestFeedback->additional_feedback); ?></p>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Metadata</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Feedback ID:</strong><br>
                    #<?php echo e($guestFeedback->id); ?>

                </div>
                <div class="mb-3">
                    <strong>Submitted At:</strong><br>
                    <?php echo e($guestFeedback->created_at->format('d M Y H:i:s')); ?>

                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <?php echo e($guestFeedback->updated_at->format('d M Y H:i:s')); ?>

                </div>
                <div class="mb-3">
                    <strong>Agreed to Submit:</strong><br>
                    <span class="badge bg-<?php echo e($guestFeedback->agree_to_submit ? 'success' : 'danger'); ?>">
                        <?php echo e($guestFeedback->agree_to_submit ? 'Yes' : 'No'); ?>

                    </span>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <?php if($guestFeedback->status === 'new'): ?>
                <form action="<?php echo e(route('admin.guest-feedbacks.update', $guestFeedback)); ?>" method="POST" class="mb-3">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="status" value="reviewed">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-check"></i> Mark as Reviewed
                    </button>
                </form>
                <?php endif; ?>

                <a href="<?php echo e(route('admin.guest-feedbacks.edit', $guestFeedback)); ?>" class="btn btn-warning w-100 mb-2">
                    <i class="fas fa-edit"></i> Edit Feedback
                </a>

                <form action="<?php echo e(route('admin.guest-feedbacks.destroy', $guestFeedback)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash"></i> Delete Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<style>
.rating-item h6 {
    margin-bottom: 0.5rem;
    color: #6c757d;
    font-weight: 600;
}

.rating-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    color: white;
    display: inline-block;
}

.rating-badge.excellent { background: linear-gradient(135deg, #10b981, #059669); }
.rating-badge.very-good { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.rating-badge.good { background: linear-gradient(135deg, #06b6d4, #0891b2); }
.rating-badge.satisfactory { background: linear-gradient(135deg, #f59e0b, #d97706); }
.rating-badge.poor { background: linear-gradient(135deg, #ef4444, #dc2626); }
</style>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\guest-feedbacks\show.blade.php ENDPATH**/ ?>