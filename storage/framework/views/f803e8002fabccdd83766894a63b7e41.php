

<?php $__env->startSection('content'); ?>
<section style="padding:2rem; max-width:480px; margin:0 auto;">
    <h1>Admin Login</h1>
    <form method="POST" action="<?php echo e(route('login.attempt')); ?>" style="display:grid; gap:0.8rem;">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" name="remember"> Remember me</label>
        <button type="submit">Login</button>
    </form>

    <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/auth/login.blade.php ENDPATH**/ ?>