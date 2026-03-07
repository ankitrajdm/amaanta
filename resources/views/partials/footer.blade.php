@php
    // The home footer uses a more elaborate layout; we replicate it here
@endphp
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
                        <p class="footer-bottom-copy-right">© Copyright {{ now()->year }} by <a href="/" target="_blank">Amaanta</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>