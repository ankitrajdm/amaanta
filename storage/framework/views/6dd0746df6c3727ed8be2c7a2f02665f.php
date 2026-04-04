

<?php $__env->startSection('title', 'Gallery'); ?>
<?php $__env->startSection('page-title', 'Gallery'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success"><?php echo e(session('status')); ?></div>
<?php endif; ?>
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Gallery</h1>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.gallery.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Upload Images
            </a>
            <a href="<?php echo e(route('admin.sliders.create')); ?>" class="btn btn-success">
                <i class="fas fa-images"></i> Create Slider
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.gallery.store')); ?>" enctype="multipart/form-data" class="row g-3 mb-4">
            <?php echo csrf_field(); ?>
            <div class="col-md-3">
                <input type="text" name="title" placeholder="Title" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="file" name="image[]" accept="image/*" multiple class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="service_id" class="form-control">
                    <option value="">Select Service (Optional)</option>
                    <?php $__currentLoopData = \App\Models\Service::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>"><?php echo e($service->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="event_id" class="form-control">
                    <option value="">Select Event (Optional)</option>
                    <?php $__currentLoopData = \App\Models\Event::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($event->id); ?>"><?php echo e($event->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">Upload</button>
            </div>
        </form>

        <div class="row">
            <?php $__currentLoopData = $groupedImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><?php echo e($title); ?></h4>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" onclick="editGroup('<?php echo e($title); ?>')">
                                    <i class="fas fa-edit"></i> Edit Group
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteGroup('<?php echo e($title); ?>')">
                                    <i class="fas fa-trash"></i> Delete Group
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                        <div class="card h-100">
                                            <img src="<?php echo e(asset(ltrim($image->image_path, '/'))); ?>" class="card-img-top" alt="<?php echo e($image->title); ?>" style="height: 200px; object-fit: cover;">
                                            <div class="card-body p-2">
                                                <p class="card-text small mb-2">
                                                    <strong>Event:</strong> <?php echo e($image->event ? $image->event->title : 'N/A'); ?><br>
                                                    <strong>Service:</strong> <?php echo e($image->service ? $image->service->title : 'N/A'); ?>

                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-sm btn-outline-primary" onclick="editImage(<?php echo e($image->id); ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteImage(<?php echo e($image->id); ?>, '<?php echo e($image->title); ?>')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script>
function editGroup(title) {
    // Redirect to create page with title pre-filled for editing group
    window.location.href = '<?php echo e(route("admin.gallery.create")); ?>?edit_group=' + encodeURIComponent(title);
}

function deleteGroup(title) {
    if (confirm('Are you sure you want to delete all images in the "' + title + '" group?')) {
        // Create a form to submit delete request for all images in the group
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo e(route("admin.gallery.delete-group")); ?>';
        form.innerHTML = `
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <input type="hidden" name="title" value="${title}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

function editImage(imageId) {
    window.location.href = '<?php echo e(route("admin.gallery.edit", ":id")); ?>'.replace(':id', imageId);
}

function deleteImage(imageId, title) {
    if (confirm('Are you sure you want to delete this image from "' + title + '" group?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo e(route("admin.gallery.destroy", ":id")); ?>'.replace(':id', imageId);
        form.innerHTML = `
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>