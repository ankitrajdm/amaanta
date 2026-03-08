@extends('admin.layout')

@section('title', 'Edit Service Slider')
@section('page-title', 'Edit Service Slider')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Edit Service Image Slider</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.slider.update', $slider) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="service_id" class="form-label">Select Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @if($slider->service_id == $service->id) selected @endif>{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Slider Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $slider->title }}" required>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images (add more)</label>
                <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                <div id="image-preview" class="mt-3"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Images</label>
                <div>
                    @foreach($slider->images as $img)
                        <img src="{{ asset('storage/' . ltrim($img->image_path, '/')) }}" alt="" width="60" style="margin:2px;">
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </form>
    </div>
</div>

<script>
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.margin = '5px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
