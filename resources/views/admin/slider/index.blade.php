@extends('admin.layout')

@section('title', 'Service Sliders')
@section('page-title', 'Service Sliders')

@section('content')
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Service Image Sliders</h1>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Slider
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Slider Title</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->service->title }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>
                        @foreach($slider->images as $img)
                            <img src="{{ asset('storage/' . ltrim($img->image_path, '/')) }}" alt="" width="60" style="margin:2px;">
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.slider.edit', $slider) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ route('admin.slider.destroy', $slider) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
