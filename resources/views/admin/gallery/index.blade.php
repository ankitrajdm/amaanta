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
        <div class="d-flex gap-2">
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Upload Images
            </a>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-success">
                <i class="fas fa-images"></i> Create Slider
            </a>
        </div>
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
            @foreach($groupedImages as $title => $images)
                <div class="col-12 mb-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $title }}</h4>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" onclick="editGroup('{{ $title }}')">
                                    <i class="fas fa-edit"></i> Edit Group
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteGroup('{{ $title }}')">
                                    <i class="fas fa-trash"></i> Delete Group
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($images as $image)
                                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ asset(ltrim($image->image_path, '/')) }}" class="card-img-top" alt="{{ $image->title }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-body p-2">
                                                <p class="card-text small mb-2">
                                                    <strong>Event:</strong> {{ $image->event ? $image->event->title : 'N/A' }}<br>
                                                    <strong>Service:</strong> {{ $image->service ? $image->service->title : 'N/A' }}
                                                </p>
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-sm btn-outline-primary" onclick="editImage({{ $image->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteImage({{ $image->id }}, '{{ $image->title }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function editGroup(title) {
    // Redirect to create page with title pre-filled for editing group
    window.location.href = '{{ route("admin.gallery.create") }}?edit_group=' + encodeURIComponent(title);
}

function deleteGroup(title) {
    if (confirm('Are you sure you want to delete all images in the "' + title + '" group?')) {
        // Create a form to submit delete request for all images in the group
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.gallery.delete-group") }}';
        form.innerHTML = `
            @csrf
            @method('DELETE')
            <input type="hidden" name="title" value="${title}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

function editImage(imageId) {
    window.location.href = '{{ route("admin.gallery.edit", ":id") }}'.replace(':id', imageId);
}

function deleteImage(imageId, title) {
    if (confirm('Are you sure you want to delete this image from "' + title + '" group?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.gallery.destroy", ":id") }}'.replace(':id', imageId);
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
