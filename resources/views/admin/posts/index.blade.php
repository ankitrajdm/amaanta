@extends('admin.layout')

@section('title', 'Posts')
@section('page-title', 'Posts')

@section('content')
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h1>Posts / Blog Manager</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Post</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->is_published ? 'Published' : 'Draft' }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-info">Edit</a>
                            <a href="#" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
