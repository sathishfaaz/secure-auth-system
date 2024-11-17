@extends('layouts.app')

@section('content')
<h2>Permissions</h2>
<a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Create Permission</a>

<!-- Permissions Table -->
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
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
{{ $permissions->links('pagination::simple-bootstrap-4') }}
</div>

@endsection
