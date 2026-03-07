<?php
    $servicesPage = \App\Models\Page::where('slug', 'services')->with('sections')->first();
    $sections = $servicesPage ? $servicesPage->sections->keyBy('section_key') : collect();
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($servicesPage->title ?? 'Services'); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <!-- FontAwesome for WhatsApp icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* WhatsApp Fixed Icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 98px;
            right: 18px;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-icon a {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .whatsapp-icon a:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- WhatsApp Icon -->
    <?php if($settings['whatsapp_link'] ?? null): ?>
    <div class="whatsapp-icon">
        <a href="<?php echo e($settings['whatsapp_link']); ?>" target="_blank" title="Contact us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <?php endif; ?>

    <!-- Preloader -->
<div class="preloader-bg"></div>
<div id="preloader">
    <div id="preloader-status">
        <div class="preloader-position loader"> <span></span> </div>
    </div>
</div>

<!-- Progress scroll totop -->
<div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="<?php echo e(route('home')); ?>"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a>
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('about')); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('services')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('gallery')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo e(asset('assets/img/ab-02.png')); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-5 slider-text js-fullheight">
                    <div class="slider-text-inner">
                        <div class="desc text-start">
                            <h4><?php echo e($sections['hero']->meta['subtitle'] ?? 'Amaanta'); ?></h4>
                            <h1><?php echo e($sections['hero']->heading ?? 'Our Services'); ?></h1>
                            <p><?php echo $sections['hero']->content ?? 'Explore our comprehensive range of professional services for unforgettable celebrations.'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>

     <!-- Services -->
    <section class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-30">
                    <div class="section-subtitle"><?php echo $sections['services']->heading ?? 'The experience'; ?></div>
                    <div class="section-title"><?php echo $sections['services']->content ?? 'Explore <span>Services</span>'; ?></div>
                </div>
                <div class="col-md-7 mb-30">
                    <?php if(isset($sections['services']->meta['description'])): ?>
                        <p><?php echo $sections['services']->meta['description']; ?></p>
                    <?php else: ?>
                        <p>Professional Wedding & Event Planner surabit aliquet orci elit gene tristisue in lorem dream vitae alisuam tincidunt felis sed gravida aliquam nemue libero hendrerit magna sit amenta the mollis lacus huam maurisine alisuam erat volutfat.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="<?php echo e($service->image ?? '/assets/img/services/default.jpg'); ?>" alt=""> </div>
                            <div class="con">
                                <h5><a href="<?php echo e(route('service.detail', $service->slug)); ?>"><?php echo e($service->title); ?> <span><?php echo e($service->slug); ?></span></a> </h5>
                                <div class="line"></div>
                                <div class="row facilities">
                                    <div class="col-md-12 text-right">
                                        <div class="permalink"><a href="<?php echo e(route('service.detail', $service->slug)); ?>">Explore <i class="ti-arrow-right"></i></a></div>
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

    
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column footer-about">
                        <h3 class="footer-title">About Amaanta</h3>
                        <p class="footer-about-text"><?php echo e($settings['about_us'] ?? 'Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility. A variety of exotic flowers, redwood trees and intersecting gravel and flagstone paths besides the fountains make it a perfect destination and a timeless treasure for all your special events.'); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-explore">
                        <h3 class="footer-title">Explore</h3>
                        <ul class="footer-explore-list">
                            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                            <li><a href="<?php echo e(route('services')); ?>">Services</a></li>
                            <li><a href="<?php echo e(route('gallery')); ?>">Gallery</a></li>
                            <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">Get in touch</h3>
                        <p class="footer-contact-text"><?php echo e($settings['address'] ?? '68-73 Bijwasan Road, Kapashera, New Delhi - 37'); ?></p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone"><span class="ti-headphone-alt"></span> <?php echo e($settings['contact_no'] ?? '+91-9971009669'); ?></p>
                            <p class="footer-contact-mail"><?php echo e($settings['contact_email'] ?? 'gm.amaanta@gmail.com'); ?></p>
                        </div>
                        <div class="footer-about-social-list"> <a href="#"><i class="ti-instagram"></i></a> <a href="#"><i class="ti-twitter"></i></a> <a href="#"><i class="ti-youtube"></i></a> <a href="https://www.facebook.com/amaantafarms/"><i class="ti-facebook"></i></a>  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-inner">
                        <p class="footer-bottom-copy-right">© Copyright <?php echo e(now()->year); ?> by <a href="/" target="_blank">Amaanta</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts same as static -->
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
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/services.blade.php ENDPATH**/ ?>