@extends('layouts.operator')

@section('title', 'Weight Alarm')

@section('styles')
<style>
    :root {
        --primary: #1D3557;
        --danger: #dc3545;
        --light-gray: #f8f9fa;
        --border-color: #e9ecef;
        --shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    body, main {
        background: #f5f6f8;
    }

    /* Compact Toolbar */
    .filter-toolbar {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .filter-item label {
        font-size: 11px;
        font-weight: 600;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-item input,
    .filter-item select {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 12px;
        background: white;
        color: var(--primary);
        height: 36px;
        font-family: inherit;
    }

    .filter-item select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%231D3557' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        padding-right: 28px;
        cursor: pointer;
        color: var(--primary);
    }

    .filter-item select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(29, 53, 87, 0.1);
    }

    .filter-item select option {
        padding: 8px 10px;
        line-height: 1.6;
        color: #333;
    }

    .filter-item select option[value=""] {
        color: #666;
        font-weight: 500;
    }

    .filter-item.date-range {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .date-range-inputs {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .date-range-inputs input {
        flex: 1;
        min-width: 120px;
    }

    .date-separator {
        color: #ccc;
        font-weight: 600;
    }

    .filter-actions-compact {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }

    .btn-apply-compact {
        padding: 8px 16px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        height: 36px;
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-apply-compact:hover {
        background: #0f1f2e;
    }

    .btn-reset-compact {
        padding: 8px 12px;
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        height: 36px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .btn-reset-compact:hover {
        background: var(--light-gray);
    }

    .filter-select {
        color: var(--primary) !important;
    }

    .filter-select option {
        color: #333;
    }

    .filter-select option[value=""] {
        color: #666;
    }

    /* Old Filter Card (hide) */
    .filter-card {
        display: none;
    }

    /* Filter Groups */
    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
        font-family: inherit;
        background: white;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .filter-group input {
        height: 40px;
    }

    .filter-group select {
        height: 40px;
        line-height: 1.4;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%231D3557' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
    }

    .filter-group select option {
        padding: 8px 10px;
        line-height: 1.6;
        color: #333;
    }

    .filter-group select option[value=""] {
        color: #666;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(29, 53, 87, 0.1);
    }

    /* Action Buttons */
    .filter-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        align-items: center;
    }

    .btn-apply,
    .btn-reset,
    .btn-clear {
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        height: 32px;
    }

    .btn-apply {
        background: var(--primary);
        color: white;
    }

    .btn-apply:hover:not(:disabled) {
        background: #0f1f2e;
    }

    .btn-apply:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .btn-reset {
        background: white;
        color: var(--primary);
        border: 1px solid var(--border-color);
    }

    .btn-reset:hover {
        background: var(--light-gray);
        border-color: var(--primary);
    }

    .btn-clear {
        background: transparent;
        color: #6c757d;
        border: none;
        font-size: 12px;
        text-decoration: underline;
        padding: 0;
        height: auto;
    }

    .btn-clear:hover {
        color: var(--primary);
    }

    /* Active Filters Section */
    .active-filters-section {
        margin-bottom: 12px;
        padding: 8px 10px;
        background: var(--light-gray);
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 8px;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 8px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        font-size: 11px;
    }

    .chip-label {
        color: #333;
        font-weight: 500;
    }

    .chip-remove {
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 16px;
        padding: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
    }

    .chip-remove:hover {
        color: var(--danger);
    }

    .btn-clear-all {
        padding: 6px 12px;
        background: transparent;
        border: 1px solid var(--danger);
        color: var(--danger);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-clear-all:hover {
        background: var(--danger);
        color: white;
    }

    /* Result Summary */
    .result-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-bottom: 16px;
        font-size: 13px;
    }

    .result-info {
        color: #6c757d;
    }

    .result-count strong {
        color: var(--primary);
        font-weight: 700;
    }

    .result-filters {
        color: #6c757d;
    }

    .result-filters strong {
        color: var(--primary);
    }

    /* Table Container */
    .table-container {
        background: white;
        overflow-x: hidden;
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        font-size: 11px;
    }

    .table-header-sticky {
        position: sticky;
        top: 0;
        z-index: 10;
        background: var(--light-gray);
        border-bottom: 1px solid var(--border-color);
    }

    .data-table th {
        padding: 6px 8px;
        text-align: left;
        font-size: 10px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        background: var(--light-gray);
        white-space: nowrap;
    }

    .table-row-odd {
        background: white;
    }

    .table-row-even {
        background: var(--light-gray);
    }

    .data-table tbody tr:hover {
        background-color: #f0f0f0 !important;
    }

    .data-table td {
        padding: 6px 8px;
        border-bottom: 1px solid var(--border-color);
        font-size: 11px;
        color: #333;
    }

    .status-fail {
        background: rgba(220, 53, 69, 0.1);
        color: var(--danger);
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .remark-text {
        color: #6c757d;
        font-size: 13px;
    }

    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 24px 20px;
        min-height: 200px;
        background: white;
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .empty-state i {
        font-size: 28px;
        color: #d0d0d0;
        margin-bottom: 8px;
        display: block;
    }

    .empty-state h3 {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 4px 0;
    }

    .empty-state p {
        color: #6c757d;
        margin: 0 0 12px 0;
        font-size: 12px;
        line-height: 1.4;
    }

    .empty-state-link {
        color: var(--primary);
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        padding: 6px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .empty-state-link:hover {
        background: var(--light-gray);
        border-color: var(--primary);
    }

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

    /* Pagination */
    .pagination {
        margin: 0;
        gap: 0.15rem;
        display: inline-flex;
    }

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

    .page-link:hover {
        color: #fff;
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: var(--border-color);
        cursor: not-allowed;
    }

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

    .pagination-wrapper-sticky {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 10px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        margin-bottom: 8px;
    }

    .pagination-info {
        font-size: 11px;
        color: #6c757d;
    }

    .pagination-info strong {
        color: var(--primary);
        font-weight: 600;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1200px) {
        .filter-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .filter-date-range {
            grid-column: span 3;
        }
    }

    @media (max-width: 768px) {
        .filter-card {
            padding: 16px;
        }

        .filter-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .filter-date-range {
            grid-template-columns: 1fr;
            grid-column: span 1;
        }

        .filter-actions {
            flex-direction: column;
            justify-content: stretch;
        }

        .btn-apply,
        .btn-reset,
        .btn-clear {
            width: 100%;
            justify-content: center;
        }

        .result-summary {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }

        .table-container {
            max-width: 100%;
        }

        .data-table th,
        .data-table td {
            padding: 10px 8px;
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')
<!-- Compact Filter Toolbar -->
<div class="filter-toolbar">
    <form method="GET" action="{{ route('alarm.weight') }}" class="filter-form" id="filterForm" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end; width: 100%;">
        <!-- Date Range -->
        <div class="filter-item date-range">
            <label>Date Range</label>
            <div class="date-range-inputs">
                <input type="date" name="from_date" value="{{ request('from_date') }}" title="From Date">
                <span class="date-separator">—</span>
                <input type="date" name="to_date" value="{{ request('to_date') }}" title="To Date">
            </div>
        </div>

        <!-- Operator -->
        <div class="filter-item">
            <label>Operator</label>
            <select name="operator" class="filter-select">
                <option value="">Select Operator</option>
                @foreach($operators as $op)
                    <option value="{{ $op }}" {{ request('operator') === $op ? 'selected' : '' }}>
                        {{ $op }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Line -->
        <div class="filter-item">
            <label>Line</label>
            <select name="line" class="filter-select">
                <option value="">Select Line</option>
                @foreach($lines as $line)
                    <option value="{{ $line }}" {{ request('line') === $line ? 'selected' : '' }}>
                        {{ $line }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Shift -->
        <div class="filter-item">
            <label>Shift</label>
            <select name="shift" class="filter-select">
                <option value="">Select Shift</option>
                @foreach($shifts as $shift)
                    <option value="{{ $shift }}" {{ request('shift') === $shift ? 'selected' : '' }}>
                        {{ $shift }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Plate Code -->
        <div class="filter-item">
            <label>Plate Code</label>
            <select name="plate_code" class="filter-select">
                <option value="">Select Plate Code</option>
                @foreach($plateCodes as $code)
                    <option value="{{ $code }}" {{ request('plate_code') === $code ? 'selected' : '' }}>
                        {{ $code }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="filter-actions-compact" style="margin-left: auto;">
            <button type="submit" class="btn-apply-compact" id="applyBtn">
                <i class="bi bi-funnel"></i> Apply
            </button>
            <a href="{{ route('alarm.weight') }}" class="btn-reset-compact">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Result Summary and Per-Page Selector -->
@if($failedTests->count() > 0)
<!-- Per-Page Selector -->
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

<!-- Table or Empty State -->
@if($failedTests->count() > 0)
    <div class="table-container">
        <table class="data-table">
            <thead class="table-header-sticky">
                <tr>
                    <th>Date and Time</th>
                    <th>Operator</th>
                    <th>Line</th>
                    <th>Shift</th>
                    <th>Plate Code</th>
                    <th>LSL</th>
                    <th>Target</th>
                    <th>USL</th>
                    <th>Op W1</th>
                    <th>Op W2</th>
                    <th>Op W3</th>
                    <th>Op W4</th>
                    <th>NOP W1</th>
                    <th>NOP W2</th>
                    <th>NOP W3</th>
                    <th>NOP W4</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach($failedTests as $test)
                    <tr class="table-row-{{ $loop->odd ? 'odd' : 'even' }}">
                        <td>{{ $test->weight_date_log->format('M d, Y') }} {{ $test->weight_time_log }}</td>
                        <td><strong>{{ $test->operator_name }}</strong></td>
                        <td>{{ $test->production_line_name }}</td>
                        <td>{{ $test->shift_name }}</td>
                        <td>{{ $test->plate_code }}</td>
                        <td>{{ $test->plateSpecification?->weight_lsl ?? '—' }}</td>
                        <td>{{ $test->plateSpecification?->weight_target ?? '—' }}</td>
                        <td>{{ $test->plateSpecification?->weight_usl ?? '—' }}</td>
                        <td>{{ $test->op_w1 ?? '—' }}</td>
                        <td>{{ $test->op_w2 ?? '—' }}</td>
                        <td>{{ $test->op_w3 ?? '—' }}</td>
                        <td>{{ $test->op_w4 ?? '—' }}</td>
                        <td>{{ $test->nop_w1 ?? '—' }}</td>
                        <td>{{ $test->nop_w2 ?? '—' }}</td>
                        <td>{{ $test->nop_w3 ?? '—' }}</td>
                        <td>{{ $test->nop_w4 ?? '—' }}</td>
                        <td>
                            @if($test->remark_name)
                                <span class="remark-text">{{ $test->remark_name }}</span>
                            @else
                                <span style="color: #ccc;">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <div style="flex: 1; text-align: center;">
            {{ $failedTests->links('pagination::bootstrap-5') }}
        </div>
        <div style="flex: 1; text-align: right;">
            <span class="pagination-info">
                Total: <strong>{{ $failedTests->total() }}</strong> records
            </span>
        </div>
    </div>
@else
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h3>No Records Found</h3>
        <p>No failed weight measurements match your selected filters.</p>
        @if(request()->anyFilled(['from_date', 'to_date', 'operator', 'line', 'shift', 'plate_code']))
            <a href="{{ route('alarm.weight') }}" class="empty-state-link">
                <i class="bi bi-arrow-counterclockwise"></i> Clear Filters
            </a>
        @endif
    </div>
@endif
@endsection

@section('scripts')
<script>
class FilterManager {
    constructor() {
        this.initEventListeners();
    }

    initEventListeners() {
        // Enter key submits form
        document.querySelectorAll('.filter-input, .filter-select').forEach(el => {
            el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.applyFilters();
                }
            });
        });

        // Apply button
        document.getElementById('applyBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            this.applyFilters();
        });

        // Clear all button
        document.getElementById('clearAllBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = '{{ route("alarm.weight") }}';
        });

        // Remove individual filter chips
        document.querySelectorAll('.chip-remove').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const filterName = btn.dataset.filter;
                this.removeFilter(filterName);
            });
        });

        // Clear all filters button
        document.querySelector('.btn-clear-all')?.addEventListener('click', (e) => {
            e.preventDefault();
            window.location.href = '{{ route("alarm.weight") }}';
        });
    }

    applyFilters() {
        const applyBtn = document.getElementById('applyBtn');
        applyBtn.disabled = true;
        applyBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Applying...';

        document.getElementById('filterForm').submit();
    }

    removeFilter(filterName) {
        const form = document.getElementById('filterForm');
        const fields = form.querySelectorAll(`[name="${filterName}"]`);
        fields.forEach(field => field.value = '');
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new FilterManager();

    // Per-page selector
    const perPageSelect = document.getElementById('perPageSelect');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', (e) => {
            const form = document.getElementById('filterForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'per_page';
            input.value = e.target.value;
            
            // Remove existing per_page input if present
            const existing = form.querySelector('input[name="per_page"]');
            if (existing) {
                existing.remove();
            }
            
            form.appendChild(input);
            form.submit();
        });
    }
});
</script>
@endsection
