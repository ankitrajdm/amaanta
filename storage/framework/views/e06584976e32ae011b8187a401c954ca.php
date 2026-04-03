

<?php $__env->startSection('title', 'Guest Feedbacks'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Guest Feedbacks</h1>
            <div>
                <a href="<?php echo e(route('admin.guest-feedbacks.export', request()->query())); ?>" class="btn btn-success me-2">
                    <i class="fas fa-download"></i> Export to Excel
                </a>
                <a href="<?php echo e(route('admin.guest-feedbacks.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Guest Feedback
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Date Filter Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Guest Feedbacks</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('admin.guest-feedbacks.index')); ?>" class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo e(request('start_date')); ?>">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo e(request('end_date')); ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="<?php echo e(route('admin.guest-feedbacks.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

<?php if($guestFeedbacks->count() > 0): ?>
<div class="card">
    <div class="card-header">
        <h5>Guest Feedbacks List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest Name</th>
                        <th>Room #</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Service Quality</th>
                        <th>Cleanliness</th>
                        <th>Staff</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $guestFeedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($feedback->id); ?></td>
                        <td><?php echo e($feedback->guest_name); ?></td>
                        <td><?php echo e($feedback->room_number); ?></td>
                        <td><?php echo e($feedback->check_in_date ? $feedback->check_in_date->format('d M Y') : '-'); ?></td>
                        <td><?php echo e($feedback->check_out_date ? $feedback->check_out_date->format('d M Y') : '-'); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($feedback->service_quality === 'Excellent' ? 'success' : ($feedback->service_quality === 'Very Good' ? 'primary' : ($feedback->service_quality === 'Good' ? 'info' : ($feedback->service_quality === 'Satisfactory' ? 'warning' : 'danger')))); ?>">
                                <?php echo e($feedback->service_quality); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($feedback->cleanliness === 'Excellent' ? 'success' : ($feedback->cleanliness === 'Very Good' ? 'primary' : ($feedback->cleanliness === 'Good' ? 'info' : ($feedback->cleanliness === 'Satisfactory' ? 'warning' : 'danger')))); ?>">
                                <?php echo e($feedback->cleanliness); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($feedback->staff_rating === 'Excellent' ? 'success' : ($feedback->staff_rating === 'Very Good' ? 'primary' : ($feedback->staff_rating === 'Good' ? 'info' : ($feedback->staff_rating === 'Satisfactory' ? 'warning' : 'danger')))); ?>">
                                <?php echo e($feedback->staff_rating); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($feedback->status === 'new' ? 'primary' : ($feedback->status === 'reviewed' ? 'success' : 'secondary')); ?>">
                                <?php echo e(ucfirst($feedback->status)); ?>

                            </span>
                        </td>
                        <td><?php echo e($feedback->created_at->format('d M Y H:i')); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('admin.guest-feedbacks.show', $feedback)); ?>" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.guest-feedbacks.edit', $feedback)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.guest-feedbacks.destroy', $feedback)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($guestFeedbacks->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
        <h5>No Guest Feedbacks Found</h5>
        <p class="text-muted">There are no guest feedbacks matching your criteria.</p>
        <a href="<?php echo e(route('admin.guest-feedbacks.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add First Feedback
        </a>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\guest-feedbacks\index.blade.php ENDPATH**/ ?>