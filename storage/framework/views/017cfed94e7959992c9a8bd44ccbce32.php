<?php
    $sections = collect();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo e($post->title); ?> - <?php echo e($settings['website_name'] ?? 'Amaanta Farms'); ?></title>
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('services')); ?>">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('memorybook')); ?>">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Blog Article Header -->
    <header class="header blog-header">
        <div class="background bg-img" data-overlay-dark="4" style="background: linear-gradient(135deg, rgba(90, 0, 109, 0.9) 0%, rgba(100, 50, 150, 0.9) 100%); background-image: none; min-height: 400px; display: flex; align-items: center;">
            <div class="v-middle caption overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <span class="category" style="color: #d4af37; font-size: 0.9rem;"><?php echo e($post->created_at->format('M d, Y')); ?></span>
                                    <h1 style="font-family: 'Playfair Display', serif; color: white; font-size: 3rem; font-weight: 700; margin: 15px 0; line-height: 1.2;"><?php echo e($post->title); ?></h1>
                                    <?php if($post->categories && $post->categories->count() > 0): ?>
                                        <p style="color: rgba(255,255,255,0.9);">
                                            <i class="fas fa-folder"></i> <?php echo e($post->categories->first()->name); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Article Content -->
    <section class="blog-content section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <?php if($post->featured_image): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(strpos($post->featured_image, 'http') === 0 || strpos($post->featured_image, '/') === 0 ? $post->featured_image : asset('storage/' . $post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="img-fluid" style="max-height: 500px; object-fit: cover; width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                        </div>
                    <?php endif; ?>

                    <div style="color: #555; line-height: 1.9; font-size: 1.05rem;">
                        <?php echo $post->content; ?>

                    </div>

                    <!-- Tags -->
                    <?php if($post->tags && $post->tags->count() > 0): ?>
                        <div class="mt-5 pt-4" style="border-top: 1px solid #ddd;">
                            <h6 class="mb-3" style="font-family: 'Playfair Display', serif; color: #5a006d;">Tags:</h6>
                            <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog', ['tag' => $tag->slug])); ?>" class="badge" style="background: #5a006d; text-decoration: none; color: white; font-size: 0.9rem; padding: 0.5rem 0.75rem; margin: 0.25rem; display: inline-block;">
                                    <?php echo e($tag->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Share -->
                    <div class="mt-5 pt-4" style="border-top: 1px solid #ddd;">
                        <h6 class="mb-3" style="font-family: 'Playfair Display', serif; color: #5a006d;">Share Article:</h6>
                        <div>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->full()); ?>" target="_blank" class="butn-dark" style="background: #3b5998; color: white; text-decoration: none; padding: 8px 15px; margin-right: 10px; border-radius: 4px; display: inline-block;">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo e(url()->full()); ?>&text=<?php echo e(urlencode($post->title)); ?>" target="_blank" style="background: #1DA1F2; color: white; text-decoration: none; padding: 8px 15px; margin-right: 10px; border-radius: 4px; display: inline-block;">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(url()->full()); ?>" target="_blank" style="background: #0077b5; color: white; text-decoration: none; padding: 8px 15px; border-radius: 4px; display: inline-block;">
                                <i class="fab fa-linkedin-in"></i> LinkedIn
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- About Post -->
                    <div style="background: #f8f6f3; padding: 25px; border-radius: 8px; margin-bottom: 25px;">
                        <h6 style="font-family: 'Playfair Display', serif; color: #5a006d; margin-bottom: 15px;">Quick Info</h6>
                        <p style="margin-bottom: 15px; color: #666;">
                            <strong style="color: #5a006d;">Published:</strong><br> <?php echo e($post->created_at->format('M d, Y')); ?>

                        </p>
                        <?php if($post->categories && $post->categories->count() > 0): ?>
                            <p style="color: #666;">
                                <strong style="color: #5a006d;">Category:</strong><br>
                                <a href="<?php echo e(route('blog', ['category' => $post->categories->first()->slug])); ?>" style="color: #5a006d; text-decoration: none; font-weight: 500;">
                                    <?php echo e($post->categories->first()->name); ?>

                                </a>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Related Articles -->
                    <?php if($relatedPosts && $relatedPosts->count() > 0): ?>
                        <div style="background: #f8f6f3; padding: 25px; border-radius: 8px;">
                            <h6 style="font-family: 'Playfair Display', serif; color: #5a006d; margin-bottom: 20px;">Related Articles</h6>
                            <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #ddd;">
                                    <a href="<?php echo e(route('blog.detail', $related->slug)); ?>" style="color: #5a006d; text-decoration: none; font-weight: 500; display: block; margin-bottom: 5px;">
                                        <?php echo e($related->title); ?>

                                    </a>
                                    <p style="color: #999; font-size: 0.85rem; margin: 0;">
                                        <i class="fas fa-calendar-alt"></i> <?php echo e($related->created_at->format('M d, Y')); ?>

                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column footer-about">
                        <h3 class="footer-title"><a class="logo" href="<?php echo e(route('home')); ?>"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a></h3>
                        <p class="footer-about-text"><?php echo e($settings['footer_about'] ?? 'Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility. Amaanta has a lush green 2.5 acre farm and a semi-covered area of approximately 13,000 sq. feet and has been a landmark in the vicinity for over 8 years.'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="footer-column footer-explore clearfix">
                        <h3 class="footer-title">Explore</h3>
                        <ul class="footer-explore-list list-unstyled">
                            <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                            <li><a href="<?php echo e(route('services')); ?>">Services</a></li>
                            <li><a href="<?php echo e(route('memorybook')); ?>">Memorybook</a></li>
                            <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
                            <li><a href="<?php echo e(route('guest-feedback')); ?>">Guest Feedback</a></li>
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
                        <p class="footer-bottom-copy-right">Copyright © <?php echo e(now()->year); ?>  <a href="/" target="_blank">Amaanta</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="/assets/js/jquery-3.6.3.min.js"></script>
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/grevera.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Hide preloader when page loads
    $(document).ready(function() {
        // Hide preloader and background
        $("#preloader").fadeOut();
        $(".preloader-bg").fadeOut();
        // Ensure page is visible
        $("body").css("overflow", "auto");
    });
    
    // Fallback to hide preloader after 3 seconds if jQuery didn't work
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        const preloaderBg = document.querySelector('.preloader-bg');
        if (preloader) preloader.style.display = 'none';
        if (preloaderBg) preloaderBg.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views/pages/blog-detail.blade.php ENDPATH**/ ?>