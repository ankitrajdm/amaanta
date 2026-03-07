@extends('admin.layout')

@section('title', 'Users')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Users</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add User
            </a>
        </div>
    </div>
</div>

@if($users->count() > 0)
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @forelse($user->roles as $role)
                            <span class="badge bg-secondary">{{ ucfirst($role->name) }}</span>
                        @empty
                            <span class="text-muted">No role assigned</span>
                        @endforelse
                    </td>
                    <td>
                        @if($user->is_active ?? true)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-warning">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> No users found. <a href="{{ route('admin.users.create') }}">Create one now</a>
</div>
@endif
@endsection
