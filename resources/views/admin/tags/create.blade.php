@extends('admin.layout')

@section('title', isset($tag) ? 'Edit Tag' : 'Create Tag')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ isset($tag) ? route('admin.tags.update', $tag) : route('admin.tags.store') }}" method="POST">
            @csrf
            @if(isset($tag))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $tag->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $tag->slug ?? '') }}" required>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ isset($tag) ? 'Update' : 'Create' }} Tag
                </button>
                <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
