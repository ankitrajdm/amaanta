@extends('admin.layout')

@section('title', 'Create Service Slider')
@section('page-title', 'Create Service Slider')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Create New Service Image Slider</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="service_id" class="form-label">Select Service</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Slider Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Upload Images</label>
                <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple required>
            </div>
            <button type="submit" class="btn btn-success">Create Slider</button>
        </form>
    </div>
</div>
@endsection
