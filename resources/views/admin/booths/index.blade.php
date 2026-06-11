@extends('layouts.admin')

@section('title', 'Curing Booth Management')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
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
    #boothsTable thead th {
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
    #boothsTable tbody td {
        padding: 6px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        font-size: 11px;
        color: #333;
    }
    #boothsTable tbody tr { transition: background-color 0.15s ease; }
    #boothsTable tbody tr:hover { background-color: #f8f9fa !important; }

    .table-row-odd {
        background: white;
    }

    .table-row-even {
        background: var(--light-gray);
    }

    /* Badges - standardized */
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

    /* Select2 styling */
    .select2-container--bootstrap-5 .select2-selection--single {
        height: 38px;
        font-size: 0.875rem;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        padding-top: 0.375rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-toolbar { flex-direction: column; }
        .filter-toolbar > * { width: 100%; }
        .filter-toolbar .btn-group { width: 100%; }

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
    <h1 class="page-title mb-0">Curing Booths</h1>
    <a href="{{ route('booths.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus" style="margin-right: 6px;"></i>Add Booth
    </a>
</div>

<!-- Filter Toolbar -->
<div class="mb-3" style="width: fit-content;">
    <form method="GET" action="{{ route('booths.index') }}" id="filterForm">
        <select class="form-select form-select-sm" id="searchBooths" name="search" style="width: 100%; max-width: 500px;">
            <option value="">Select Booth Name</option>
            @foreach($boothNames as $name)
                <option value="{{ $name }}" {{ request('search') === $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<!-- Per-Page Selector -->
@if($booths->count() > 0)
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

<!-- Booths Table Card -->
<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="boothsTable" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Booth Name</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($booths as $booth)
                        <tr class="table-row-{{ $loop->odd ? 'odd' : 'even' }}">
                            <td style="font-weight: 600; color: #1D3557;">{{ $booth->curing_booth }}</td>
                            <td><small class="text-muted">{{ $booth->creator ? $booth->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $booth->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                @if($booth->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('booths.edit', $booth) }}" class="btn btn-outline-primary" title="Edit booth" aria-label="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger delete-booth" data-booth-id="{{ $booth->id }}" data-booth-name="{{ $booth->curing_booth }}" title="Delete booth" aria-label="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-booth-{{ $booth->id }}" action="{{ route('booths.destroy', $booth) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size: 32px; color: #ccc; display: block; margin-bottom: 0.5rem;"></i>
                                No booths found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($booths->count() > 0)
    <div class="pagination-wrapper">
        <div style="flex: 1; text-align: center;">
            {{ $booths->links('pagination::bootstrap-5') }}
        </div>
        <div style="flex: 1; text-align: right;">
            <span class="pagination-info">
                Total: <strong>{{ $booths->total() }}</strong> records
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for searchable dropdown
        $('#searchBooths').select2({
            theme: 'bootstrap-5',
            placeholder: 'Search or select booth name...',
            allowClear: true,
            width: '100%'
        });

        // Submit form when booth is selected
        $('#searchBooths').on('change', function() {
            document.getElementById('filterForm').submit();
        });

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

        // SweetAlert for delete booth
        document.querySelectorAll('.delete-booth').forEach(button => {
            button.addEventListener('click', function() {
                const boothId = this.getAttribute('data-booth-id');
                const boothName = this.getAttribute('data-booth-name');

                Swal.fire({
                    title: 'Delete Booth?',
                    text: `Are you sure you want to delete booth "${boothName}"? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-booth-${boothId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection
