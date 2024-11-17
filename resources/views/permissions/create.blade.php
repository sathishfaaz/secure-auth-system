@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Create New Permission</h2>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to Create New Permission -->
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf

            <!-- Permission Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter permission name" required value="{{ old('name') }}">
                <small class="form-text text-muted">Provide a unique name for the permission (e.g., "edit-posts", "delete-users").</small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-lg">Create Permission</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-lg ml-2">Back to Permissions</a>
        </form>
    </div>
@endsection
