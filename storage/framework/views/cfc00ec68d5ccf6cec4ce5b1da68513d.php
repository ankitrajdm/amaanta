

<?php $__env->startSection('title', 'Contact Forms'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Contact Forms</h1>
            <div>
                <a href="<?php echo e(route('admin.contact-forms.export', request()->query())); ?>" class="btn btn-success me-2">
                    <i class="fas fa-download"></i> Export to Excel
                </a>
                <a href="<?php echo e(route('admin.contact-forms.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Contact Form
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Date Filter Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Contact Forms</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('admin.contact-forms.index')); ?>" class="row g-3">
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
                <a href="<?php echo e(route('admin.contact-forms.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

<?php if($contactForms->count() > 0): ?>
<div class="card">
    <div class="card-header">
        <h5>Contact Forms List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Event Type</th>
                        <th>Event Date</th>
                        <th>Guests</th>
                        <th>Services</th>
                        <th>Budget</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Responded At</th>
                        <th>Admin Notes</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contactForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($form->id); ?></td>
                        <td><?php echo e($form->name); ?></td>
                        <td><?php echo e($form->email); ?></td>
                        <td><?php echo e($form->phone); ?></td>
                        <td><?php echo e($form->event_type); ?></td>
                        <td><?php echo e($form->event_date ? $form->event_date->format('d M Y') : '-'); ?></td>
                        <td><?php echo e($form->guests); ?></td>
                        <td><?php echo e($form->services ? implode(', ', $form->services) : '-'); ?></td>
                        <td><?php echo e($form->budget); ?></td>
                        <td><?php echo e(Str::limit($form->message, 50)); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($form->status === 'active' ? 'success' : 'secondary'); ?>">
                                <?php echo e(ucfirst($form->status)); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo e($form->response_status === 'responded' ? 'success' : ($form->response_status === 'follow_up_needed' ? 'warning' : 'secondary')); ?>">
                                <?php echo e(ucfirst(str_replace('_', ' ', $form->response_status))); ?>

                            </span>
                        </td>
                        <td><?php echo e($form->responded_at ? $form->responded_at->format('d M Y H:i') : '-'); ?></td>
                        <td><?php echo e($form->admin_notes ? Str::limit($form->admin_notes, 30) : '-'); ?></td>
                        <td><?php echo e($form->created_at->format('d M Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.contact-forms.edit', $form)); ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('admin.contact-forms.destroy', $form)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this contact form?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <?php echo e($contactForms->links()); ?>

        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> No contact forms found. <a href="<?php echo e(route('admin.contact-forms.create')); ?>">Create one now</a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\contact-forms\index.blade.php ENDPATH**/ ?>