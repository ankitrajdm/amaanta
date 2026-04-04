@extends('admin.layout')

@section('title', isset($editGroup) ? 'Edit Gallery Group' : (isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image'))
@section('page-title', isset($editGroup) ? 'Edit Gallery Group' : (isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image'))

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>{{ isset($editGroup) ? 'Edit Gallery Group' : (isset($image) ? 'Edit Gallery Image' : 'Add Gallery Image') }}</h1>
    </div>
</div>

@if(isset($editGroup) && $groupImages)
<div class="card mb-4">
    <div class="card-header">
        <h5>Current Images in "{{ $editGroup }}" Group</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($groupImages as $img)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset(ltrim($img->image_path, '/')) }}" class="card-img-top" alt="{{ $img->title }}" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.gallery.edit', $img) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.gallery.destroy', $img) }}" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($editGroup) ? route('admin.gallery.store') : (isset($image) ? route('admin.gallery.update', $image->id) : route('admin.gallery.store')) }}" enctype="multipart/form-data">
            @csrf
            @if(isset($image)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Image Title <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title', $editGroup ?? $image->title ?? '') }}" required class="form-control">
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
                <input type="file" name="image{{ isset($image) ? '' : '[]' }}" accept="image/*" {{ isset($editGroup) || !isset($image) ? 'multiple' : '' }} {{ !isset($image) && !isset($editGroup) ? 'required' : '' }} class="form-control">
                @if(isset($image) && $image->image_path)
                    <div class="mt-2 small text-muted">Current image: {{ $image->image_path }}</div>
                @endif
                @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $image->is_active ?? true) ? 'checked' : '' }} class="form-check-input" id="is_active">
                <label for="is_active" class="form-check-label">Active (Show on website)</label>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($editGroup) ? 'Add Images to Group' : (isset($image) ? 'Update' : 'Add') }} {{ isset($editGroup) ? 'Group' : 'Image' }}</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
