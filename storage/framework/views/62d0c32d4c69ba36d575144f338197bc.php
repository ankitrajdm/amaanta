<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? ($settings['website_name'] ?? 'Amaanta')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
</head>
<body>
<nav style="padding: 1rem; background: #f5f5f5; display: flex; gap: 1rem; flex-wrap:wrap;">
    <a href="<?php echo e(route('home')); ?>">Home</a>
    <a href="<?php echo e(route('about')); ?>">About</a>
    <a href="<?php echo e(route('contact')); ?>">Contact</a>
    <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('admin.dashboard')); ?>">Admin Panel</a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;"><?php echo csrf_field(); ?><button type="submit">Logout</button></form>
    <?php else: ?>
        <a href="<?php echo e(route('login')); ?>">Login</a>
    <?php endif; ?>
</nav>
<?php if(session('status')): ?>
<div style="margin:1rem; padding:0.75rem; background:#e8f7e8;"><?php echo e(session('status')); ?></div>
<?php endif; ?>
<main style="padding: 1rem;">
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/layouts/app.blade.php ENDPATH**/ ?>