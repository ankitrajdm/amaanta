@extends('admin.layout')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('content')
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Testimonial
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @foreach($testimonials as $t)
            <div class="mb-3 p-3 border rounded d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $t->author_name }}</strong> <span class="text-muted">— {{ $t->author_title }}</span>
                    <p class="mb-0">{{ $t->quote }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-info">Edit</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
