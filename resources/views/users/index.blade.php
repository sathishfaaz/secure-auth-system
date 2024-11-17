@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Users</h1>
        
        <!-- Add User Button -->
        <div class="text-right mb-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus"></i> Add User
            </a>
        </div>
        
        <!-- Users Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            <span class="badge {{ $user->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Toggle Status Button -->
                            <form action="{{ route('users.toggleStatus', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-toggle-on"></i> {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>

                            <!-- Manage Permissions Button -->
                            <a href="{{ route('users.editPermissions', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-cogs"></i> Manage Permissions
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>
@endsection
