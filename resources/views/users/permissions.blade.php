@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Assign Permissions to User</h2>

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

        <form action="{{ route('users.assignPermissions', $user->id) }}" method="POST">
            @csrf
            @method('POST')

            <!-- Permissions Multi-Select Dropdown -->
            <div class="form-group">
                <label for="permissions">Select Permissions:</label>
                <select name="permissions[]" id="permissions" multiple class="form-control" required>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" 
                            {{ $user->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Hold down CTRL (Windows) or Command (Mac) to select multiple permissions.</small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-lg mt-3">Assign Permissions</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg mt-3 ml-2">Back to Users</a>
        </form>
    </div>
@endsection
