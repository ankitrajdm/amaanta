@extends('admin.layout')

@section('title', 'Gallery')
@section('page-title', 'Gallery')

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Gallery</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Upload Images
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="row g-3 mb-4">
            @csrf
            <div class="col-md-3">
                <input type="text" name="title" placeholder="Title" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="file" name="image[]" accept="image/*" multiple class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="service_id" class="form-control">
                    <option value="">Select Service (Optional)</option>
                    @foreach(\App\Models\Service::where('is_active', true)->get() as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="event_id" class="form-control">
                    <option value="">Select Event (Optional)</option>
                    @foreach(\App\Models\Event::where('is_active', true)->get() as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">Upload</button>
            </div>
        </form>

        <div class="row">
            @foreach($images as $image)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . ltrim($image->image_path, '/')) }}" class="card-img-top" alt="{{ $image->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $image->title }}</h5>
                            <p class="card-text">
                                <strong>Event:</strong> {{ $image->event ? $image->event->title : 'N/A' }}<br>
                                <strong>Service:</strong> {{ $image->service ? $image->service->title : 'N/A' }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.gallery.edit', $image) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
