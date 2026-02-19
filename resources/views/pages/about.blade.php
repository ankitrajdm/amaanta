@extends('layouts.app')

@section('content')
<h1>{{ $page?->title ?? 'About' }}</h1>
@foreach(($page?->sections ?? collect()) as $section)
    <section style="margin-bottom:1rem;">
        <h2>{{ $section->heading }}</h2>
        <p>{{ $section->content }}</p>
    </section>
@endforeach
@endsection
