

<?php $__env->startSection('title','Menus'); ?>
<?php $__env->startSection('page-title','Menus'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Menu Management</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h3><?php echo e($menu->name); ?> <small class="text-muted">(<?php echo e($menu->location); ?>)</small></h3>
            <ul class="list-group mb-3">
                <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo e($item->label); ?>

                        <span class="text-muted"><?php echo e($item->url); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <form method="POST" action="<?php echo e(route('admin.menus.items.store', $menu)); ?>" class="row g-2 mb-4">
                <?php echo csrf_field(); ?>
                <div class="col-md-3">
                    <input name="label" placeholder="Label" required class="form-control">
                </div>
                <div class="col-md-5">
                    <input name="url" placeholder="URL" required class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="number" name="position" value="1" required class="form-control">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\menus\index.blade.php ENDPATH**/ ?>