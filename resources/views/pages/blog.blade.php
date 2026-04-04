@extends('layouts.frontend')

@section('content')
<!-- Hero Section -->
@php
    // allow custom blog page header via a Page record with sections
    $hero = null;
    if(isset(
        $page) && $page && $page->sections) {
        $hero = $page->sections->first();
    }
@endphp
<section style="background: linear-gradient(135deg, var(--primary) 0%, rgba(100, 50, 150, 0.9) 100%); color: white; padding: 100px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">
            {!! $hero->heading ?? 'Blog & Insights' !!}
        </h1>
        <p class="lead">
            {!! $hero->content ?? 'Articles, tips, and stories from our world' !!}
        </p>
        @if(isset($hero->meta['description']))
            <p class="mt-3">{!! $hero->meta['description'] !!}</p>
        @endif
    </div>
</section>

<!-- Blog Content -->
<section>
    <div class="container">
        <div class="row g-5">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                @forelse($posts as $post)
                    <div class="card feature-card mb-4">
                        @if($post->featured_image)
                            @php
                                $imageSrc = strpos($post->featured_image, 'http') === 0 || strpos($post->featured_image, '/') === 0 
                                    ? $post->featured_image 
                                    : asset('storage/' . $post->featured_image);
                            @endphp
                            <img src="{{ $imageSrc }}" style="height: 300px; object-fit: cover;" alt="{{ $post->title }}" onerror="this.parentElement.style.display='none'">
                        @else
                            <div style="height: 300px; background: linear-gradient(135deg, var(--accent), var(--primary)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper fa-4x" style="color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('M d, Y') }}
                                </small>
                            </div>
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{{ substr($post->excerpt ?? $post->content, 0, 200) }}...</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('blog.detail', $post->slug) }}" class="btn btn-sm" style="background: var(--accent); color: #1a0033; border: none; text-decoration: none;">
                                    Read Full Article <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No blog posts available at the moment.
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search -->
                <div class="card mb-4" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Search Articles</h5>
                        <form method="GET" action="{{ route('blog') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                <button class="btn" style="background: var(--primary); color: white; border: 1px solid var(--primary);" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                @if($categories->count() > 0)
                    <div class="card mb-4" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Categories</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="{{ route('blog') }}" class="text-decoration-none" style="color: var(--primary);">
                                        <i class="fas fa-folder"></i> All Posts
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="mb-2">
                                        <a href="{{ route('blog', ['category' => $category->slug]) }}" class="text-decoration-none" style="color: var(--primary);">
                                            <i class="fas fa-folder"></i> {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Tags -->
                @if($popularTags->count() > 0)
                    <div class="card" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Popular Tags</h5>
                            <div>
                                @foreach($popularTags as $tag)
                                    <a href="{{ route('blog', ['tag' => $tag->slug]) }}" class="badge" style="background: var(--primary); text-decoration: none; color: white; font-size: 0.85rem; padding: 0.5rem 0.75rem; margin: 0.25rem;">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
