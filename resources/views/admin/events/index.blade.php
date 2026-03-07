@extends('admin.layout')

@section('title', 'Events')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Events</h1>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Event
            </a>
        </div>
    </div>
</div>

@if($events->count() > 0)
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td><strong>{{ $event->title }}</strong></td>
                    <td>{{ $event->event_date?->format('M d, Y') }}</td>
                    <td>
                        @if($event->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-warning">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline;">
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
    <i class="fas fa-info-circle"></i> No events found. <a href="{{ route('admin.events.create') }}">Create one now</a>
</div>
@endif
@endsection
