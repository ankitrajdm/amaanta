
<?php $__env->startSection('content'); ?>
<h1>Posts / Blog Manager</h1>
<form method="POST" action="<?php echo e(route('admin.posts.store')); ?>"><?php echo csrf_field(); ?>
<input name="title" placeholder="Post title" required>
<input name="slug" placeholder="post-slug" required>
<input name="category" placeholder="Category">
<input name="featured_image" placeholder="Image path">
<textarea name="excerpt" placeholder="Excerpt"></textarea>
<textarea name="content" placeholder="Content" required></textarea>
<label><input type="checkbox" name="is_published" value="1"> Publish</label>
<button>Create Post</button>
</form>
<ul><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($post->title); ?> - <?php echo e($post->is_published ? 'Published' : 'Draft'); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>