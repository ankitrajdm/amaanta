

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
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo e(asset('storage/' . ltrim($image->image_path, '/'))); ?>" class="card-img-top" alt="<?php echo e($image->title); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($image->title); ?></h5>
                            <p class="card-text">
                                <strong>Event:</strong> <?php echo e($image->event ? $image->event->title : 'N/A'); ?><br>
                                <strong>Service:</strong> <?php echo e($image->service ? $image->service->title : 'N/A'); ?>

                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo e(route('admin.gallery.edit', $image)); ?>" class="btn btn-sm btn-primary">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.gallery.destroy', $image)); ?>" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>