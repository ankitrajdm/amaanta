@extends('layouts.app')
@section('content')
<h1>Posts / Blog Manager</h1>
<form method="POST" action="{{ route('admin.posts.store') }}">@csrf
<input name="title" placeholder="Post title" required>
<input name="slug" placeholder="post-slug" required>
<input name="category" placeholder="Category">
<input name="featured_image" placeholder="Image path">
<textarea name="excerpt" placeholder="Excerpt"></textarea>
<textarea name="content" placeholder="Content" required></textarea>
<label><input type="checkbox" name="is_published" value="1"> Publish</label>
<button>Create Post</button>
</form>
<ul>@foreach($posts as $post)<li>{{ $post->title }} - {{ $post->is_published ? 'Published' : 'Draft' }}</li>@endforeach</ul>
@endsection
