

<?php $__env->startSection('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial'); ?>
<?php $__env->startSection('page-title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1><?php echo e(isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial'); ?></h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store')); ?>">
            <?php echo csrf_field(); ?>
            <?php if(isset($testimonial)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Author Name <span class="text-danger">*</span></label>
                <input type="text" name="author_name" value="<?php echo e(old('author_name', $testimonial->author_name ?? '')); ?>" required class="form-control">
                <?php $__errorArgs = ['author_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Author Title</label>
                <input type="text" name="author_title" value="<?php echo e(old('author_title', $testimonial->author_title ?? '')); ?>" placeholder="e.g., CEO, Client" class="form-control">
                <?php $__errorArgs = ['author_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Testimonial <span class="text-danger">*</span></label>
                <textarea name="quote" required rows="5" class="form-control"><?php echo e(old('quote', $testimonial->quote ?? '')); ?></textarea>
                <?php $__errorArgs = ['quote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $testimonial->is_active ?? true) ? 'checked' : ''); ?> class="form-check-input" id="is_active">
                <label for="is_active" class="form-check-label">Active (Show on website)</label>
            </div>

            <button type="submit" class="btn btn-success"><?php echo e(isset($testimonial) ? 'Update' : 'Add'); ?> Testimonial</button>
            <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\testimonials\create.blade.php ENDPATH**/ ?>