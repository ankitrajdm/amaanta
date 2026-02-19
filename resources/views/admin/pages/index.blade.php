@extends('layouts.app')
@section('content')
<h1>Manage Pages</h1>
<ul>
@foreach($pages as $page)
<li><a href="{{ route('admin.pages.edit', $page) }}">{{ $page->title }}</a> ({{ $page->sections_count }} sections)</li>
@endforeach
</ul>
@endsection
