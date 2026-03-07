@extends('admin.layout')

@section('title', 'Pages')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Pages</h1>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Page
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Sections</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td><strong>{{ $page->title }}</strong></td>
                        <td><code>{{ $page->slug }}</code></td>
                        <td><span class="badge bg-info">{{ $page->sections_count }}</span></td>
                        <td>
                            @if($page->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <p class="text-muted">No pages found. <a href="{{ route('admin.pages.create') }}">Create one</a></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
