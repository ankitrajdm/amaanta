@php
    $sections = $page->sections->keyBy('section_key');
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $settings['website_name'] ?? 'Amaanta Farms' }}</title>
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
    @if($settings['whatsapp_link'] ?? null)
    <div class="whatsapp-icon">
        <a href="{{ $settings['whatsapp_link'] }}" target="_blank" title="Contact us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    @endif

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
                <a class="logo" href="{{ route('home') }}"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a>
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('memorybook') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Video -->
    <header class="header">
        <div class="video-fullscreen-wrap">
            <div class="video-fullscreen-video" data-overlay-dark="5">
                <video playsinline="" autoplay="" loop="" muted="">
                    <source src="/assets/vid/bg-video.mp4" type="video/mp4">
                    <source src="/assets/vid/bg-video.mp4" type="video/webm">
                </video>
            </div>
            <div class="v-middle caption overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 slider-text js-fullheight">
                            <div class="slider-text-inner">
                                <div class="desc text-start">
                                    <h4>{{ $settings['website_name'] ?? 'Amaanta' }}</h4>
                                    <h1>{!! $sections['banner']->heading ?? 'Where Nature Meets Elegance' !!}</h1>
                                    <p>{!! $sections['banner']->content ?? 'A world-class farm in Delhi offering serene <span>natural beauty</span> for unforgettable celebrations.' !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- arrow down -->
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </header>
    <!-- About Amaanta -->
    <section class="about section-padding bg-green" data-scroll-index="1">
        <div class="container">
            <div class="row">
                <div class="col-md-5 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-subtitle white">{!! $sections['what_we_do']->heading ?? 'What we do' !!}</div>
                    <div class="section-title white">{!! $sections['what_we_do']->content ?? 'A wedding that is <span class="white">True</span> as you are!' !!}</div>
                    @if(isset($sections['what_we_do']->meta['short']))
                        <p>{!! $sections['what_we_do']->meta['short'] !!}</p>
                    @endif
                </div>
                <div class="col-md-6 offset-md-1 mt-30 animate-box" data-animate-effect="fadeInUp">
                    {!! $sections['what_we_do']->meta['details'] ?? '<p>At Amaanta, we provide a world-class venue for weddings, social celebrations, and corporate events, set across 2.5 acres of lush green landscapes. Surrounded by exotic flowers, majestic trees, tranquil fountains, and thoughtfully designed pathways, Amaanta offers a serene and picturesque setting for unforgettable moments.</p><p> With a spacious 13,000 sq. ft. semi-covered area and a professionally managed team of experienced industry experts, we ensure seamless coordination and personalized service. For over 8 years, Amaanta has been a trusted landmark, delivering flawless events in a timeless natural haven.</p>' !!}
                    @php
                        $btnText = $sections['what_we_do']->meta['button_text'] ?? 'Find out more';
                        $btnUrl = $sections['what_we_do']->meta['button_url'] ?? route('about');
                    @endphp
                    <div class="butn-light mt-15"> <a href="{{ $btnUrl }}"><span>{{ $btnText }}</span></a> </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    <section class="services section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-30">
                    <div class="section-subtitle">{!! $sections['services']->heading ?? 'The experience' !!}</div>
                    <div class="section-title">{!! $sections['services']->content ?? 'Explore <span>Services</span>' !!}</div>
                </div>
                <div class="col-md-7 mb-30">
                    @if(isset($sections['services']->meta['description']))
                        <p>{!! $sections['services']->meta['description'] !!}</p>
                    @else
                        <p>Professional Wedding & Event Planner surabit aliquet orci elit gene tristisue in lorem dream vitae alisuam tincidunt felis sed gravida aliquam nemue libero hendrerit magna sit amenta the mollis lacus huam maurisine alisuam erat volutfat.</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach($services as $service)
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="{{ $service->image ?? '/assets/img/services/default.jpg' }}" alt=""> </div>
                            <div class="con">
                                <h5><a href="{{ route('services.detail', $service->slug) }}">{{ $service->title }} <span>{{ $service->slug }}</span></a> </h5>
                                <div class="line"></div>
                                <div class="row facilities">
                                    <div class="col-md-12 text-right">
                                        <div class="permalink"><a href="{{ route('services.detail', $service->slug) }}">Explore <i class="ti-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testiominals -->
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding pb-0" data-background="/assets/img/slider/cocktails-banner-4.png" data-overlay-dark="5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <div class="testimonials-box">
                            <div class="owl-carousel owl-theme">
                                @foreach($testimonials as $testimonial)
                                <div class="item">
                                    <span>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                        <i class="star-rating"></i>
                                    </span>
                                    <h5>"{{ $testimonial->quote }}"</h5>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us -->
    <section class="about2 cover section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-subtitle">About Us</div>
                    <div class="section-title">Amaanta <span>Farms</span></div>
                    {!! $sections['about_us']->content ?? '<p> Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility. A variety of exotic flowers, redwood trees and intersecting gravel and flagstone paths besides the fountains make it a perfect destination and a timeless treasure for all your special events. </p><p>Amaanta has a lush green 2.5 acre farm and a semi-covered area of approximately 13,000 sq. feet and has been a landmark in the vicinity for over 8 years. We are a professionally managed company with qualified & experienced professionals from the industry who are fully equipped to cater to your every need.</p>' !!}
                    <ul class="list-unstyled about-list mb-30">
                        <li>
                            <div class="about-list-icon"> <span class="ti-check"></span> </div>
                            <div class="about-list-text">
                                <p>{{ $sections['about_us']->meta['bullet1'] ?? '8 Years of Experience' }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="about-list-icon"> <span class="ti-check"></span> </div>
                            <div class="about-list-text">
                                <p>{{ $sections['about_us']->meta['bullet2'] ?? '250+ Wedding Planner' }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 offset-md-1 animate-box" data-animate-effect="fadeInUp">
                    <div class="img-exp">
                        <div class="about-img">
                            <div class="img"> <img src="/assets/img/about.jfif" class="img-fluid" alt=""> </div>
                        </div>
                        <!-- circle svg omitted for brevity -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Promo Video -->
    <section class="video-wrapper video section-padding bg-img bg-fixed" data-overlay-dark="4" data-background="/assets/img/slider/sliderbg-1.JPEG">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="section-subtitle"><span>Be Inspired</span></div>
                    <div class="section-title white">Latest wedding <span>Video</span></div>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12">
                    <a class="vid" href="https://youtu.be/Bhy9jegsdt4?si=ImZ6BSI0_8Ux0hzv">
                        <div class="vid-butn"> <span class="icon">
                                <i class="ti-control-play"></i>
                            </span> </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog -->
    <section class="blog section-padding bg-green">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-30">
                    <div class="section-subtitle white">{{ $sections['blog']->heading ?? 'Latest News' }}</div>
                    <div class="section-title white">{!! $sections['blog']->content ?? 'Wedding <span class="white">Blog</span>' !!}</div>
                </div>
                <div class="col-md-7 mb-30">
                    @if(isset($sections['blog']->meta['description']))
                        <p class="white">{!! $sections['blog']->meta['description'] !!}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @foreach($posts->take(6) as $post)
                        <div class="item">
                            <div class="position-re o-hidden"> <img src="{{ $post->featured_image ?: '/assets/img/default-post.jpg' }}" alt="{{ $post->title }}"> </div>
                            <div class="con"> 
                                <span class="category">{{ $post->created_at->format('d M Y') }} in <a href="#0">{{ $post->category }}</a></span>
                                <h5><a href="/blog/{{ $post->slug }}">{{ $post->title }}</a></h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup -->
    <section class="signup">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="img left"> <img src="/assets/img/signup.jfif" alt=""> </div>
                </div>
                <div class="col-md-6 p-0 valign">
                    <div class="content">
                        <div class="cont text-left">
                            <h6>Sign Up</h6>
                            <h4>Subscribe to the <span>Newsletter</span></h4>
                            <p>For the latest inspiration and insider tips straight to your inbox.</p>
                            <form method="post" class="contact__form" action="mail.php">
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

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-column footer-about">
                        <h3 class="footer-title"><a class="logo" href="{{ route('home') }}"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a></h3>
                        <p class="footer-about-text">{{ $settings['footer_about'] ?? 'Amaanta, a world class farm in Delhi is a natural haven that provides a sense of tranquility. Amaanta has a lush green 2.5 acre farm and a semi-covered area of approximately 13,000 sq. feet and has been a landmark in the vicinity for over 8 years.' }}</p>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="footer-column footer-explore clearfix">
                        <h3 class="footer-title">Explore</h3>
                        <ul class="footer-explore-list list-unstyled">
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li><a href="{{ route('memorybook') }}">Memorybook</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">Get in touch</h3>
                        <p class="footer-contact-text">{{ $settings['address'] ?? '68-73 Bijwasan Road, Kapashera, New Delhi - 37' }}</p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone"><span class="ti-headphone-alt"></span> {{ $settings['contact_no'] ?? '+91-9971009669' }}</p>
                            <p class="footer-contact-mail">{{ $settings['contact_email'] ?? 'gm.amaanta@gmail.com' }}</p>
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
                        <p class="footer-bottom-copy-right">Copyright © {{ now()->year }}  <a href="/" target="_blank">Amaanta</a></p>
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

