<?php
    $aboutPage = \App\Models\Page::where('slug', 'about')->with('sections')->first();
    $sections = $aboutPage ? $aboutPage->sections->keyBy('section_key') : collect();
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($aboutPage->title ?? 'About Us'); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('about')); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('memorybook')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header Banner -->
    <?php
        $aboutPage = \App\Models\Page::where('slug', 'about')->with('sections')->first();
        $sections = $aboutPage ? $aboutPage->sections->keyBy('section_key') : collect();
    ?>
    <div class="banner-header about-header-bg section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo e(asset('assets/img/ab-02.png')); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-5 slider-text js-fullheight">
                    <div class="slider-text-inner">
                        <div class="desc text-start">
                            <h4><?php echo e($sections['about_intro']->meta['subheading'] ?? 'Amaanta'); ?></h4>
                            <h1><?php echo e($sections['about_intro']->heading ?? 'Where Nature Meets Elegance'); ?></h1>
                            <p><?php echo $sections['about_intro']->content ?? 'A world-class farm in Delhi offering serene <span>natural beauty</span> for unforgettable celebrations.'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>
    <!-- About -->
    <section class="about2  cover section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-subtitle"><?php echo e($sections['main_content']->meta['subtitle'] ?? 'About Us'); ?></div>
                    <div class="section-title"><?php echo e($sections['main_content']->heading ?? 'Amaanta'); ?> <span><?php echo e($sections['main_content']->meta['highlight'] ?? 'Farms'); ?></span></div>
                    <p><?php echo $sections['main_content']->content ?? ''; ?></p>
                    <ul class="list-unstyled about-list mb-30">
                        <li>
                            <div class="about-list-icon"> <span class="ti-check"></span> </div>
                            <div class="about-list-text">
                                <p><?php echo e($sections['main_content']->meta['bullet1'] ?? '8 Years of Experience'); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="about-list-icon"> <span class="ti-check"></span> </div>
                            <div class="about-list-text">
                                <p><?php echo e($sections['main_content']->meta['bullet2'] ?? '250+ Wedding Planner'); ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 offset-md-1 animate-box" data-animate-effect="fadeInUp">
                    <div class="img-exp">
                        <div class="about-img">
                            <div class="img"> <img src="<?php echo e(asset($sections['main_content']->meta['image'] ?? 'assets/img/about.jfif')); ?>" class="img-fluid" alt=""> </div>
                        </div>
                        <div id="circle">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="300px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                                <defs>
                                    <path id="circlePath" d=" M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 " />
                                </defs>
                                <circle cx="150" cy="100" r="75" fill="none" />
                                <g>
                                    <use xlink:href="#circlePath" fill="none" />
                                    <text fill="#ffffff">
                                        <textPath xlink:href="#circlePath"> . Amaanta . Amaanta . Amaanta   </textPath>
                                    </text>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team/Services -->
    <section class="team section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-30">
                    <?php $sharedServicesSection = $sections['services_section'] ?? ($sections['services'] ?? null); ?>
    <div class="section-subtitle"><?php echo e($sharedServicesSection?->meta['subtitle'] ?? 'Our Services'); ?></div>
                    <div class="section-title"><?php echo e($sharedServicesSection?->heading ?? 'Amaanta'); ?> <span><?php echo e($sharedServicesSection?->meta['highlight'] ?? 'Services'); ?></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                    <div class="img left">
                        <img src="<?php echo e(asset($sharedServicesSection->meta['service1_image'] ?? 'assets/img/services/service_list1.jpg')); ?>" alt="">
                    </div>
                </div>
                <div class="col-md-6 valign animate-box" data-animate-effect="fadeInRight">
                    <div class="content">
                        <div class="cont text-left">
                            <h4><span><?php echo e($sharedServicesSection->meta['service1_title'] ?? 'Decoration'); ?></span> | Events </h4>
                            <p><?php echo e($sharedServicesSection->meta['service1_content'] ?? ''); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 order2 valign animate-box" data-animate-effect="fadeInLeft">
                    <div class="content">
                        <div class="cont text-left">
                            <h4 class="white"><span><?php echo e($sharedServicesSection->meta['service2_title'] ?? 'Luxury suites'); ?></span> | Events</h4>
                            <p><?php echo e($sharedServicesSection->meta['service2_content'] ?? ''); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order1 animate-box" data-animate-effect="fadeInRight">
                    <div class="img">
                        <img src="<?php echo e(asset($sharedServicesSection->meta['service2_image'] ?? 'assets/img/services/service-2.png')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="<?php echo e(asset('assets/img/slider/cocktails-banner-4.png')); ?>" data-overlay-dark="5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <div class="testimonials-box">
                            <div class="owl-carousel owl-theme">
                                <?php if(isset($sections['testimonials']) && $sections['testimonials']->content): ?>
                                    <?php $__currentLoopData = json_decode($sections['testimonials']->content, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item"> 
                                            <span>
                                                <i class="star-rating"></i>
                                                <i class="star-rating"></i>
                                                <i class="star-rating"></i>
                                                <i class="star-rating"></i>
                                                <i class="star-rating"></i>
                                            </span>
                                            <h5>" <?php echo e($testimonial); ?> "</h5>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="item"> 
                                        <span>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                            <i class="star-rating"></i>
                                        </span>
                                        <h5>" A big shoutout to team Amaanta for making the day I dreamt of my entire life, a huge success... "</h5>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Faqs -->
    <section class="section-padding bg-green">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                    <div class="section-subtitle white"><?php echo e($sections['faq']->heading ?? 'F.A.Qs'); ?></div>
                    <div class="section-title white">Amaanta<span class="white"><?php echo e($sections['faq']->meta['subtitle'] ?? 'Questions'); ?></span></div>
                    <p class="white"> <?php echo $sections['faq']->content ?? ''; ?></p>
                </div>
                <div class="col-md-6">
                    <ul class="accordion-box clearfix">
                        <?php $__currentLoopData = \App\Models\FAQ::where('is_active', true)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="accordion block">
                                <div class="acc-btn"><?php echo e($faq->question); ?></div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text"><?php echo e($faq->answer); ?></div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup -->
    <section class="signup">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="img left"> <img src="<?php echo e(asset('assets/img/signup.jfif')); ?>" alt=""> </div>
                </div>
                <div class="col-md-6 p-0 valign newsletter-bg">
                    <div class="content">
                        <div class="cont text-left">
                            <h6>Sign Up</h6>
                            <h4>Subscribe to the <span>Newsletter</span></h4>
                            <p>For the latest inspiration and insider tips straight to your inbox.</p>
                            <form method="post" class="contact__form" action="#">
                                <!-- form message -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                    </div>
                                </div>
                                <!-- form elements -->
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <input name="name" type="text" placeholder="Full Name *" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input name="email" type="email" placeholder="Email Address *" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="butn-dark"><span>Subscribe</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views\pages\about.blade.php ENDPATH**/ ?>