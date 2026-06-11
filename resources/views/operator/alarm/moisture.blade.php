@extends('layouts.operator')

@section('title', 'Moisture Content Alarm')

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

    .result-count strong {
        color: var(--primary);
        font-weight: 700;
    }

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
        position: sticky;
        top: 0;
        z-index: 10;
        border-bottom: 1px solid var(--border-color);
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
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .remark-text {
        color: #6c757d;
        font-size: 13px;
    }

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
        margin: 0;
        font-size: 12px;
        line-height: 1.4;
    }

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

    .pagination-info {
        font-size: 11px;
        color: #6c757d;
    }

    .pagination-info strong {
        color: var(--primary);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .filter-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-item, .filter-actions-compact {
            width: 100%;
        }

        .btn-apply-compact, .btn-reset-compact {
            width: 100%;
        }

        .data-table th, .data-table td {
            padding: 8px 6px;
        }
    }
</style>
@endsection

@section('content')
<div class="filter-toolbar">
    <form method="GET" action="{{ route('alarm.moisture') }}" class="w-100">
        <div style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
            <div class="filter-item">
                <label for="from_date">From Date</label>
                <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>

            <div class="filter-item">
                <label for="to_date">To Date</label>
                <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">
            </div>

            <div class="filter-item">
                <label for="operator">Operator</label>
                <select id="operator" name="operator">
                    <option value="">All Operators</option>
                    @foreach($operators as $op)
                        <option value="{{ $op }}" {{ request('operator') === $op ? 'selected' : '' }}>{{ $op }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-item">
                <label for="line">Production Line</label>
                <select id="line" name="line">
                    <option value="">All Lines</option>
                    @foreach($lines as $l)
                        <option value="{{ $l }}" {{ request('line') === $l ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-item">
                <label for="shift">Shift</label>
                <select id="shift" name="shift">
                    <option value="">All Shifts</option>
                    @foreach($shifts as $s)
                        <option value="{{ $s }}" {{ request('shift') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-item">
                <label for="plate_code">Plate Code</label>
                <select id="plate_code" name="plate_code">
                    <option value="">All Plates</option>
                    @foreach($plateCodes as $pc)
                        <option value="{{ $pc }}" {{ request('plate_code') === $pc ? 'selected' : '' }}>{{ $pc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions-compact">
                <button type="submit" class="btn-apply-compact"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('alarm.moisture') }}" class="btn-reset-compact"><i class="bi bi-arrow-clockwise"></i> Reset</a>
            </div>
        </div>
    </form>
</div>

<div class="result-summary">
    <div>
        <span style="color: #6c757d;">Showing</span>
        <strong>{{ $failedTests->count() }}</strong>
        <span style="color: #6c757d;">results</span>
        @if(count(request()->query()) > 0 && !collect(request()->query())->every(fn($v) => empty($v)))
            <span style="color: #6c757d;">from</span>
            <strong>{{ $totalFailed }}</strong>
            <span style="color: #6c757d;">total failed tests</span>
        @endif
    </div>
    <div>
        <form method="GET" action="{{ route('alarm.moisture') }}" style="display: inline;">
            @foreach(request()->query() as $key => $value)
                @if(!empty($value))
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <select name="per_page" onchange="this.form.submit()" style="padding: 8px; border: 1px solid var(--border-color); border-radius: 4px; font-size: 11px;">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 per page</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 per page</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 per page</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 per page</option>
            </select>
        </form>
    </div>
</div>

<div class="table-container">
    @if($failedTests->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Operator</th>
                    <th>Line</th>
                    <th>Shift</th>
                    <th>Plate Code</th>
                    <th>MC Result (%)</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach($failedTests as $test)
                    <tr class="{{ $loop->odd ? 'table-row-odd' : 'table-row-even' }}">
                        <td>{{ $test->moisture_date_log }}</td>
                        <td>{{ $test->moisture_time_log }}</td>
                        <td>{{ $test->operator_name }}</td>
                        <td>{{ $test->production_line_name }}</td>
                        <td>{{ $test->shift_name }}</td>
                        <td>{{ $test->plate_code }}</td>
                        <td>{{ number_format($test->mc_result, 2) }}</td>
                        <td><span class="status-fail">{{ $test->quality_status_name }}</span></td>
                        <td><span class="remark-text">{{ $test->remark_name ?? '—' }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>No Failed Tests</h3>
            <p>No moisture content failures found matching your filters</p>
        </div>
    @endif
</div>

@if($failedTests->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Page <strong>{{ $failedTests->currentPage() }}</strong> of <strong>{{ $failedTests->lastPage() }}</strong>
        </div>
        {{ $failedTests->render() }}
    </div>
@endif
@endsection
