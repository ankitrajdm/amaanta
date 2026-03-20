
<?php
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
    $sections = isset($page) ? ($page->sections->keyBy('section_key') ?? collect()) : collect();
    $sharedServicesSection = $sections['services_section'] ?? ($sections['services'] ?? null);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Memorybook - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('memorybook')); ?>">Memorybook</a></li>
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

    <?php if($servicesSection): ?>
    <section class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-30">
                    <div class="section-subtitle"><?php echo $servicesSection->heading ?? 'The experience'; ?></div>
                    <div class="section-title"><?php echo $servicesSection->content ?? 'Explore <span>Services</span>'; ?></div>
                </div>
                <div class="col-md-7 mb-30">
                    <?php if(isset($servicesSection->meta['description'])): ?>
                        <p><?php echo $servicesSection->meta['description']; ?></p>
                    <?php else: ?>
                        <p>Professional Wedding & Event Planner surabit aliquet orci elit gene tristisue in lorem dream vitae alisuam tincidunt felis sed gravida aliquam nemue libero hendrerit magna sit amenta the mollis lacus huam maurisine alisuam erat volutfat.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
   
    <?php endif; ?>
  
<!-- Services -->
    <section class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-30">
                    <div class="section-subtitle"><?php echo $sections['services_section']->heading ?? 'The experience'; ?></div>
                    <div class="section-title"><?php echo $sections['services_section']->content ?? 'Explore <span>Services</span>'; ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="<?php echo e($service->image ?? '/assets/img/services/default.jpg'); ?>" alt=""> </div>
                            <div class="con">
                                <h5><a href="<?php echo e(route('services.detail', $service->slug)); ?>"><?php echo e($service->title); ?> <span><?php echo e($service->slug); ?></span></a> </h5>
                                <div class="line"></div>
                                <div class="row facilities">
                                    <div class="col-md-12 text-right">
                                        <div class="permalink"><a href="<?php echo e(route('services.detail', $service->slug)); ?>">Explore <i class="ti-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/memorybook.blade.php ENDPATH**/ ?>