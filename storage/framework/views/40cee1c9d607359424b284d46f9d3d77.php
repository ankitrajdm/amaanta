<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? ($settings['website_name'] ?? 'Amaanta')); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Additional global CSS from home template -->
    <link rel="shortcut icon" href="/assets/img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <style>
        :root {
            --primary: #5a006d;
            --accent: #d4af37;
            --light-bg: #f8f6f3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }

        /* Navigation */
        .navbar {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: relative;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary) !important;
            font-family: 'Playfair Display', serif;
            margin-right: 2rem;
        }

        /* WhatsApp Fixed Icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 60px;
            right: 30px;
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

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent) !important;
        }

        .nav-link.active {
            color: var(--primary) !important;
            border-bottom: 2px solid var(--accent);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(90, 0, 109, 0.9) 0%, rgba(100, 50, 150, 0.9) 100%) !important;
            color: white;
            padding: 120px 0;
            text-align: center;
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        /* Section Headings */
        .section-heading {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-align: center;
        }

        /* Cards */
        .feature-card {
            border: none;
            border-top: 4px solid var(--accent);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .feature-card i {
            color: var(--accent);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .feature-card h5 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, #ffd700 100%);
            color: #1a0033;
            border: none;
            font-weight: 700;
            padding: 12px 40px;
            border-radius: 4px;
            transition: transform 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ffd700 0%, var(--accent) 100%);
            color: #1a0033;
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: #fff;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        footer h5 {
            color: var(--accent);
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--accent);
        }

        footer .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            color: #999;
        }

        /* Sections */
        section {
            padding: 80px 0;
        }

        section.light-bg {
            background: var(--light-bg);
        }

        /* Testimonials Carousel */
        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--accent);
        }

        .testimonial-card .quote-text {
            font-style: italic;
            color: #666;
            margin-bottom: 1rem;
        }

        .testimonial-card .author-name {
            font-weight: 700;
            color: var(--primary);
        }

        .testimonial-card .author-title {
            color: #999;
            font-size: 0.9rem;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(90, 0, 109, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay a {
            color: var(--accent);
            font-size: 2rem;
        }

        /* FAQs Accordion */
        .accordion-button {
            background: white;
            color: var(--primary);
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            background: var(--light-bg);
            color: var(--primary);
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%235a006d'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .section-heading {
                font-size: 1.8rem;
            }
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- main content continues -->

    <?php if(session('status')): ?>
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('status')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <strong>Error!</strong> Please check the form below.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- WhatsApp Icon -->
    <?php if($settings['whatsapp_link'] ?? null): ?>
    <div class="whatsapp-icon">
        <a href="<?php echo e($settings['whatsapp_link']); ?>" target="_blank" title="Contact us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <?php endif; ?>

<?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/lightbox.min.js"></script>
    <script>
        // Toggle submenu on mobile
        document.querySelectorAll('.mobile-submenu-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                const submenu = this.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\amaanta\resources\views\layouts\frontend.blade.php ENDPATH**/ ?>