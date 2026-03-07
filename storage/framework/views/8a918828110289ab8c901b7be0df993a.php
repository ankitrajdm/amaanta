<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Amaanta CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; }
        .sidebar { background-color: #2c3e50; color: white; min-height: 100vh; padding: 20px 0; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background-color: #34495e; }
        .sidebar a.active { background-color: #3498db; }
        .main-content { padding: 30px; }
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card { border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .btn-primary { background-color: #3498db; border: none; }
        .btn-primary:hover { background-color: #2980b9; }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h3 class="mb-4">Amaanta CMS</h3>
                <nav>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
                        <i class="fas fa-dashboard"></i> Dashboard
                    </a>
                    <hr style="border-color: #555;">
                    
                    <h6 class="mt-3 px-3" style="color: #bdc3c7;">Content Management</h6>
                    <a href="<?php echo e(route('admin.pages.index')); ?>" class="<?php if(request()->routeIs('admin.pages.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-file-alt"></i> Pages
                    </a>
                    <a href="<?php echo e(route('admin.posts.index')); ?>" class="<?php if(request()->routeIs('admin.posts.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-blog"></i> Blog Posts
                    </a>
                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="<?php if(request()->routeIs('admin.categories.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-list"></i> Categories
                    </a>
                    <a href="<?php echo e(route('admin.tags.index')); ?>" class="<?php if(request()->routeIs('admin.tags.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-tag"></i> Tags
                    </a>
                    
                    <h6 class="mt-3 px-3" style="color: #bdc3c7;">Features</h6>
                    <a href="<?php echo e(route('admin.services.index')); ?>" class="<?php if(request()->routeIs('admin.services.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-cogs"></i> Services
                    </a>
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="<?php if(request()->routeIs('admin.events.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-calendar"></i> Events
                    </a>
                    <a href="<?php echo e(route('admin.faqs.index')); ?>" class="<?php if(request()->routeIs('admin.faqs.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-question-circle"></i> FAQs
                    </a>
                    <a href="<?php echo e(route('admin.gallery.index')); ?>" class="<?php if(request()->routeIs('admin.gallery.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-image"></i> Gallery
                    </a>
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="<?php if(request()->routeIs('admin.testimonials.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-star"></i> Testimonials
                    </a>
                    
                    <h6 class="mt-3 px-3" style="color: #bdc3c7;">Communication</h6>
                    <a href="<?php echo e(route('admin.menus.index')); ?>" class="<?php if(request()->routeIs('admin.menus.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-bars"></i> Menus
                    </a>
                    <a href="<?php echo e(route('admin.contact-forms.index')); ?>" class="<?php if(request()->routeIs('admin.contact-forms.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-envelope"></i> Contact Forms
                    </a>
                    <a href="<?php echo e(route('admin.enquiries.index')); ?>" class="<?php if(request()->routeIs('admin.enquiries.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-inbox"></i> Enquiries
                    </a>
                    
                    <?php if(auth()->user()->isAdmin()): ?>
                    <h6 class="mt-3 px-3" style="color: #bdc3c7;">Administration</h6>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php if(request()->routeIs('admin.users.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <a href="<?php echo e(route('admin.settings.index')); ?>" class="<?php if(request()->routeIs('admin.settings.*')): ?> active <?php endif; ?>">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <span class="navbar-brand"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <span class="nav-link"><?php echo e(auth()->user()->name); ?></span>
                                </li>
                                <li class="nav-item">
                                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Flash Messages -->
                <div class="main-content">
                    <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('status')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Content -->
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- WYSIWYG editor for HTML fields (CKEditor 5 classic) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editors = document.querySelectorAll('textarea.html-editor');
            editors.forEach(textarea => {
                ClassicEditor.create(textarea, {
                    toolbar: [ 'undo','redo','|','heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','insertTable','mediaEmbed','code' ],
                    height: 300
                }).catch(error => {
                    console.error('CKEditor init error:', error);
                });
            });
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/admin/layout.blade.php ENDPATH**/ ?>