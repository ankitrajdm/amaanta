@extends('admin.layout')

@section('title','Create New Menu')
@section('page-title','Create New Menu')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Create New Menu</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.menus.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Menu Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Location <span class="text-danger">*</span></label>
                <select name="location" required class="form-select">
                    <option value="">Select Location</option>
                    <option value="header" {{ old('location') === 'header' ? 'selected' : '' }}>Header Menu</option>
                    <option value="footer" {{ old('location') === 'footer' ? 'selected' : '' }}>Footer Menu</option>
                </select>
                @error('location') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success">Create Menu</button>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
