<?php
    $headerMenu = \App\Models\Menu::where('location', 'header')->with('items')->first();
    $headerItems = $headerMenu ? $headerMenu->items->sortBy('position') : collect();
?>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo (same as home) -->
        <div class="logo-wrapper">
            <a class="logo" href="<?php echo e(route('home')); ?>"> 
                <?php if($settings['logo'] ?? null): ?>
                    <img src="<?php echo e(asset($settings['logo'])); ?>" class="logo-img" alt="<?php echo e($settings['website_name'] ?? 'Amaanta'); ?>">
                <?php else: ?>
                    <?php echo e($settings['website_name'] ?? 'Amaanta'); ?>

                <?php endif; ?>
            </a>
        </div>
        <!-- Toggler with icon from home template -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> 
        </button>
        <!-- Menu links -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <?php $__empty_1 = true; $__currentLoopData = $headerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->is(ltrim($item->url, '/')) ? 'active' : ''); ?>" href="<?php echo e($item->url); ?>"><?php echo e($item->label); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('about')); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('memorybook')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/partials/header.blade.php ENDPATH**/ ?>