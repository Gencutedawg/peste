@extends('layouts.admin')

@section('title', 'User Management')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    /* Main layout & spacing */
    .dataTables_wrapper { padding: 0; }

    /* Toolbar controls - compact styling */
    .filter-toolbar { margin-bottom: 1rem; gap: 0.5rem; }
    .filter-toolbar .form-select-sm,
    .filter-toolbar .form-control-sm { height: 38px; font-size: 0.875rem; }
    .filter-toolbar .btn-sm { height: 38px; padding: 0.375rem 0.75rem; font-size: 0.875rem; }

    /* Table controls */
    .dataTables_length,
    .dataTables_filter { margin: 0; display: inline-flex; align-items: center; gap: 0.5rem; }
    .dataTables_length select,
    .dataTables_filter input { height: 38px; font-size: 0.875rem; }

    /* Table header & body */
    #usersTable thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #e3e6f0;
        color: #1D3557;
        font-weight: 600;
        padding: 0.75rem !important;
        vertical-align: middle;
    }
    #usersTable tbody td {
        padding: 0.75rem !important;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }
    #usersTable tbody tr { transition: background-color 0.15s ease; }
    #usersTable tbody tr:hover { background-color: #f8f9fa !important; }

    /* Badges - standardized */
    .badge-admin { background-color: #1D3557; color: white; padding: 0.375rem 0.75rem; border-radius: 12px; font-weight: 500; font-size: 0.8125rem; }
    .badge-moderator { background-color: #6EA8DA; color: white; padding: 0.375rem 0.75rem; border-radius: 12px; font-weight: 500; font-size: 0.8125rem; }
    .badge-success, .badge-danger, .bg-success, .bg-secondary { border-radius: 12px !important; padding: 0.375rem 0.75rem; font-weight: 500; font-size: 0.8125rem; }

    /* Pagination - improved spacing */
    .dataTables_paginate { margin-top: 1rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; }
    .dataTables_info { color: #6c757d; font-size: 0.875rem; }
    .pagination { margin: 0; gap: 0.25rem; }
    .page-link {
        color: #2C6CB0;
        border-color: #dee2e6;
        border-radius: 6px;
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
    }
    .page-link:hover { color: #fff; background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.active .page-link { background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.disabled .page-link { color: #6c757d; background-color: #fff; border-color: #dee2e6; }

    /* Action buttons group */
    .btn-group-sm { gap: 0.5rem; }
    .btn-group-sm .btn { padding: 0.375rem 0.5rem; font-size: 0.875rem; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-toolbar { flex-direction: column; }
        .filter-toolbar > * { width: 100%; }
        .filter-toolbar .btn-group { width: 100%; }
        .btn-toolbar-right { width: 100%; margin-top: 0.5rem; }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">User Management</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus" style="margin-right: 6px;"></i>Add User
    </a>
</div>

<!-- Filter Toolbar -->
<div class="d-flex filter-toolbar align-items-center flex-wrap mb-3">
    <form method="GET" action="{{ route('users.index') }}" class="d-flex filter-toolbar align-items-center flex-wrap" id="filterForm" style="gap: 0.5rem; width: 100%;">
        <!-- Role Filter -->
        <select class="form-select form-select-sm" id="roleFilter" name="role" style="width: 140px;">
            <option value="">All Roles</option>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="operator" {{ request('role') === 'operator' ? 'selected' : '' }}>Operator</option>
        </select>

        <!-- Status Filter -->
        <select class="form-select form-select-sm" id="statusFilter" name="status" style="width: 140px;">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <!-- Search Input -->
        <input type="text" class="form-control form-control-sm" id="searchUsers" name="search" placeholder="Search users..." style="min-width: 200px; flex: 1; max-width: 300px;" value="{{ request('search') }}">

        <!-- Filter Buttons Group -->
        <div class="btn-group btn-group-sm" role="group">
            <button type="submit" class="btn btn-primary btn-sm" title="Apply filters">
                <i class="bi bi-funnel" style="margin-right: 4px;"></i>Filter
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm" title="Clear all filters">
                <i class="bi bi-arrow-clockwise" style="margin-right: 4px;"></i>Reset
            </a>
        </div>

        <!-- Spacer to push button group to end -->
        <div style="flex-grow: 1;"></div>
    </form>
</div>

<!-- Users Table Card -->
<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="usersTable" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
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
                            <td style="font-weight: 600; color: #1D3557;">
                                {{ $user->first_name ? $user->first_name . ' ' . $user->last_name : $user->name }}
                            </td>
                            <td><small class="text-muted">{{ $user->username }}</small></td>
                            <td><small class="text-muted">{{ $user->email }}</small></td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge badge-admin">Admin</span>
                                @else
                                    <span class="badge badge-moderator">Operator</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td><small class="text-muted">{{ $user->creator ? $user->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $user->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary" title="Edit user" aria-label="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete user" aria-label="Delete" onclick="return confirm('Delete this user?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size: 32px; color: #ccc; display: block; margin-bottom: 0.5rem;"></i>
                                No users found
                            </td>
                        </tr>
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
            ordering: false,
            searching: false,
            paging: true,
            info: true,
            lengthChange: true,
            language: {
                lengthMenu: "Show _MENU_",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                paginate: { first: "First", last: "Last", next: "Next", previous: "Previous" },
                emptyTable: "No users found"
            }
        });
    });
</script>
@endsection
