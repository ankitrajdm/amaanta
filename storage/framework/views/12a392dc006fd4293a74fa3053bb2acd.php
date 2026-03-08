<?php
    $contactPage = \App\Models\Page::where('slug', 'contact')->with('sections')->first();
    $sections = $contactPage ? $contactPage->sections->keyBy('section_key') : collect();
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
    $faqs = \App\Models\FAQ::where('is_active', true)->get();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($contactPage->title ?? 'Contact Us'); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('gallery')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Hero Banner (matches contact.html) -->
<section class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo e($sections['hero']->meta['background'] ?? '/assets/img/ab-01.png'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-5 slider-text js-fullheight">
                <div class="slider-text-inner">
                    <div class="desc">
                        <h4><?php echo $sections['hero']->meta['subtitle'] ?? 'Get in touch'; ?></h4>
                        <h1><?php echo $sections['hero']->heading ?? 'Contact Information'; ?></h1>
                        <p><?php echo $sections['hero']->content ?? 'Fill out the form below I’ll get back to you within 24 hours to book a discovery call and start chatting about all the exciting possibilities.'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- arrow down -->
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</section>

<!-- Contact block (dynamic version of contact.html section) -->
<section class="contact section-padding" data-scroll-index="1">
    <div class="container">
        <div class="row mb-90">
            <div class="col-md-5 mb-60">
                <h3><?php echo $sections['contact_information']->heading ?? 'Contact Information'; ?></h3>
                <?php if($settings['contact_no'] ?? null): ?>
                <div class="contact-info mb-30">
                    <div class="icon"><span class="ti-headphone-alt"></span></div>
                    <div class="text">
                        <p>Contact No</p>
                        <a href="tel:<?php echo e($settings['contact_no']); ?>"><?php echo e($settings['contact_no']); ?></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($settings['contact_email'] ?? null): ?>
                <div class="contact-info mb-30">
                    <div class="icon"><span class="ti-envelope"></span></div>
                    <div class="text">
                        <p>Email Info</p>
                        <a href="mailto:<?php echo e($settings['contact_email']); ?>"><?php echo e($settings['contact_email']); ?></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($settings['address'] ?? null): ?>
                <div class="contact-info mb-30">
                    <div class="icon"><span class="ti-location-pin"></span></div>
                    <div class="text">
                        <p>Address</p> <?php echo nl2br(e($settings['address'])); ?>

                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 mb-30 offset-md-1">
                <h3><?php echo $sections['book_event_form']->heading ?? 'Book your event'; ?></h3>
                <p><?php echo $sections['book_event_form']->content ?? 'Ask me a question, I\'d love to hear more from you.'; ?></p>
                <form method="POST" class="contact__form" action="<?php echo e(route('contact.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <?php if(session('status')): ?>
                        <div class="col-12">
                            <div class="alert alert-success contact__msg"><?php echo e(session('status')); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input name="name" type="text" placeholder="Your Name *" required value="<?php echo e(old('name')); ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="email" type="email" placeholder="Your Email *" required value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="phone" type="text" placeholder="Your Number *" required value="<?php echo e(old('phone')); ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <input name="subject" type="text" placeholder="Subject *" required value="<?php echo e(old('subject')); ?>">
                        </div>
                        <!-- optional additional fields can be added via sections meta -->
                        <div class="col-md-12 form-group">
                            <textarea name="message" cols="30" rows="4" placeholder="Additional Information*" required><?php echo e(old('message')); ?></textarea>
                        </div>
                        <div class="col-md-12 mt-15">
                            <button class="butn-dark" type="submit"><span>Send Message</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="google-map">
                    <iframe src="<?php echo e($settings['map_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3505.2884343805913!2d77.0857608!3d28.531048900000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1be8bf1c4515%3A0x2192069b8aec5394!2sAmaanta!5e0!3m2!1sen!2sin!4v1769654719666!5m2!1sen!2sin'); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQs section -->
<section class="section-padding bg-green">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30">
                <div class="section-subtitle white">F.A.Qs</div>
                <div class="section-title white">Amaanta<span class="white">Questions</span></div>
                <p class="white"><?php echo $sections['faq_intro']->content ?? 'Have questions? We have answers.'; ?></p>
            </div>
            <div class="col-md-6">
                <ul class="accordion-box clearfix">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
</html><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/contact.blade.php ENDPATH**/ ?>