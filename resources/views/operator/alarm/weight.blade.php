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

    /* Filter Card Container */
    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
    }

    .filter-card-header {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--light-gray);
    }

    .filter-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Responsive Grid Layout */
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .filter-date-range {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        grid-column: span 2;
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
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        background: white;
        color: #333;
        transition: all 0.2s ease;
        height: 40px;
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
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 40px;
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
        margin-bottom: 20px;
        padding: 12px 16px;
        background: var(--light-gray);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        font-size: 13px;
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
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table-header-sticky {
        position: sticky;
        top: 0;
        z-index: 10;
        background: var(--light-gray);
        border-bottom: 2px solid var(--border-color);
    }

    .data-table th {
        padding: 12px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: var(--light-gray);
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
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
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
        text-align: center;
        padding: 60px 40px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .empty-state i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 16px;
        display: block;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 8px 0;
    }

    .empty-state p {
        color: #6c757d;
        margin: 0 0 20px 0;
    }

    /* Pagination */
    .pagination {
        margin: 0;
        gap: 0.25rem;
        display: inline-flex;
    }

    .page-link {
        color: var(--primary);
        border-color: var(--border-color);
        border-radius: 6px;
        padding: 0.375rem 0.625rem;
        font-size: 0.875rem;
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
        justify-content: center;
        padding: 16px 0;
        margin-top: 20px;
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
<!-- Filter Card -->
<div class="filter-card">
    <div class="filter-card-header">
        <h3 class="filter-title">
            <i class="bi bi-funnel-fill"></i> Filter Failed Tests
        </h3>
    </div>

    <form method="GET" action="{{ route('alarm.weight') }}" class="filter-form" id="filterForm">
        <div class="filter-grid">
            <!-- Date Range -->
            <div class="filter-date-range">
                <div class="filter-group">
                    <label>From Date</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}">
                </div>
                <div class="filter-group">
                    <label>To Date</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}">
                </div>
            </div>

            <!-- Operator -->
            <div class="filter-group">
                <label>Operator</label>
                <select name="operator" class="filter-select">
                    <option value="">All Operators</option>
                    @foreach($operators as $op)
                        <option value="{{ $op }}" {{ request('operator') === $op ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Line -->
            <div class="filter-group">
                <label>Line</label>
                <select name="line" class="filter-select">
                    <option value="">All Lines</option>
                    @foreach($lines as $line)
                        <option value="{{ $line }}" {{ request('line') === $line ? 'selected' : '' }}>
                            {{ $line }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Shift -->
            <div class="filter-group">
                <label>Shift</label>
                <select name="shift" class="filter-select">
                    <option value="">All Shifts</option>
                    @foreach($shifts as $shift)
                        <option value="{{ $shift }}" {{ request('shift') === $shift ? 'selected' : '' }}>
                            {{ $shift }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Plate Code -->
            <div class="filter-group">
                <label>Plate Code</label>
                <select name="plate_code" class="filter-select">
                    <option value="">All Plate Codes</option>
                    @foreach($plateCodes as $code)
                        <option value="{{ $code }}" {{ request('plate_code') === $code ? 'selected' : '' }}>
                            {{ $code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="filter-actions">
            <button type="submit" class="btn-apply" id="applyBtn">
                <i class="bi bi-funnel"></i> Apply Filters
            </button>
            <a href="{{ route('alarm.weight') }}" class="btn-reset">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
            @if($failedTests->count() > 0 && request()->anyFilled(['from_date', 'to_date', 'operator', 'line', 'shift', 'plate_code']))
                <a href="#" class="btn-clear" id="clearAllBtn">Clear All</a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filters Display -->
@if($failedTests->count() > 0 && count($activeFilters) > 0)
<div class="active-filters-section">
    <div class="active-filters">
        @if(request('from_date') || request('to_date'))
            <div class="filter-chip">
                <span class="chip-label">
                    Date:
                    @if(request('from_date') && request('to_date'))
                        {{ \Carbon\Carbon::parse(request('from_date'))->format('M d') }} - {{ \Carbon\Carbon::parse(request('to_date'))->format('M d') }}
                    @elseif(request('from_date'))
                        From {{ \Carbon\Carbon::parse(request('from_date'))->format('M d') }}
                    @else
                        Until {{ \Carbon\Carbon::parse(request('to_date'))->format('M d') }}
                    @endif
                </span>
                <button type="button" class="chip-remove" data-filter="date">×</button>
            </div>
        @endif

        @if(request('operator'))
            <div class="filter-chip">
                <span class="chip-label">Operator: {{ request('operator') }}</span>
                <button type="button" class="chip-remove" data-filter="operator">×</button>
            </div>
        @endif

        @if(request('line'))
            <div class="filter-chip">
                <span class="chip-label">Line: {{ request('line') }}</span>
                <button type="button" class="chip-remove" data-filter="line">×</button>
            </div>
        @endif

        @if(request('shift'))
            <div class="filter-chip">
                <span class="chip-label">Shift: {{ request('shift') }}</span>
                <button type="button" class="chip-remove" data-filter="shift">×</button>
            </div>
        @endif

        @if(request('plate_code'))
            <div class="filter-chip">
                <span class="chip-label">Plate Code: {{ request('plate_code') }}</span>
                <button type="button" class="chip-remove" data-filter="plate_code">×</button>
            </div>
        @endif
    </div>
    <button type="button" class="btn-clear-all">Clear All Filters</button>
</div>
@endif

<!-- Result Summary -->
@if($failedTests->count() > 0)
<div class="result-summary">
    <div class="result-info">
        <span class="result-count">
            Showing <strong>{{ $failedTests->count() }}</strong> of
            <strong>{{ $totalFailed }}</strong> records
        </span>
    </div>
    @if(count($filterSummary) > 0)
        <div class="result-filters">
            Filtered by: <strong>{{ implode(' • ', $filterSummary) }}</strong>
        </div>
    @endif
</div>
@endif

<!-- Table or Empty State -->
@if($failedTests->count() > 0)
    <div class="table-container">
        <table class="data-table">
            <thead class="table-header-sticky">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Operator</th>
                    <th>Line</th>
                    <th>Shift</th>
                    <th>Plate Code</th>
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
                        <td>{{ $test->weight_date_log->format('M d, Y') }}</td>
                        <td>{{ $test->weight_time_log }}</td>
                        <td><strong>{{ $test->operator_name }}</strong></td>
                        <td>{{ $test->production_line_name }}</td>
                        <td>{{ $test->shift_name }}</td>
                        <td>{{ $test->plate_code }}</td>
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
        {{ $failedTests->links('pagination::bootstrap-5') }}
    </div>
@else
    <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <h3>No Records Found</h3>
        <p>No failed weight measurements match your filters.</p>
        @if(request()->anyFilled(['from_date', 'to_date', 'operator', 'line', 'shift', 'plate_code']))
            <a href="{{ route('alarm.weight') }}" class="btn-clear" style="display: inline-block; padding: 10px 16px; background: var(--primary); color: white; border-radius: 8px; text-decoration: none;">
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
});
</script>
@endsection
