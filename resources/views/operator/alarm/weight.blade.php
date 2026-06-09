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

    .page-header {
        background: white;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: var(--shadow);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary);
        margin: 0;
    }

    .badge-count {
        background: var(--danger);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
    }

    .data-table thead {
        background: var(--light-gray);
        border-bottom: 2px solid var(--border-color);
    }

    .data-table th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-color);
        font-size: 14px;
        color: #333;
    }

    .data-table tbody tr:hover {
        background-color: var(--light-gray);
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

    .pagination {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 4px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        text-decoration: none;
        color: var(--primary);
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .pagination a:hover {
        background-color: var(--light-gray);
        border-color: var(--primary);
    }

    .pagination .active span {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .pagination .disabled span {
        color: #ccc;
        cursor: not-allowed;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #6c757d;
    }

    .pagination {
        margin: 0;
        gap: 0.25rem;
        display: inline-flex;
    }

    .page-link {
        color: #1D3557;
        border-color: #dee2e6;
        border-radius: 6px;
        padding: 0.375rem 0.625rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .page-link:hover {
        color: #fff;
        background-color: #1D3557;
        border-color: #1D3557;
    }

    .page-item.active .page-link {
        background-color: #1D3557;
        border-color: #1D3557;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .pagination-wrapper {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        padding: 16px 0;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .data-table th,
        .data-table td {
            padding: 10px 8px;
            font-size: 12px;
        }

        .page-title {
            font-size: 20px;
        }
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
        padding: 16px;
        background: var(--light-gray);
        border-radius: 8px;
    }

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
        font-size: 14px;
        font-family: inherit;
        background: white;
        color: #333;
        transition: border-color 0.2s ease;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(29, 53, 87, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 8px;
        align-items: flex-end;
        grid-column: auto;
    }

    .filter-actions button {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-filter {
        background: var(--primary);
        color: white;
    }

    .btn-filter:hover {
        background: #0f1f2e;
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

    @media (max-width: 768px) {
        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            grid-column: 1;
        }
    }

</style>
@endsection

@section('content')
<div class="content-card">
    <form method="GET" action="{{ route('alarm.weight') }}" class="filter-form">
        <div class="filter-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="{{ request('date') }}">
        </div>

        <div class="filter-group">
            <label for="operator">Operator</label>
            <select id="operator" name="operator">
                <option value="">All Operators</option>
                @foreach($operators as $op)
                    <option value="{{ $op }}" {{ request('operator') === $op ? 'selected' : '' }}>
                        {{ $op }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="line">Line</label>
            <select id="line" name="line">
                <option value="">All Lines</option>
                @foreach($lines as $line)
                    <option value="{{ $line }}" {{ request('line') === $line ? 'selected' : '' }}>
                        {{ $line }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="shift">Shift</label>
            <select id="shift" name="shift">
                <option value="">All Shifts</option>
                @foreach($shifts as $shift)
                    <option value="{{ $shift }}" {{ request('shift') === $shift ? 'selected' : '' }}>
                        {{ $shift }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="plate_code">Plate Code</label>
            <select id="plate_code" name="plate_code">
                <option value="">All Plate Codes</option>
                @foreach($plateCodes as $code)
                    <option value="{{ $code }}" {{ request('plate_code') === $code ? 'selected' : '' }}>
                        {{ $code }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn-filter">
                <i class="bi bi-funnel"></i> Filter
            </button>
            <a href="{{ route('alarm.weight') }}" class="btn-reset" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
        </div>
    </form>
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
                    <tr>
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

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $failedTests->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-check-circle"></i>
            <h3>No Failed Tests</h3>
            <p>All weight measurements are within specifications. Great job! ✅</p>
        </div>
    @endif
</div>
@endsection

