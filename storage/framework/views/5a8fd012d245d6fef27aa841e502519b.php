

<?php $__env->startSection('title', isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image'); ?>
<?php $__env->startSection('page-title', isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1><?php echo e(isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image'); ?></h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(isset($image) ? route('admin.gallery.update', $image->id) : route('admin.gallery.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($image)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Image Title <span class="text-danger">*</span></label>
                <input type="text" name="title" value="<?php echo e(old('title', $image->title ?? '')); ?>" required class="form-control">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Service</label>
                <select name="service_id" class="form-control" id="service_id">
                    <option value="">Select Service (Optional)</option>
                    <?php $__currentLoopData = \App\Models\Service::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id', $image->service_id ?? '') == $service->id ? 'selected' : ''); ?>><?php echo e($service->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Event</label>
                <select name="event_id" class="form-control" id="event_id">
                    <option value="">Select Event (Optional)</option>
                    <?php $__currentLoopData = \App\Models\Event::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($event->id); ?>" <?php echo e(old('event_id', $image->event_id ?? '') == $event->id ? 'selected' : ''); ?>><?php echo e($event->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Image File <span class="text-danger">*</span></label>
                <input type="file" name="image<?php echo e(isset($image) ? '' : '[]'); ?>" accept="image/*" <?php echo e(isset($image) ? '' : 'multiple'); ?> <?php echo e(!isset($image) ? 'required' : ''); ?> class="form-control">
                <?php if(isset($image) && $image->image_path): ?>
                    <div class="mt-2 small text-muted">Current image: <?php echo e($image->image_path); ?></div>
                <?php endif; ?>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $image->is_active ?? true) ? 'checked' : ''); ?> class="form-check-input" id="is_active">
                <label for="is_active" class="form-check-label">Active (Show on website)</label>
            </div>

            <button type="submit" class="btn btn-success"><?php echo e(isset($image) ? 'Update' : 'Add'); ?> Image</button>
            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/gallery/create.blade.php ENDPATH**/ ?>