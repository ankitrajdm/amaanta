@extends('admin.layout')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')
@section('page-title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
            @csrf
            @if(isset($testimonial)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Author Name <span class="text-danger">*</span></label>
                <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name ?? '') }}" required class="form-control">
                @error('author_name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Author Title</label>
                <input type="text" name="author_title" value="{{ old('author_title', $testimonial->author_title ?? '') }}" placeholder="e.g., CEO, Client" class="form-control">
                @error('author_title') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Testimonial <span class="text-danger">*</span></label>
                <textarea name="quote" required rows="5" class="form-control">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
                @error('quote') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }} class="form-check-input" id="is_active">
                <label for="is_active" class="form-check-label">Active (Show on website)</label>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($testimonial) ? 'Update' : 'Add' }} Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
