@extends('layouts.admin')

@section('title', 'Plate Type Management')

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
    #platesTable thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #e3e6f0;
        color: #1D3557;
        font-weight: 600;
        padding: 0.75rem !important;
        vertical-align: middle;
    }
    #platesTable tbody td {
        padding: 0.75rem !important;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }
    #platesTable tbody tr { transition: background-color 0.15s ease; }
    #platesTable tbody tr:hover { background-color: #f8f9fa !important; }

    /* Badges - standardized */
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

    /* Spec value styling */
    .spec-value { font-family: 'Courier New', monospace; color: #495057; font-weight: 500; font-size: 0.875rem; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-toolbar { flex-direction: column; }
        .filter-toolbar > * { width: 100%; }
        .filter-toolbar .btn-group { width: 100%; }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Plate Specifications</h1>
    <a href="{{ route('plates.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus" style="margin-right: 6px;"></i>Add Plate
    </a>
</div>

<!-- Filter Toolbar -->
<div class="d-flex filter-toolbar align-items-center flex-wrap mb-3">
    <form method="GET" action="{{ route('plates.index') }}" class="d-flex filter-toolbar align-items-center flex-wrap" id="filterForm" style="gap: 0.5rem; width: 100%;">
        <!-- Search Input -->
        <input type="text" class="form-control form-control-sm" id="searchPlates" name="search" placeholder="Search plate code..." style="min-width: 200px; flex: 1; max-width: 300px;" value="{{ request('search') }}">

        <!-- Status Filter -->
        <select class="form-select form-select-sm" id="statusFilter" name="status" style="width: 140px;">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <!-- Filter Buttons Group -->
        <div class="btn-group btn-group-sm" role="group">
            <button type="submit" class="btn btn-primary btn-sm" title="Apply filters">
                <i class="bi bi-funnel" style="margin-right: 4px;"></i>Filter
            </button>
            <a href="{{ route('plates.index') }}" class="btn btn-outline-secondary btn-sm" title="Clear all filters">
                <i class="bi bi-arrow-clockwise" style="margin-right: 4px;"></i>Reset
            </a>
        </div>

        <!-- Spacer to push button group to end -->
        <div style="flex-grow: 1;"></div>
    </form>
</div>

<!-- Plates Table Card -->
<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="platesTable" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Plate Code</th>
                        <th>Weight (USL/Target/LSL)</th>
                        <th>Thickness (USL/Target/LSL)</th>
                        <th>MC LSL %</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plates as $plate)
                        <tr>
                            <td style="font-weight: 600; color: #1D3557;">{{ $plate->plate_code }}</td>
                            <td>
                                <div class="spec-value">
                                    @if($plate->weight_usl || $plate->weight_target || $plate->weight_lsl)
                                        {{ $plate->weight_usl ?? '-' }} / {{ $plate->weight_target ?? '-' }} / {{ $plate->weight_lsl ?? '-' }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="spec-value">
                                    @if($plate->thick_usl || $plate->thick_target || $plate->thick_lsl)
                                        {{ $plate->thick_usl ?? '-' }} / {{ $plate->thick_target ?? '-' }} / {{ $plate->thick_lsl ?? '-' }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </td>
                            <td><span class="spec-value">{{ $plate->mc_lsl ?? '-' }}</span></td>
                            <td>
                                <span class="badge {{ $plate->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $plate->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td><small class="text-muted">{{ $plate->creator ? $plate->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $plate->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('plates.edit', $plate) }}" class="btn btn-outline-primary" title="Edit plate" aria-label="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('plates.destroy', $plate) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete plate" aria-label="Delete" onclick="return confirm('Delete this plate?');">
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
                                No plates found
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
        const table = new DataTable('#platesTable', {
            pageLength: 10,
            ordering: false,
            searching: false,
            paging: true,
            info: true,
            lengthChange: true,
            language: {
                lengthMenu: "Show _MENU_",
                info: "Showing _START_ to _END_ of _TOTAL_ plates",
                paginate: { first: "First", last: "Last", next: "Next", previous: "Previous" },
                emptyTable: "No plates found"
            }
        });
    });
</script>
@endsection
