@php
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $service->title }} - {{ $settings['website_name'] ?? 'Amaanta Farms' }}</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('memorybook') }}">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Banner -->
    <div class="banner-header about-header-bg section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="{{ asset('assets/img/ab-02.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-5 slider-text js-fullheight">
                    <div class="slider-text-inner">
                        <div class="desc text-start">
                            <h4>{{ $service->title }}</h4>
                            <h1>{{ $service->title }}</h1>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>

    <!-- No Content Message -->
    @if((!$sliders || $sliders->count() == 0) && (!$galleryImages || $galleryImages->count() == 0))
    <section style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading mb-4">Gallery Coming Soon</h2>
                    <p class="lead">We're working on adding beautiful images for this service. Check back soon!</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Service Sliders -->
    @if($sliders && $sliders->count() > 0)
    @foreach($sliders as $slider)
    <section style="padding: 80px 0; background: white;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{ $slider->title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme slider-carousel">
                        @foreach($slider->images as $image)
                        <div class="item">
                            <div style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); height: 300px; background: #eee;">
                                <img src="{{ asset(ltrim($image->image_path, '/')) }}" alt="{{ $slider->title }}" class="img-fluid image-popup" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @endif

    <!-- Service Gallery Slider -->
    @if($galleryImages && $galleryImages->count() > 0)
    <section style="padding: 80px 0; background: #101010;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{ $galleryImages->first()->title }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme event-carousel">
                        @foreach($galleryImages as $image)
                        <div class="item">
                            <div style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); height: 300px; background: #eee;">
                                <img src="{{ asset(ltrim($image->image_path, '/')) }}" alt="{{ $image->title }}" class="img-fluid image-popup" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

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

    @include('partials.footer')

    <!-- Scripts -->
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
        $('.event-carousel, .slider-carousel').owlCarousel({
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
</html>