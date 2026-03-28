@extends('admin.layout')

@section('title', 'Contact Forms')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Contact Forms</h1>
            <div>
                <a href="{{ route('admin.contact-forms.export', request()->query()) }}" class="btn btn-success me-2">
                    <i class="fas fa-download"></i> Export to Excel
                </a>
                <a href="{{ route('admin.contact-forms.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Contact Form
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Date Filter Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Contact Forms</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.contact-forms.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.contact-forms.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

@if($contactForms->count() > 0)
<div class="card">
    <div class="card-header">
        <h5>Contact Forms List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Event Type</th>
                        <th>Event Date</th>
                        <th>Guests</th>
                        <th>Services</th>
                        <th>Budget</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Response Status</th>
                        <th>Responded At</th>
                        <th>Admin Notes</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactForms as $form)
                    <tr>
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->name }}</td>
                        <td>{{ $form->email }}</td>
                        <td>{{ $form->phone }}</td>
                        <td>{{ $form->event_type }}</td>
                        <td>{{ $form->event_date ? $form->event_date->format('d M Y') : '-' }}</td>
                        <td>{{ $form->guests }}</td>
                        <td>{{ $form->services ? implode(', ', $form->services) : '-' }}</td>
                        <td>{{ $form->budget }}</td>
                        <td>{{ Str::limit($form->message, 50) }}</td>
                        <td>
                            <span class="badge bg-{{ $form->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($form->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $form->response_status === 'responded' ? 'success' : ($form->response_status === 'follow_up_needed' ? 'warning' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $form->response_status)) }}
                            </span>
                        </td>
                        <td>{{ $form->responded_at ? $form->responded_at->format('d M Y H:i') : '-' }}</td>
                        <td>{{ $form->admin_notes ? Str::limit($form->admin_notes, 30) : '-' }}</td>
                        <td>{{ $form->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.contact-forms.edit', $form) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.contact-forms.destroy', $form) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this contact form?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $contactForms->links() }}
        </div>
    </div>
</div>
@else
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> No contact forms found. <a href="{{ route('admin.contact-forms.create') }}">Create one now</a>
</div>
@endif
@endsection
