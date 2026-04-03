<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Admin Panel - ' . (data_get($settings, 'website_name', 'Amaanta'))); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--accent:#43a047;--accent-dark:#2e7d32;--muted:#666}
        * { box-sizing: border-box; }
        html,body{height:100%;}
        body{font-family: 'Playfair Display', Georgia, serif; margin:0; background:#fafafa; color:#222; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;}

        .admin-container{display:flex;min-height:100vh;}

        /* Top bar using frontend style */
        .wp-topbar{position:fixed;left:0;right:0;top:0;height:56px;z-index:1200;background:linear-gradient(90deg,var(--accent),#76c893);color:#fff;display:flex;align-items:center;padding:0 18px;box-shadow:0 2px 6px rgba(0,0,0,0.08)}
        .wp-topbar .brand{font-weight:700;margin-right:16px;color:#fff}
        .wp-topbar .top-actions{margin-left:auto;display:flex;gap:12px;align-items:center}
        .wp-topbar .top-actions a{color:#fff;text-decoration:none;font-size:13px}

        /* Sidebar (darker neutral) */
        .admin-sidebar{width:260px;background:#1f2933;color:#d1d5db;padding-top:78px;position:fixed;left:0;top:0;bottom:0;overflow:auto}
        .sidebar-header{padding:18px 20px;border-bottom:1px solid rgba(255,255,255,0.03);color:#fff}
        .sidebar-header h2{font-size:18px;margin:0;font-weight:700}
        .sidebar-header p{font-size:12px;opacity:0.9;margin:6px 0 0}

        .sidebar-menu{list-style:none;margin:12px 0;padding:6px}
        .sidebar-menu a, .menu-toggle{display:flex;align-items:center;gap:12px;padding:10px 16px;color:inherit;text-decoration:none;font-size:14px;border-radius:6px}
        .sidebar-menu a:hover, .menu-toggle:hover{background:rgba(255,255,255,0.03);color:#fff}
        .sidebar-menu a.active{background:rgba(255,255,255,0.06);color:#fff}

        .sidebar-submenu{list-style:none;max-height:0;overflow:hidden;transition:max-height .28s ease;padding-left:0;margin:0}
        .sidebar-submenu.active{max-height:800px}
        .sidebar-submenu li a{padding-left:42px;font-size:13px;color:#d1d1d1}

        /* Main area aligns with frontend container classes */
        .admin-main{flex:1;margin-left:260px;display:flex;flex-direction:column;min-height:100vh}
        .admin-header{height:64px;margin-top:56px;padding:12px 20px;display:flex;align-items:center;justify-content:space-between;background:transparent;border-bottom:1px solid rgba(0,0,0,0.04)}
        .admin-header h1{font-size:18px;margin:0;color:#111;font-family:inherit}

        .admin-content{padding:32px;background:transparent;flex:1}
        .card{background:#fff;border:1px solid #eee;padding:18px;border-radius:8px}

        .btn{display:inline-block;padding:8px 12px;background:var(--accent);color:#fff;border-radius:6px;text-decoration:none}
        .btn.secondary{background:#fff;color:#111;border:1px solid #ddd}

        @media(max-width:900px){.admin-sidebar{transform:translateX(-100%);position:fixed;z-index:1300}.admin-sidebar.active{transform:none}.admin-main{margin-left:0}.wp-topbar{padding-right:12px}}
    </style>
</head>
<body>
<div class="wp-topbar">
    <div class="brand"><?php echo e(data_get($settings, 'website_name', 'Amaanta')); ?></div>
    <div class="top-actions">
        <a href="/" target="_blank">View Site</a>
        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
        <a href="<?php echo e(route('admin.pages.index')); ?>">Content</a>
    </div>
</div>

<div class="admin-container">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <h2><?php echo e(data_get($settings, 'website_name', 'Amaanta')); ?></h2>
            <p>Admin Panel</p>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php if(Route::currentRouteName() === 'admin.dashboard'): ?> active <?php endif; ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Content Management -->
            <li>
                <button class="menu-toggle" onclick="toggleMenu(this)">
                    <i class="fas fa-file-alt"></i>
                    <span>Content</span>
                </button>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('admin.pages.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.pages.index' || Route::currentRouteName() === 'admin.pages.edit'): ?> active <?php endif; ?>">
                            <i class="fas fa-file"></i> Pages
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.posts.index' || Route::currentRouteName() === 'admin.posts.store'): ?> active <?php endif; ?>">
                            <i class="fas fa-newspaper"></i> Blog Posts
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Media & Gallery -->
            <li>
                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.gallery.index' || Route::currentRouteName() === 'admin.gallery.store'): ?> active <?php endif; ?>">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </li>

            <!-- User Engagement -->
            <li>
                <button class="menu-toggle" onclick="toggleMenu(this)">
                    <i class="fas fa-star"></i>
                    <span>Engagement</span>
                </button>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.testimonials.index' || Route::currentRouteName() === 'admin.testimonials.store'): ?> active <?php endif; ?>">
                            <i class="fas fa-comments"></i> Testimonials
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.contact-forms.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.contact-forms.index' || Route::currentRouteName() === 'admin.contact-forms.show'): ?> active <?php endif; ?>">
                            <i class="fas fa-envelope"></i> Contact Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('admin.bookings.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.bookings.index' || Route::currentRouteName() === 'admin.bookings.show'): ?> active <?php endif; ?>">
                            <i class="fas fa-calendar-check"></i> Bookings
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Navigation -->
            <li>
                <a href="<?php echo e(route('admin.menus.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.menus.index'): ?> active <?php endif; ?>">
                    <i class="fas fa-bars"></i>
                    <span>Menu</span>
                </a>
            </li>

            <!-- Admin Settings -->
            <?php if(auth()->user()->isAdmin()): ?>
            <li>
                <a href="<?php echo e(route('admin.settings.index')); ?>" class="<?php if(Route::currentRouteName() === 'admin.settings.index'): ?> active <?php endif; ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <?php endif; ?>

            <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 1rem; padding-top: 1rem;">
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="padding: 0;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="width: 100%; padding: 1rem 1.5rem; color: white; text-decoration: none; display: flex; align-items: center; border: none; background: none; cursor: pointer; font-size: 1rem; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255, 255, 255, 0.15)';" onmouseout="this.style.background='none';">
                        <i class="fas fa-sign-out-alt" style="width: 20px; margin-right: 1rem; text-align: center;"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <button class="sidebar-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <h1><?php echo e($page_title ?? 'Admin Panel'); ?></h1>
            <div class="admin-user-menu">
                <span><i class="fas fa-user-circle"></i> <?php echo e(auth()->user()->name); ?></span>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            <?php if(session('status')): ?>
                <div style="margin-bottom: 1.5rem; padding: 1rem; background: #e8f7e8; border-left: 4px solid #43a047; border-radius: 4px; color: #2e7d32;">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div style="margin-bottom: 1.5rem; padding: 1rem; background: #ffebee; border-left: 4px solid #c62828; border-radius: 4px; color: #c62828;">
                    <strong>Please correct the following errors:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</div>

<script>
    function toggleMenu(button) {
        const submenu = button.nextElementSibling;
        submenu.classList.toggle('active');
        button.classList.toggle('active');
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        sidebar.classList.toggle('active');
    }

    // Close sidebar when clicking on a link (mobile)
    document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('adminSidebar').classList.remove('active');
            }
        });
    });

    // Close sidebar when clicking outside (mobile)
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('adminSidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        
        if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });

    // Auto-expand menu if current route is in submenu
    window.addEventListener('load', function() {
        document.querySelectorAll('.sidebar-submenu').forEach(submenu => {
            const activeLink = submenu.querySelector('a.active');
            if (activeLink) {
                const toggleButton = submenu.previousElementSibling;
                submenu.classList.add('active');
                toggleButton.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views\layouts\admin.blade.php ENDPATH**/ ?>