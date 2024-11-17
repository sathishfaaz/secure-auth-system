<!-- resources/views/admin/audit-logs/index.blade.php -->

@extends('layouts.app')  <!-- Assuming you have an admin layout -->

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Audit Logs</h1>

        <!-- Check if there are any logs -->
        @if($auditLogs->isEmpty())
            <div class="alert alert-warning">
                <strong>No audit logs found.</strong>
            </div>
        @else
            <!-- Search and Filter Section (Optional) -->
            <div class="mb-4 d-flex justify-content-between">
                <form method="GET" action="{{ route('audit.logs') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by event or description" value="{{ request()->input('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

              
            </div>

            <!-- Table for displaying the audit logs -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Description</th>
                            <th>Auditable</th>
                            <th>User</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auditLogs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $log->event }}</strong></td>
                                <td>{{ \Str::limit($log->description, 50) }}</td> <!-- Limit description to 50 chars -->
                                <td>
                                    {{ $log->auditable_type }} (ID: {{ $log->auditable_id }})
                                </td>
                                <td>{{ $log->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
           <div class="d-flex justify-content-center mt-4">
    {{ $auditLogs->links('pagination::simple-bootstrap-4') }}
</div>
        @endif
    </div>
@endsection
