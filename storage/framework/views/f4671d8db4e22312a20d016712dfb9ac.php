

<?php $__env->startSection('title', 'Posts'); ?>
<?php $__env->startSection('page-title', 'Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Posts / Blog Manager</h1>
        <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> New Post</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($post->title); ?></td>
                        <td><?php echo e($post->category); ?></td>
                        <td><?php echo e($post->is_published ? 'Published' : 'Draft'); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="#" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>