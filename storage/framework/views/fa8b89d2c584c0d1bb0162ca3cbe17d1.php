

<?php $__env->startSection('title', 'Edit Booking'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit Booking</h1>
            <a href="<?php echo e(route('admin.bookings.show', $booking)); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Details
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.bookings.update', $booking)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
                <!-- Customer Name -->
                <div class="col-md-6 mb-3">
                    <label for="customer_name" class="form-label">Customer Name *</label>
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo e(old('customer_name', $booking->customer_name)); ?>" class="form-control" required>
                    <?php $__errorArgs = ['customer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone', $booking->phone)); ?>" class="form-control" required>
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Event Date -->
                <div class="col-md-6 mb-3">
                    <label for="event_date" class="form-label">Event Date *</label>
                    <input type="date" id="event_date" name="event_date" value="<?php echo e(old('event_date', $booking->event_date ? $booking->event_date->format('Y-m-d') : '')); ?>" class="form-control" required>
                    <?php $__errorArgs = ['event_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="pending" <?php echo e(old('status', $booking->status) == 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="confirmed" <?php echo e(old('status', $booking->status) == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                        <option value="completed" <?php echo e(old('status', $booking->status) == 'completed' ? 'selected' : ''); ?>>Completed</option>
                        <option value="cancelled" <?php echo e(old('status', $booking->status) == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Cost Breakdown -->
            <h5 class="mt-4 mb-3">Cost Breakdown</h5>
            <div class="row">
                <!-- Lawn Cost -->
                <div class="col-md-6 mb-3">
                    <label for="lawn_cost" class="form-label">Lawn Cost (₹)</label>
                    <input type="number" id="lawn_cost" name="lawn_cost" step="0.01" min="0" value="<?php echo e(old('lawn_cost', $booking->lawn_cost ?? '')); ?>" class="form-control">
                    <?php $__errorArgs = ['lawn_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Decoration Cost -->
                <div class="col-md-6 mb-3">
                    <label for="decoration_cost" class="form-label">Decoration Cost (₹)</label>
                    <input type="number" id="decoration_cost" name="decoration_cost" step="0.01" min="0" value="<?php echo e(old('decoration_cost', $booking->decoration_cost ?? '')); ?>" class="form-control">
                    <?php $__errorArgs = ['decoration_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Catering Cost -->
                <div class="col-md-6 mb-3">
                    <label for="catering_cost" class="form-label">Catering Cost (₹)</label>
                    <input type="number" id="catering_cost" name="catering_cost" step="0.01" min="0" value="<?php echo e(old('catering_cost', $booking->catering_cost ?? '')); ?>" class="form-control">
                    <?php $__errorArgs = ['catering_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Other Charges -->
                <div class="col-md-6 mb-3">
                    <label for="other_charges" class="form-label">Other Charges (₹)</label>
                    <input type="number" id="other_charges" name="other_charges" step="0.01" min="0" value="<?php echo e(old('other_charges', $booking->other_charges ?? '')); ?>" class="form-control">
                    <?php $__errorArgs = ['other_charges'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Total Cost -->
                <div class="col-md-6 mb-3">
                    <label for="total_cost" class="form-label">Total Cost (₹) *</label>
                    <input type="number" id="total_cost" name="total_cost" step="0.01" min="0" value="<?php echo e(old('total_cost', $booking->total_cost)); ?>" class="form-control" required>
                    <?php $__errorArgs = ['total_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Advance Payment -->
                <div class="col-md-6 mb-3">
                    <label for="advance_payment" class="form-label">Advance Payment (₹) *</label>
                    <input type="number" id="advance_payment" name="advance_payment" step="0.01" min="0" value="<?php echo e(old('advance_payment', $booking->advance_payment)); ?>" class="form-control" required>
                    <?php $__errorArgs = ['advance_payment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Payment Mode -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="payment_mode" class="form-label">Payment Mode *</label>
                    <select id="payment_mode" name="payment_mode" class="form-control" required>
                        <option value="">Select Payment Mode</option>
                        <option value="Cash" <?php echo e(old('payment_mode', $booking->payment_mode) == 'Cash' ? 'selected' : ''); ?>>Cash</option>
                        <option value="UPI" <?php echo e(old('payment_mode', $booking->payment_mode) == 'UPI' ? 'selected' : ''); ?>>UPI</option>
                        <option value="Bank Transfer" <?php echo e(old('payment_mode', $booking->payment_mode) == 'Bank Transfer' ? 'selected' : ''); ?>>Bank Transfer</option>
                    </select>
                    <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Additional Notes</label>
                <textarea id="notes" name="notes" rows="4" class="form-control"><?php echo e(old('notes', $booking->notes)); ?></textarea>
                <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('admin.bookings.show', $booking)); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Booking</button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-calculate total cost
document.addEventListener('DOMContentLoaded', function() {
    function calculateTotal() {
        const lawnCost = parseFloat(document.getElementById('lawn_cost').value) || 0;
        const decorationCost = parseFloat(document.getElementById('decoration_cost').value) || 0;
        const cateringCost = parseFloat(document.getElementById('catering_cost').value) || 0;
        const otherCharges = parseFloat(document.getElementById('other_charges').value) || 0;

        const total = lawnCost + decorationCost + cateringCost + otherCharges;
        document.getElementById('total_cost').value = total.toFixed(2);
    }

    // Add event listeners for cost calculation
    ['lawn_cost', 'decoration_cost', 'catering_cost', 'other_charges'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateTotal);
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/bookings/edit.blade.php ENDPATH**/ ?>