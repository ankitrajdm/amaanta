

<?php $__env->startSection('title', 'Service Sliders'); ?>
<?php $__env->startSection('page-title', 'Service Sliders'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Service Image Sliders</h1>
        <a href="<?php echo e(route('admin.slider.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Slider
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Slider Title</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($slider->service->title); ?></td>
                    <td><?php echo e($slider->title); ?></td>
                    <td>
                        <?php $__currentLoopData = $slider->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(asset('storage/' . ltrim($img->image_path, '/'))); ?>" alt="" width="60" style="margin:2px;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.slider.edit', $slider)); ?>" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="<?php echo e(route('admin.slider.destroy', $slider)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\slider\index.blade.php ENDPATH**/ ?>