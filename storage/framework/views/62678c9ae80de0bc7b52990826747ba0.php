

<?php $__env->startSection('title', 'View Booking'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Booking Details</h1>
            <div>
                <a href="<?php echo e(route('admin.bookings.edit', $booking)); ?>" class="btn btn-primary me-2">
                    <i class="fas fa-edit"></i> Edit Booking
                </a>
                <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Customer Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Customer Name</label>
                    <p class="form-control-plaintext"><?php echo e($booking->customer_name); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone Number</label>
                    <p class="form-control-plaintext"><?php echo e($booking->phone); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Event Date</label>
                    <p class="form-control-plaintext"><?php echo e($booking->event_date ? $booking->event_date->format('F d, Y') : 'N/A'); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <p class="form-control-plaintext">
                        <span class="badge
                            <?php if($booking->status == 'pending'): ?> bg-warning
                            <?php elseif($booking->status == 'confirmed'): ?> bg-info
                            <?php elseif($booking->status == 'completed'): ?> bg-success
                            <?php else: ?> bg-danger <?php endif; ?>">
                            <?php echo e(ucfirst($booking->status)); ?>

                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Breakdown -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Cost Breakdown</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Lawn Cost</label>
                    <p class="form-control-plaintext">₹<?php echo e(number_format($booking->lawn_cost ?? 0, 2)); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Decoration Cost</label>
                    <p class="form-control-plaintext">₹<?php echo e(number_format($booking->decoration_cost ?? 0, 2)); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Catering Cost</label>
                    <p class="form-control-plaintext">₹<?php echo e(number_format($booking->catering_cost ?? 0, 2)); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Other Charges</label>
                    <p class="form-control-plaintext">₹<?php echo e(number_format($booking->other_charges ?? 0, 2)); ?></p>
                </div>
                <div class="mb-3 border-top pt-3">
                    <label class="form-label fw-bold">Total Cost</label>
                    <p class="form-control-plaintext fs-5 fw-bold">₹<?php echo e(number_format($booking->total_cost, 2)); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Information -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Payment Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Advance Payment</label>
                    <p class="form-control-plaintext">₹<?php echo e(number_format($booking->advance_payment, 2)); ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Payment Mode</label>
                    <p class="form-control-plaintext"><?php echo e($booking->payment_mode); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes -->
    <?php if($booking->notes): ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Additional Notes</h5>
            </div>
            <div class="card-body">
                <p class="form-control-plaintext" style="white-space: pre-wrap;"><?php echo e($booking->notes); ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Timestamps -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Created</label>
                        <p class="form-control-plaintext"><?php echo e($booking->created_at->format('F d, Y \a\t g:i A')); ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Last Updated</label>
                        <p class="form-control-plaintext"><?php echo e($booking->updated_at->format('F d, Y \a\t g:i A')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/bookings/show.blade.php ENDPATH**/ ?>