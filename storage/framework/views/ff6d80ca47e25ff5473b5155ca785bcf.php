<?php
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($service->title); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
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

            <!DOCTYPE html>
            <html lang="zxx">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
                <title><?php echo e($service->title); ?> - Amaanta Farms</title>
                <link rel="stylesheet" href="/assets/css/plugins.css" />
                <link rel="stylesheet" href="/assets/css/style.css" />
            </head>
            <body>
                <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo e(asset('assets/img/ab-02.png')); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 slider-text js-fullheight">
                                <div class="slider-text-inner">
                                    <div class="desc text-start">
                                        <h4><?php echo e($service->title); ?></h4>
                                        <h1><?php echo e($service->title); ?></h1>
                                        <p><?php echo e($service->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Gallery Slider -->
                <?php if($galleryImages && $galleryImages->count() > 0): ?>
                <section style="padding: 80px 0; background: white;">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-lg-12 text-center">
                                <h2 class="section-heading">Gallery for <?php echo e($service->title); ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="owl-carousel owl-theme event-carousel">
                                    <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); height: 300px; background: #eee;">
                                            <img src="<?php echo e(asset('storage/' . ltrim($image->image_path, '/'))); ?>" alt="<?php echo e($image->title); ?>" class="img-fluid image-popup" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <script src="/assets/js/jquery-3.6.3.min.js"></script>
                <script src="/assets/js/owl.carousel.min.js"></script>
                <script src="/assets/js/jquery.magnific-popup.js"></script>
                <script>
                $(document).ready(function(){
                    $('.event-carousel').owlCarousel({
                        loop: true,
                        margin: 10,
                        nav: true,
                        responsive: {
                            0: { items: 1 },
                            600: { items: 2 },
                            1000: { items: 3 }
                        },
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true
                    });
                    $('.image-popup').magnificPopup({
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                });
                </script>
            </body>
            </html>
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
<script>
$(document).ready(function(){
    $('.event-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        },
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    $('.testimonials .owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });

    $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/service-detail.blade.php ENDPATH**/ ?>