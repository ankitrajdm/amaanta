@extends('layouts.frontend')

@section('content')
<!-- Article Header -->
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 80px 0;">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">{{ $post->title }}</h1>
        <div class="mb-3">
            <small><i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('F d, Y') }}</small>
            @if($post->user)
                <small class="ms-3"><i class="fas fa-user"></i> By {{ $post->user->name }}</small>
            @endif
        </div>
    </div>
</section>

<!-- Article Content -->
<section>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($post->featured_image)
                    <div class="mb-4">
                        <img src="{{ strpos($post->featured_image, 'http') === 0 || strpos($post->featured_image, '/') === 0 ? $post->featured_image : asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="box-shadow: 0 4px 12px rgba(0,0,0,0.15); max-height: 500px; object-fit: cover; width: 100%;">
                    </div>
                @endif

                <div style="color: #555; line-height: 1.9; font-size: 1.05rem;">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && $post->tags->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="mb-3">Tags:</h6>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('blog', ['tag' => $tag->slug]) }}" class="badge" style="background: var(--primary); text-decoration: none; color: white; font-size: 0.9rem; padding: 0.5rem 0.75rem; margin: 0.25rem;">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Share -->
                <div class="mt-5 pt-4 border-top">
                    <h6 class="mb-3">Share Article:</h6>
                    <div>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}" target="_blank" class="btn btn-sm" style="background: #3b5998; color: white; text-decoration: none;">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->full() }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm" style="background: #1DA1F2; color: white; text-decoration: none;">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->full() }}" target="_blank" class="btn btn-sm" style="background: #0077b5; color: white; text-decoration: none;">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- About Post -->
                <div class="card mb-4" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Quick Info</h6>
                        <p class="text-muted mb-2">
                            <strong>Published:</strong><br> {{ $post->created_at->format('M d, Y') }}
                        </p>
                        @if($post->category)
                            <p class="text-muted">
                                <strong>Category:</strong><br>
                                <a href="{{ route('blog', ['category' => $post->categories->first()?->slug ?? '#']) }}" style="color: var(--primary); text-decoration: none;">
                                    {{ $post->categories->first()?->name ?? 'Uncategorized' }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Related Articles -->
                @if($relatedPosts && $relatedPosts->count() > 0)
                    <div class="card" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Related Articles</h6>
                            @foreach($relatedPosts as $related)
                                <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                                    <a href="{{ route('blog.detail', $related->slug) }}" class="text-decoration-none" style="color: var(--primary);">
                                        <strong>{{ $related->title }}</strong>
                                    </a>
                                    <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem;">
                                        <i class="fas fa-calendar-alt"></i> {{ $related->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
