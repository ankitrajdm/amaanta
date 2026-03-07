
@php
    $settings = \App\Models\WebsiteSetting::pluck('value', 'key')->toArray();
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Memorybook - {{ $settings['website_name'] ?? 'Amaanta Farms' }}</title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="logo-wrapper">
                <a class="logo" href="{{ route('home') }}"> <img src="/assets/img/logonew.png" class="logo-img" alt=""> </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('memorybook') }}">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner/Header -->
    <div class="banner-header about-header-bg section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="{{ asset('assets/img/ab-02.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-5 slider-text js-fullheight">
                    <div class="slider-text-inner">
                        <div class="desc text-start">
                            <h4>Memorybook</h4>
                            <h1>Captured Moments</h1>
                            <p>Relive the best memories from our events and celebrations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow bounce text-center">
            <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
        </div>
    </div>

    <!-- Gallery Section -->
    <section>
        <div class="container">
            @forelse($events as $event)
                @php $images = \App\Models\GalleryImage::where('event_name', $event->title)->where('is_active', true)->get(); @endphp
                <div class="mb-5">
                    <h2 class="section-heading" style="text-align: left;">{{ $event->title }}</h2>
                    @if($images->count() > 0)
                        <div class="gallery-grid">
                            @foreach($images as $image)
                                <div class="gallery-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}">
                                    <div class="gallery-overlay">
                                        <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="gallery-{{ $loop->index }}" title="{{ $image->title }}">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">No images available for this event yet.</div>
                    @endif
                </div>
                @if(!$loop->last)
                    <hr class="my-5">
                @endif
            @empty
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No events with photos available at the moment.
                </div>
            @endforelse

            <!-- All Images Gallery -->
            @if($allImages && $allImages->count() > 0)
                <div class="mt-5 pt-5 border-top">
                    <h2 class="section-heading">All Gallery Images</h2>
                    <div class="gallery-grid">
                        @foreach($allImages as $image)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}">
                                <div class="gallery-overlay">
                                    <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="all-gallery" title="{{ $image->title }}">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

   

    @include('partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': false,
            'albumLabel': 'Photo %1 of %2'
        })
    </script>
</body>
</html>
