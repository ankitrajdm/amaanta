@extends('admin.layout')

@section('title', isset($page) ? 'Edit Page' : 'Create Page')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($page) ? 'Edit Page' : 'Create Page' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}" method="POST">
            @csrf
            @if(isset($page))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $page->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Page Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                       id="slug" name="slug" value="{{ old('slug', $page->slug ?? '') }}" required>
                <small class="form-text text-muted">Used for URL (e.g., /about-us)</small>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                       id="meta_title" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" 
                       maxlength="160" placeholder="Max 160 characters">
                @error('meta_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                          id="meta_description" name="meta_description" rows="3" 
                          maxlength="255" placeholder="Max 255 characters">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                           {{ old('is_active', $page->is_active ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Publish Page
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($page) ? 'Update' : 'Create' }} Page
                </button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
