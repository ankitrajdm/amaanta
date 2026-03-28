@extends('admin.layout')

@section('title', 'Bookings Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Bookings Management</h1>
            <a href="{{ route('admin.bookings.export', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-download"></i> Export to Excel
            </a>
        </div>
    </div>
</div>

<!-- Date Filter Form -->
<div class="card mb-4">
    <div class="card-header">
        <h5>Filter Bookings</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

@if($bookings->count() > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Event Date</th>
                        <th>Total Cost</th>
                        <th>Advance</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->event_date ? $booking->event_date->format('M d, Y') : 'N/A' }}</td>
                        <td>₹{{ number_format($booking->total_cost, 2) }}</td>
                        <td>₹{{ number_format($booking->advance_payment, 2) }}</td>
                        <td>
                            <span class="badge
                                @if($booking->status == 'pending') bg-warning
                                @elseif($booking->status == 'confirmed') bg-info
                                @elseif($booking->status == 'completed') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this booking?')"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@else
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> No bookings found matching your criteria.
</div>
@endif
@endsection