<!-- resources/views/admin/audit-logs/index.blade.php -->

@extends('layouts.admin')  <!-- Assuming you have an admin layout -->

@section('content')
    <div class="container">
        <h1 class="mb-4">Audit Logs</h1>

        <!-- Check if there are any logs -->
        @if($auditLogs->isEmpty())
            <div class="alert alert-warning">No audit logs found.</div>
        @else
            <!-- Table for displaying the audit logs -->
            <table class="table table-striped">
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
                            <td>{{ $log->event }}</td>
                            <td>{{ $log->description }}</td>
                            <td>
                                <!-- Display the auditable's type and ID -->
                                {{ $log->auditable_type }} (ID: {{ $log->auditable_id }})
                            </td>
                            <td>{{ $log->user->name ?? 'N/A' }}</td> <!-- Display the user that triggered the action -->
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td> <!-- Format timestamp -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $auditLogs->links() }}
            </div>
        @endif
    </div>
@endsection
