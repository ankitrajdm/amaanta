@extends('admin.layout')

@section('title', isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image')
@section('page-title', isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image' }}</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($image) ? route('admin.gallery.update', $image->id) : route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($image)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Image Title <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title', $image->title ?? '') }}" required class="form-control">
                @error('title') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Service</label>
                <select name="service_id" class="form-control" id="service_id">
                    <option value="">Select Service (Optional)</option>
                    @foreach(\App\Models\Service::where('is_active', true)->get() as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $image->service_id ?? '') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Event</label>
                <select name="event_id" class="form-control" id="event_id">
                    <option value="">Select Event (Optional)</option>
                    @foreach(\App\Models\Event::where('is_active', true)->get() as $event)
                    <option value="{{ $event->id }}" {{ old('event_id', $image->event_id ?? '') == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Image File <span class="text-danger">*</span></label>
                <input type="file" name="image{{ isset($image) ? '' : '[]' }}" accept="image/*" {{ isset($image) ? '' : 'multiple' }} {{ !isset($image) ? 'required' : '' }} class="form-control">
                @if(isset($image) && $image->image_path)
                    <div class="mt-2 small text-muted">Current image: {{ $image->image_path }}</div>
                @endif
                @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $image->is_active ?? true) ? 'checked' : '' }} class="form-check-input" id="is_active">
                <label for="is_active" class="form-check-label">Active (Show on website)</label>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($image) ? 'Update' : 'Add' }} Image</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
