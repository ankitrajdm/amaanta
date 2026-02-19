@extends('layouts.app')
@section('content')
<h1>Edit {{ $page->title }}</h1>
<form method="POST" action="{{ route('admin.pages.update', $page) }}">@csrf @method('PUT')
<input name="title" value="{{ $page->title }}">
<input name="meta_title" value="{{ $page->meta_title }}" placeholder="Meta title">
<input name="meta_description" value="{{ $page->meta_description }}" placeholder="Meta description">
<label><input type="checkbox" name="is_active" value="1" {{ $page->is_active ? 'checked' : '' }}> Active</label>
<button>Save Page</button>
</form>
<hr>
@foreach($page->sections as $section)
<form method="POST" action="{{ route('admin.sections.update', $section) }}" style="margin-bottom:1rem; border:1px solid #ddd; padding:0.75rem;">@csrf @method('PUT')
<strong>{{ $section->section_key }}</strong>
<input name="heading" value="{{ $section->heading }}">
<textarea name="content">{{ $section->content }}</textarea>
<input type="number" name="position" value="{{ $section->position }}">
<label><input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}> Active</label>
<button>Save Section</button>
</form>
@endforeach
@endsection
