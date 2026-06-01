@extends('layouts.admin')

@section('title', 'User Management')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .dataTables_wrapper { padding: 0; }
    .dataTables_length { margin-bottom: 20px; }
    .dataTables_filter { margin-bottom: 20px; }
    .dataTables_filter label { display: flex; align-items: center; gap: 10px; margin: 0; }
    .dataTables_filter input { border-radius: 6px; border: 1px solid #dee2e6; padding: 8px 12px; font-size: 14px; min-width: 250px; }
    .dataTables_length label { display: flex; align-items: center; gap: 8px; margin: 0; }
    .dataTables_length select { padding: 6px 10px; border-radius: 6px; border: 1px solid #dee2e6; }
    #usersTable thead th { background: #f8f9fa; border-bottom: 2px solid #e3e6f0; color: #1D3557; font-weight: 600; padding: 16px !important; white-space: nowrap; cursor: pointer; user-select: none; }
    #usersTable thead th.sorting::after { margin-left: 8px; opacity: 0.8; }
    #usersTable tbody td { padding: 14px 16px !important; vertical-align: middle; border-bottom: 1px solid #f0f0f0; }
    #usersTable tbody tr { transition: background-color 0.2s ease; }
    #usersTable tbody tr:hover { background-color: #f8f9fa !important; }
    .dataTables_paginate { margin-top: 20px; }
    .dataTables_info { margin-top: 20px; color: #6c757d; font-size: 14px; }
    .page-link { color: #2C6CB0; border-color: #dee2e6; border-radius: 6px; margin: 0 2px; }
    .page-link:hover { color: #fff; background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.active .page-link { background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.disabled .page-link { color: #6c757d; background-color: #fff; border-color: #dee2e6; }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">User Management</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">
        <i class="bi bi-plus" style="font-size: 14px; margin-right: 6px;"></i>Add New User
    </a>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('users.index') }}" class="row g-3" id="filterForm">
            <div class="col-md-4">
                <label for="roleFilter" class="form-label">Filter by Role</label>
                <select class="form-select" id="roleFilter" name="role">
                    <option value="">-- All Roles --</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="operator" {{ request('role') === 'operator' ? 'selected' : '' }}>Operator</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="statusFilter" class="form-label">Filter by Status</label>
                <select class="form-select" id="statusFilter" name="status">
                    <option value="">-- All Status --</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary" style="padding: 8px 12px; font-size: 14px;"><i class="bi bi-funnel" style="font-size: 13px; margin-right: 6px;"></i>Filter</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 14px;"><i class="bi bi-arrow-clockwise" style="font-size: 13px; margin-right: 6px;"></i>Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Users Table Card -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="usersTable" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-3" style="width: 36px; height: 36px; font-size: 13px;">
                                        {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}
                                    </div>
                                    <div style="font-weight: 600; color: #1D3557;">
                                        {{ $user->first_name ? $user->first_name . ' ' . $user->last_name : $user->name }}
                                    </div>
                                </div>
                            </td>
                            <td><small>{{ $user->email }}</small></td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-moderator">Operator</span>
                                @endif
                            </td>
                            <td><span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td><small class="text-muted">{{ $user->creator ? $user->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $user->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary" style="padding: 6px 8px;"><i class="bi bi-pencil" style="font-size: 13px;"></i></a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" style="padding: 6px 8px;" onclick="return confirm('Delete this user');"><i class="bi bi-trash" style="font-size: 13px;"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-5"><i class="bi bi-inbox" style="font-size: 32px; color: #ccc;"></i><p class="mt-3">No users found</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = new DataTable('#usersTable', {
            pageLength: 10,
            ordering: true,
            searching: true,
            paging: true,
            info: true,
            lengthChange: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries per page",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: { first: "First", last: "Last", next: "Next", previous: "Previous" },
                emptyTable: "No users found"
            },
            columnDefs: [{ targets: 6, orderable: false, searchable: false }]
        });
    });
</script>
@endsection
