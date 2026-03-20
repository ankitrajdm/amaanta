
<?php
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Services - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <style>
        .event-carousel .item {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        .owl-carousel .owl-item {
            display: block !important;
        }
        .owl-carousel .owl-item:not(.active) {
            display: block !important;
            opacity: 1 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('memorybook')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner/Header -->
    <div class="banner-header about-header-bg section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo e(asset('assets/img/ab-02.png')); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-5 slider-text js-fullheight">
                    <div class="slider-text-inner">
                        <div class="desc text-start">
                            <h4>Services</h4>
                            <h1>Our Services</h1>
                            <p>Discover our professional service offerings for your event.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>

    <!-- Gallery Section -->
    <section>
        <div class="container">
            <!-- Service Sliders/Gallery Images by Title -->
            <?php if($galleryImagesByTitle && $galleryImagesByTitle->count() > 0): ?>
                <?php $__currentLoopData = $galleryImagesByTitle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-5">
                        <h2 class="section-heading" style="text-align: center;"><?php echo e($galleryGroup['title']); ?></h2>
                        <?php if($galleryGroup['images']->count() > 0): ?>
                            <div class="image-slider-container">
                                <div class="image-slider" style="display: flex; gap: 15px; overflow-x: auto; padding: 20px 0; scroll-snap-type: x mandatory; scrollbar-width: none; -ms-overflow-style: none;">
                                    <?php $__currentLoopData = $galleryGroup['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="slider-item" style="flex: 0 0 300px; scroll-snap-align: start;">
                                        <img src="<?php echo e(asset(ltrim($image->image_path, '/'))); ?>" alt="<?php echo e($image->title); ?>" class="img-fluid image-popup" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); cursor: pointer;">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="slider-nav" style="text-align: center; margin-top: 10px;">
                                    <button class="slider-prev" style="background: #007bff; color: white; border: none; padding: 10px 15px; margin: 0 5px; border-radius: 5px; cursor: pointer;">‹ Prev</button>
                                    <button class="slider-next" style="background: #007bff; color: white; border: none; padding: 10px 15px; margin: 0 5px; border-radius: 5px; cursor: pointer;">Next ›</button>
                                </div>
                            </div>
                            <style>
                                .image-slider::-webkit-scrollbar { display: none; }
                                .slider-nav { display: flex; justify-content: center; gap: 10px; }
                            </style>
                        <?php endif; ?>
                    </div>
                    <?php if(!$loop->last): ?>
                        <hr class="my-5">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No gallery images available at the moment.
                </div>
            <?php endif; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': false,
            'albumLabel': 'Photo %1 of %2'
        });

        $(document).ready(function(){
            $('.image-popup').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });

            // Slider navigation
            $('.slider-prev').click(function(){
                const slider = $(this).closest('.image-slider-container').find('.image-slider');
                const itemWidth = slider.find('.slider-item').outerWidth(true);
                slider.animate({scrollLeft: slider.scrollLeft() - itemWidth}, 300);
            });

            $('.slider-next').click(function(){
                const slider = $(this).closest('.image-slider-container').find('.image-slider');
                const itemWidth = slider.find('.slider-item').outerWidth(true);
                slider.animate({scrollLeft: slider.scrollLeft() + itemWidth}, 300);
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/gallery.blade.php ENDPATH**/ ?>