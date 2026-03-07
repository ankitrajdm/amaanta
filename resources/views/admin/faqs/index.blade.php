@extends('admin.layout')

@section('title', 'FAQs')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>FAQs</h1>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add FAQ
            </a>
        </div>
    </div>
</div>

@if($faqs->count() > 0)
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Question</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td><strong>{{ Str::limit($faq->question, 50) }}</strong></td>
                    <td>
                        @if($faq->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-warning">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:inline;">
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
    <i class="fas fa-info-circle"></i> No FAQs found. <a href="{{ route('admin.faqs.create') }}">Create one now</a>
</div>
@endif
@endsection
