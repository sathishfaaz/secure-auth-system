@extends('layouts.app')

@section('content')
<h2>Roles</h2>
<a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
            <td>
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
<div class="d-flex justify-content-center mt-4">
   
    {{ $roles->links('pagination::simple-bootstrap-4') }}
</div>

@endsection
