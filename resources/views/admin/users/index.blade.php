@extends('layouts.admin')

@section('title', 'User Management')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    :root {
        --primary: #1D3557;
        --light-gray: #f8f9fa;
        --border-color: #e9ecef;
    }

    /* Main layout & spacing */
    .dataTables_wrapper { padding: 0; }

    /* Per-page selector */
    .per-page-selector {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        margin-bottom: 8px;
    }

    .per-page-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--primary);
        margin: 0;
    }

    .per-page-select {
        padding: 4px 8px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 11px;
        color: #333;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .per-page-select:hover {
        border-color: var(--primary);
    }

    .per-page-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(29, 53, 87, 0.1);
    }

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
        padding: 6px 8px;
        vertical-align: middle;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }
    #usersTable tbody td {
        padding: 6px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        font-size: 11px;
        color: #333;
    }
    #usersTable tbody tr { transition: background-color 0.15s ease; }
    #usersTable tbody tr:hover { background-color: #f8f9fa !important; }

    .table-row-odd {
        background: white;
    }

    .table-row-even {
        background: var(--light-gray);
    }

    /* Badges - standardized */
    .badge-admin { background-color: #1D3557; color: white; padding: 0.375rem 0.75rem; border-radius: 12px; font-weight: 500; font-size: 0.8125rem; }
    .badge-moderator { background-color: #6EA8DA; color: white; padding: 0.375rem 0.75rem; border-radius: 12px; font-weight: 500; font-size: 0.8125rem; }
    .badge-success, .badge-danger, .bg-success, .bg-secondary { border-radius: 12px !important; padding: 0.375rem 0.75rem; font-weight: 500; font-size: 0.8125rem; }

    /* Pagination wrapper */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px;
        margin-top: 8px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
    }

    .pagination-info {
        font-size: 11px;
        color: #6c757d;
    }

    .pagination-info strong {
        color: var(--primary);
        font-weight: 600;
    }

    /* Pagination - improved spacing */
    .dataTables_paginate { margin-top: 1rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; }
    .dataTables_info { color: #6c757d; font-size: 0.875rem; }
    .pagination { margin: 0; gap: 0.15rem; display: inline-flex; }
    .page-link {
        color: var(--primary);
        border-color: var(--border-color);
        border-radius: 4px;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .page-link:hover { color: #fff; background-color: var(--primary); border-color: var(--primary); }
    .page-item.active .page-link { background-color: var(--primary); border-color: var(--primary); }
    .page-item.disabled .page-link { color: #6c757d; background-color: #fff; border-color: var(--border-color); cursor: not-allowed; }

    /* Action buttons group */
    .btn-group-sm { gap: 0.5rem; }
    .btn-group-sm .btn { padding: 0.375rem 0.5rem; font-size: 0.875rem; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-toolbar { flex-direction: column; }
        .filter-toolbar > * { width: 100%; }
        .filter-toolbar .btn-group { width: 100%; }
        .btn-toolbar-right { width: 100%; margin-top: 0.5rem; }

        .pagination { flex-wrap: wrap; }
        .page-link { padding: 0.5rem 0.375rem; font-size: 0.8125rem; }

        .pagination-wrapper {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
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

<!-- Per-Page Selector -->
@if($users->count() > 0)
<div class="per-page-selector">
    <label class="per-page-label">Records per page:</label>
    <select class="per-page-select" id="perPageSelect">
        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
    </select>
</div>
@endif

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
                        <th>Verified At</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="table-row-{{ $loop->odd ? 'odd' : 'even' }}">
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
                                @if($user->role === 'admin')
                                    @if($user->email_verified_at)
                                        <small class="text-muted">{{ $user->email_verified_at->format('d M Y H:i') }}</small>
                                    @else
                                        <small class="text-muted text-danger">Not verified</small>
                                    @endif
                                @endif
                            </td>
                            <td><small class="text-muted">{{ $user->creator ? $user->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $user->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary" title="Edit user" aria-label="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger delete-user" data-user-id="{{ $user->id }}" data-user-name="{{ $user->first_name ?? $user->name }}" title="Delete user" aria-label="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
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

    <!-- Pagination -->
    @if($users->count() > 0)
    <div class="pagination-wrapper">
        <div style="flex: 1; text-align: center;">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        <div style="flex: 1; text-align: right;">
            <span class="pagination-info">
                Total: <strong>{{ $users->total() }}</strong> records
            </span>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Per-page selector
        const perPageSelect = document.getElementById('perPageSelect');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', (e) => {
                const form = document.getElementById('filterForm');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'per_page';
                input.value = e.target.value;

                const existing = form.querySelector('input[name="per_page"]');
                if (existing) {
                    existing.remove();
                }

                form.appendChild(input);
                form.submit();
            });
        }

        // SweetAlert for delete user
        document.querySelectorAll('.delete-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                Swal.fire({
                    title: 'Delete User?',
                    text: `Are you sure you want to delete ${userName}? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-user-${userId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
