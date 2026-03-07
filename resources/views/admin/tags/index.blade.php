@extends('admin.layout')

@section('title', 'Tags')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Tags</h1>
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Tag
            </a>
        </div>
    </div>
</div>

@if($tags->count() > 0)
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td><strong>{{ $tag->name }}</strong></td>
                    <td><code>{{ $tag->slug }}</code></td>
                    <td><span class="badge bg-info">{{ $tag->posts->count() }}</span></td>
                    <td>
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> No tags found. <a href="{{ route('admin.tags.create') }}">Create one now</a>
</div>
@endif
@endsection
