

<?php $__env->startSection('title','Create New Menu'); ?>
<?php $__env->startSection('page-title','Create New Menu'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Create New Menu</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.menus.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">Menu Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required class="form-control">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Location <span class="text-danger">*</span></label>
                <select name="location" required class="form-select">
                    <option value="">Select Location</option>
                    <option value="header" <?php echo e(old('location') === 'header' ? 'selected' : ''); ?>>Header Menu</option>
                    <option value="footer" <?php echo e(old('location') === 'footer' ? 'selected' : ''); ?>>Footer Menu</option>
                </select>
                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn btn-success">Create Menu</button>
            <a href="<?php echo e(route('admin.menus.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\menus\create.blade.php ENDPATH**/ ?>