

<?php $__env->startSection('title','Settings'); ?>
<?php $__env->startSection('page-title','Settings'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Website Settings</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-3">
                    <label class="form-label"><?php echo e(ucwords(str_replace('_',' ', $setting->key))); ?></label>
                    <?php if($setting->key === 'logo'): ?>
                        <?php if($setting->value): ?>
                            <div class="mb-2"><img src="<?php echo e($setting->value); ?>" alt="logo" style="max-height:60px;"></div>
                        <?php endif; ?>
                        <input type="file" name="logo" accept="image/*" class="form-control">
                    <?php else: ?>
                        <input name="<?php echo e($setting->key); ?>" value="<?php echo e($setting->value); ?>" class="form-control">
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>