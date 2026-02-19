@extends('layouts.app')
@section('content')
<h1>Memorybook / Gallery</h1>
<form method="POST" action="{{ route('admin.gallery.store') }}">@csrf
<input name="title" placeholder="Title" required>
<input name="event_name" placeholder="Event name">
<input name="image_path" placeholder="assets/img/..." required>
<label><input type="checkbox" name="is_active" value="1" checked> Active</label>
<button>Add Image</button>
</form>
<ul>@foreach($images as $image)<li>{{ $image->title }} - {{ $image->event_name }}</li>@endforeach</ul>
@endsection
