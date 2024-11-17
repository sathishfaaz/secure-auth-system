@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Edit User</h2>

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

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

            <!-- Role Field (Multiple Selection) -->
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="roles[]" id="role" multiple class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" 
                            {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray())) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-lg mt-3">Update User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg mt-3 ml-2">Back to Users</a>
        </form>
    </div>
@endsection
