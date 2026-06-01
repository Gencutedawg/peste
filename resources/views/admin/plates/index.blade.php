@extends('layouts.admin')

@section('title', 'Plate Type Management')

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
    #platesTable thead th { background: #f8f9fa; border-bottom: 2px solid #e3e6f0; color: #1D3557; font-weight: 600; padding: 16px !important; white-space: nowrap; cursor: pointer; user-select: none; }
    #platesTable thead th.sorting::after { margin-left: 8px; opacity: 0.8; }
    #platesTable tbody td { padding: 14px 16px !important; vertical-align: middle; border-bottom: 1px solid #f0f0f0; }
    #platesTable tbody tr { transition: background-color 0.2s ease; }
    #platesTable tbody tr:hover { background-color: #f8f9fa !important; }
    .dataTables_paginate { margin-top: 20px; }
    .dataTables_info { margin-top: 20px; color: #6c757d; font-size: 14px; }
    .page-link { color: #2C6CB0; border-color: #dee2e6; border-radius: 6px; margin: 0 2px; }
    .page-link:hover { color: #fff; background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.active .page-link { background-color: #2C6CB0; border-color: #2C6CB0; }
    .page-item.disabled .page-link { color: #6c757d; background-color: #fff; border-color: #dee2e6; }
    .spec-value { font-family: 'Courier New', monospace; color: #495057; font-weight: 500; }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Plate Type Management</h1>
    <a href="{{ route('plates.create') }}" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">
        <i class="bi bi-plus" style="font-size: 14px; margin-right: 6px;"></i>Add New Plate
    </a>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('plates.index') }}" class="row g-3" id="filterForm">
            <div class="col-md-8">
                <label for="searchFilter" class="form-label">Search by Plate Code</label>
                <input type="text" class="form-control" id="searchFilter" name="search" 
                       placeholder="Search plate specifications..." 
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <label for="statusFilter" class="form-label">Filter by Status</label>
                <select class="form-select" id="statusFilter" name="status">
                    <option value="">-- All Status --</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-md-12 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary" style="padding: 8px 12px; font-size: 14px;"><i class="bi bi-funnel" style="font-size: 13px; margin-right: 6px;"></i>Filter</button>
                <a href="{{ route('plates.index') }}" class="btn btn-secondary" style="padding: 8px 12px; font-size: 14px;"><i class="bi bi-arrow-clockwise" style="font-size: 13px; margin-right: 6px;"></i>Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Plates Table Card -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="platesTable" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Plate Code</th>
                        <th>Weight (USL/Target/LSL)</th>
                        <th>Thickness (USL/Target/LSL)</th>
                        <th>MC LSL</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plates as $plate)
                        <tr>
                            <td><strong style="color: #1D3557;">{{ $plate->plate_code }}</strong></td>
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
                            <td><span class="badge {{ $plate->is_active ? 'bg-success' : 'bg-danger' }}">{{ $plate->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td><small class="text-muted">{{ $plate->creator ? $plate->creator->name : 'System' }}</small></td>
                            <td><small class="text-muted">{{ $plate->updated_at->format('d M Y H:i') }}</small></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('plates.edit', $plate) }}" class="btn btn-outline-primary" style="padding: 6px 8px;"><i class="bi bi-pencil" style="font-size: 13px;"></i></a>
                                    <form action="{{ route('plates.destroy', $plate) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" style="padding: 6px 8px;" onclick="return confirm('Delete this plate');"><i class="bi bi-trash" style="font-size: 13px;"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-5"><i class="bi bi-inbox" style="font-size: 32px; color: #ccc;"></i><p class="mt-3">No plates found</p></td></tr>
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
                emptyTable: "No plates found"
            },
            columnDefs: [{ targets: 7, orderable: false, searchable: false }]
        });
    });
</script>
@endsection
