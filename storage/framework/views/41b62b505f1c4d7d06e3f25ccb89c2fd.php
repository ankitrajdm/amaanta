<?php
    $settings = $settings ?? \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
    $sections = $sections ?? ($page ? $page->sections->keyBy('section_key') : collect());
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($page->meta_title ?? $page->title ?? 'Page'); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="logo-wrapper">
                <a class="logo" href="<?php echo e(route('home')); ?>"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('about')); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('memorybook')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="about section-padding bg-green" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="section-subtitle"><?php echo e($page->title ?? 'Page'); ?></div>
                    <div class="section-title"><?php echo e($sections->first()?->heading ?? $page->title ?? 'Content'); ?></div>-->
                    <div class="content mt-4">
                        <?php if($sections->isNotEmpty()): ?>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-4">
                                    <?php if($section->heading): ?>
                                        <h3><?php echo e($section->heading); ?></h3>
                                    <?php endif; ?>
                                    <div><?php echo $section->content; ?></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p>No content found. Add sections from admin panel.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <script src="/assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="/assets/js/modernizr-2.6.2.min.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/jquery.isotope.v3.0.2.js"></script>
    <script src="/assets/js/pace.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/scrollIt.min.js"></script>
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.stellar.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.js"></script>
    <script src="/assets/js/YouTubePopUp.js"></script>
    <script src="/assets/js/smooth-scroll.min.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views\pages\static.blade.php ENDPATH**/ ?>