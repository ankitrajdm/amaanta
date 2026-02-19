@extends('layouts.app')

@section('content')
<h1>{{ $settings['website_name'] }}</h1>
@foreach(($page?->sections ?? collect()) as $section)
    <section style="margin: 1rem 0; border:1px solid #ddd; padding:1rem;">
        <h2>{{ $section->heading }}</h2>
        <p>{{ $section->content }}</p>
    </section>
@endforeach

@if($testimonials->isNotEmpty())
<h3>Testimonials</h3>
@foreach($testimonials as $testimonial)
    <blockquote>“{{ $testimonial->quote }}” — {{ $testimonial->author_name }}</blockquote>
@endforeach
@endif

@if($posts->isNotEmpty())
<h3>Latest Blog Posts</h3>
<ul>
    @foreach($posts as $post)
        <li>{{ $post->title }} ({{ $post->category }})</li>
    @endforeach
</ul>
@endif
@endsection
