@extends('admin.layout')

@section('title', 'Guest Feedbacks')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Guest Feedbacks</h1>
            <div>
                <a href="{{ route('admin.guest-feedbacks.export', request()->query()) }}" class="btn btn-success me-2">
                    <i class="fas fa-download"></i> Export to Excel
                </a>
                <a href="{{ route('admin.guest-feedbacks.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Guest Feedback
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Date Filter Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Guest Feedbacks</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.guest-feedbacks.index') }}" class="row g-3">
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
                <a href="{{ route('admin.guest-feedbacks.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

@if($guestFeedbacks->count() > 0)
<div class="card">
    <div class="card-header">
        <h5>Guest Feedbacks List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Guest Name</th>
                        <th>Room #</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Service Quality</th>
                        <th>Cleanliness</th>
                        <th>Staff</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guestFeedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->guest_name }}</td>
                        <td>{{ $feedback->room_number }}</td>
                        <td>{{ $feedback->check_in_date ? $feedback->check_in_date->format('d M Y') : '-' }}</td>
                        <td>{{ $feedback->check_out_date ? $feedback->check_out_date->format('d M Y') : '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $feedback->service_quality === 'Excellent' ? 'success' : ($feedback->service_quality === 'Very Good' ? 'primary' : ($feedback->service_quality === 'Good' ? 'info' : ($feedback->service_quality === 'Satisfactory' ? 'warning' : 'danger'))) }}">
                                {{ $feedback->service_quality }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $feedback->cleanliness === 'Excellent' ? 'success' : ($feedback->cleanliness === 'Very Good' ? 'primary' : ($feedback->cleanliness === 'Good' ? 'info' : ($feedback->cleanliness === 'Satisfactory' ? 'warning' : 'danger'))) }}">
                                {{ $feedback->cleanliness }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $feedback->staff_rating === 'Excellent' ? 'success' : ($feedback->staff_rating === 'Very Good' ? 'primary' : ($feedback->staff_rating === 'Good' ? 'info' : ($feedback->staff_rating === 'Satisfactory' ? 'warning' : 'danger'))) }}">
                                {{ $feedback->staff_rating }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $feedback->status === 'new' ? 'primary' : ($feedback->status === 'reviewed' ? 'success' : 'secondary') }}">
                                {{ ucfirst($feedback->status) }}
                            </span>
                        </td>
                        <td>{{ $feedback->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.guest-feedbacks.show', $feedback) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.guest-feedbacks.edit', $feedback) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.guest-feedbacks.destroy', $feedback) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $guestFeedbacks->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
        <h5>No Guest Feedbacks Found</h5>
        <p class="text-muted">There are no guest feedbacks matching your criteria.</p>
        <a href="{{ route('admin.guest-feedbacks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add First Feedback
        </a>
    </div>
</div>
@endif
@endsection