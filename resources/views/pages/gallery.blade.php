@extends('layouts.frontend')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection

@section('content')
@php
    $sections = $page && $page->sections ? collect($page->sections)->keyBy('section_key') : collect();
@endphp

<!-- Hero Section -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 100px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">{!! $sections['hero']->heading ?? 'Memorybook & Gallery' !!}</h1>
        <p class="lead">{!! $sections['hero']->content ?? 'Captured moments from our events' !!}</p>
    </div>
</section>

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

<!-- CTA Section -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 80px 0; text-align: center;">
    <div class="container">
        <h2 class="display-5 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Create Your Own Memories</h2>
        <p class="lead mb-4">Let us help you organize your next event</p>
        <a href="/contact" class="btn btn-primary">
            <i class="fas fa-envelope"></i> Plan Your Event
        </a>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': false,
        'albumLabel': 'Photo %1 of %2'
    })
</script>
@endsection
