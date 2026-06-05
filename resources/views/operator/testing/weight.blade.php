@extends('layouts.operator')

@section('title', 'Weight Testing')

@section('styles')
<style>
    :root {
        --primary: #1D3557;
        --success: #28a745;
        --danger: #dc3545;
        --info: #0dcaf0;
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

    .page-title-section h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 8px 0;
    }

    .page-subtitle {
        font-size: 13px;
        color: #6c757d;
        margin: 0;
    }

    .filter-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .filter-group { display: flex; flex-direction: column; }

    .filter-group label {
        font-size: 13px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group select {
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        background-color: white;
        color: var(--primary);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-group select:focus {
        outline: none;
        border-color: var(--info);
        box-shadow: 0 0 0 3px rgba(13, 202, 240, 0.1);
    }

    .btn-measure {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        align-self: flex-end;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-measure:hover { transform: translateY(-2px); }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1200px) { .content-grid { grid-template-columns: 1fr; } }

    .card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 20px 0;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--light-gray);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .specification-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .spec-item {
        text-align: center;
        padding: 16px;
        background: var(--light-gray);
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .spec-label {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .spec-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
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
        padding: 12px 16px;
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
    }

    .side-label {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 12px;
        font-size: 13px;
        min-width: 60px;
    }

    .weight-input {
        width: 100%;
        padding: 14px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        color: var(--primary);
        text-align: center;
        transition: all 0.2s ease;
    }

    .weight-input:focus {
        outline: none;
        border-color: var(--info);
        box-shadow: 0 0 0 3px rgba(13, 202, 240, 0.1);
    }

    .weight-input.pass {
        border-color: var(--success);
        background: rgba(40, 167, 69, 0.05);
    }

    .weight-input.fail {
        border-color: var(--danger);
        background: rgba(220, 53, 69, 0.05);
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pass { background: rgba(40, 167, 69, 0.1); color: var(--success); }
    .status-fail { background: rgba(220, 53, 69, 0.1); color: var(--danger); }
    .status-empty { background: var(--light-gray); color: #6c757d; }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 16px;
    }

    .stat-item {
        background: var(--light-gray);
        padding: 14px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 700;
        color: var(--primary);
    }

    .nonconformance-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin: 24px 0;
    }

    .nc-item {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        padding: 16px;
        border-radius: 8px;
        border-left: 4px solid var(--danger);
    }

    .nc-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--danger);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .nc-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--danger);
    }

    .remarks-section {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .remarks-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        background-color: white;
        color: var(--primary);
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
    }

    .remarks-select:focus {
        outline: none;
        border-color: var(--info);
        box-shadow: 0 0 0 3px rgba(13, 202, 240, 0.1);
    }

    .btn-remarks {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        margin-top: 12px;
        transition: all 0.2s ease;
    }

    .btn-remarks:hover { transform: translateY(-2px); }

    .timestamp {
        font-size: 12px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .loading { display: none; color: var(--info); font-size: 13px; }
    .loading.active { display: inline-block; }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        .btn-measure { align-self: flex-start; }
        .filter-bar { grid-template-columns: 1fr; }
        .specification-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
        .nonconformance-grid { grid-template-columns: 1fr; }
        .data-table th, .data-table td { padding: 10px 8px; }
        .weight-input { padding: 10px; font-size: 14px; }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="page-title-section">
        <h1><i class="bi bi-speedometer2"></i> Weight Testing</h1>
        <p class="page-subtitle">Precision weight measurement and statistical analysis</p>
    </div>
    <div class="timestamp">
        <i class="bi bi-clock"></i>
        <span id="currentTime">{{ now()->format('M d, Y · H:i') }}</span>
    </div>
</div>

<form id="weightTestForm" data-url="{{ route('testing.weight.store') }}">
    @csrf

    <div class="filter-bar">
        <div class="filter-group">
            <label for="runType">Run Type</label>
            <select id="runType" name="run_type_id" required>
                <option value="">Select Run Type</option>
                @foreach($runTypes ?? [] as $rt)
                    <option value="{{ $rt->id }}">{{ $rt->run_type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="plateSpec">Plate Specification</label>
            <select id="plateSpec" name="plate_specification_id" required>
                <option value="">Select Plate Specification</option>
                @foreach($plateSpecifications ?? [] as $ps)
                    <option value="{{ $ps->id }}" data-lsl="{{ $ps->weight_lsl }}" data-target="{{ $ps->weight_target }}" data-usl="{{ $ps->weight_usl }}">{{ $ps->plate_code }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="shift">Shift</label>
            <select id="shift" name="time_shift_id" required>
                <option value="">Select Shift</option>
                @foreach($shifts ?? [] as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->shift_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="line">Production Line</label>
            <select id="line" name="production_line_id" required>
                <option value="">Select Line</option>
                @foreach($lines ?? [] as $line)
                    <option value="{{ $line->id }}">{{ $line->line_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" class="btn-measure" id="measureBtn"><i class="bi bi-play-circle"></i> Measure</button>
    </div>

    <div class="content-grid">
        <div>
            <div class="card">
                <h3 class="card-title"><i class="bi bi-diagram-3"></i> Specification</h3>
                <div class="specification-grid">
                    <div class="spec-item"><div class="spec-label">LSL</div><div class="spec-value" id="specLSL">—</div></div>
                    <div class="spec-item"><div class="spec-label">Target</div><div class="spec-value" id="specTarget">—</div></div>
                    <div class="spec-item"><div class="spec-label">USL</div><div class="spec-value" id="specUSL">—</div></div>
                </div>
            </div>

            <div class="card" style="margin-top: 24px;">
                <h3 class="card-title"><i class="bi bi-graph-up"></i> Live Statistics</h3>
                <div class="stats-grid">
                    <div class="stat-item"><div class="stat-label">Average</div><div class="stat-value" id="statAverage">—</div></div>
                    <div class="stat-item"><div class="stat-label">Std Dev</div><div class="stat-value" id="statStdDev">—</div></div>
                    <div class="stat-item"><div class="stat-label">RSD %</div><div class="stat-value" id="statRSD">—</div></div>
                    <div class="stat-item"><div class="stat-label">Range</div><div class="stat-value" id="statRange">—</div></div>
                </div>
            </div>

            <div class="card" style="margin-top: 24px;">
                <h3 class="card-title"><i class="bi bi-chat-dots"></i> Remarks</h3>
                <div class="filter-group">
                    <label for="weightRemarks">Select Remarks</label>
                    <select id="weightRemarks" name="weight_remark_id" class="remarks-select">
                        <option value="">-- Select a remark (Optional) --</option>
                        @foreach($remarks ?? [] as $remark)
                            <option value="{{ $remark->id }}">{{ $remark->remark_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title"><i class="bi bi-scale"></i> Weight Collection</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Side</th>
                        <th>Sample No.</th>
                        <th>Weight Input</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['01', '02', '03', '04'] as $num)
                        <tr>
                            @if($loop->first)<td rowspan="4" class="side-label">OP</td>@endif
                            <td>{{ $num }}</td>
                            <td><input type="number" class="weight-input" name="op_w{{ $num }}" placeholder="Enter weight" step="any" data-sample="op{{ $num }}"></td>
                            <td><span class="status-badge status-empty" id="status-op{{ $num }}">—</span></td>
                        </tr>
                    @endforeach
                    @foreach(['01', '02', '03', '04'] as $num)
                        <tr>
                            @if($loop->first)<td rowspan="4" class="side-label">NOP</td>@endif
                            <td>0{{ $loop->index + 5 }}</td>
                            <td><input type="number" class="weight-input" name="nop_w0{{ $loop->index + 1 }}" placeholder="Enter weight" step="any" data-sample="nop0{{ $loop->index + 1 }}"></td>
                            <td><span class="status-badge status-empty" id="status-nop0{{ $loop->index + 1 }}">—</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="nonconformance-grid">
                <div class="nc-item"><div class="nc-label">Failed Count</div><div class="nc-value" id="failedCount">0</div></div>
                <div class="nc-item"><div class="nc-label">Failure Rate %</div><div class="nc-value" id="failureRate">0%</div></div>
            </div>
        </div>
    </div>

    <div style="text-align: right; margin-top: 24px;">
        <button type="submit" class="btn-remarks"><i class="bi bi-floppy"></i> Save Test Results</button>
        <span class="loading" id="savingIndicator">Saving...</span>
    </div>
</form>
@endsection

@section('scripts')
<script>
class WeightTestController {
    constructor() {
        this.lsl = null;
        this.target = null;
        this.usl = null;
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.updateTime();
        setInterval(() => this.updateTime(), 60000);
    }

    attachEventListeners() {
        document.getElementById('plateSpec').addEventListener('change', (e) => {
            this.loadSpecification(e.target.options[e.target.selectedIndex]);
        });

        document.querySelectorAll('.weight-input').forEach(input => {
            input.addEventListener('blur', () => this.handleWeightInput(input));
        });

        document.getElementById('measureBtn').addEventListener('click', () => {
            this.resetForm();
            document.querySelector('.weight-input').focus();
        });

        document.getElementById('weightTestForm').addEventListener('submit', (e) => {
            this.submitForm(e);
        });
    }

    loadSpecification(option) {
        if (!option.value) {
            this.resetSpecification();
            return;
        }

        this.lsl = parseFloat(option.dataset.lsl);
        this.target = parseFloat(option.dataset.target);
        this.usl = parseFloat(option.dataset.usl);

        document.getElementById('specLSL').textContent = this.lsl.toFixed(2);
        document.getElementById('specTarget').textContent = this.target.toFixed(2);
        document.getElementById('specUSL').textContent = this.usl.toFixed(2);
    }

    resetSpecification() {
        this.lsl = null;
        this.target = null;
        this.usl = null;
        document.getElementById('specLSL').textContent = '—';
        document.getElementById('specTarget').textContent = '—';
        document.getElementById('specUSL').textContent = '—';
    }

    handleWeightInput(input) {
        const value = parseFloat(input.value);

        if (!input.value || input.value.trim() === '') {
            input.classList.remove('pass', 'fail');
            this.updateStatus(input, 'empty');
            this.updateStatistics();
            return;
        }

        if (isNaN(value)) {
            input.classList.remove('pass', 'fail');
            this.updateStatus(input, 'empty');
            return;
        }

        if (this.lsl !== null && this.usl !== null) {
            const isPass = value >= this.lsl && value <= this.usl;
            input.classList.toggle('pass', isPass);
            input.classList.toggle('fail', !isPass);
            this.updateStatus(input, isPass ? 'pass' : 'fail');
        }

        this.updateStatistics();
    }

    updateStatus(input, status) {
        const sample = input.dataset.sample;
        const statusEl = document.getElementById(`status-${sample}`);

        if (status === 'empty') {
            statusEl.textContent = '—';
            statusEl.className = 'status-badge status-empty';
        } else if (status === 'pass') {
            statusEl.textContent = 'PASS';
            statusEl.className = 'status-badge status-pass';
        } else if (status === 'fail') {
            statusEl.textContent = 'FAIL';
            statusEl.className = 'status-badge status-fail';
        }
    }

    updateStatistics() {
        const weights = this.collectWeights();

        if (weights.length === 0) {
            this.resetStatistics();
            return;
        }

        const avg = this.calculateAverage(weights);
        const stdDev = this.calculateStdDev(weights, avg);
        const rsd = (stdDev / avg * 100).toFixed(2);
        const range = Math.max(...weights) - Math.min(...weights);

        document.getElementById('statAverage').textContent = avg.toFixed(2);
        document.getElementById('statStdDev').textContent = stdDev.toFixed(2);
        document.getElementById('statRSD').textContent = rsd + '%';
        document.getElementById('statRange').textContent = range.toFixed(2);

        this.updateNonconformance(weights);
    }

    collectWeights() {
        const weights = [];
        document.querySelectorAll('.weight-input').forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) weights.push(value);
        });
        return weights;
    }

    calculateAverage(weights) {
        return weights.reduce((a, b) => a + b, 0) / weights.length;
    }

    calculateStdDev(weights, avg) {
        const squareDiffs = weights.map(x => Math.pow(x - avg, 2));
        const avgSquareDiff = squareDiffs.reduce((a, b) => a + b, 0) / weights.length;
        return Math.sqrt(avgSquareDiff);
    }

    updateNonconformance(weights) {
        if (!this.lsl || !this.usl) return;

        const failedCount = weights.filter(w => w < this.lsl || w > this.usl).length;
        const failureRate = weights.length > 0 ? ((failedCount / weights.length) * 100).toFixed(1) : 0;

        document.getElementById('failedCount').textContent = failedCount;
        document.getElementById('failureRate').textContent = failureRate + '%';
    }

    resetStatistics() {
        document.getElementById('statAverage').textContent = '—';
        document.getElementById('statStdDev').textContent = '—';
        document.getElementById('statRSD').textContent = '—';
        document.getElementById('statRange').textContent = '—';
        document.getElementById('failedCount').textContent = '0';
        document.getElementById('failureRate').textContent = '0%';
    }

    resetForm() {
        document.querySelectorAll('.weight-input').forEach(input => {
            input.value = '';
            input.classList.remove('pass', 'fail');
            const sample = input.dataset.sample;
            const statusEl = document.getElementById(`status-${sample}`);
            statusEl.textContent = '—';
            statusEl.className = 'status-badge status-empty';
        });
        this.resetStatistics();
    }

    submitForm(e) {
        e.preventDefault();

        const form = document.getElementById('weightTestForm');
        const button = form.querySelector('.btn-remarks');
        const indicator = document.getElementById('savingIndicator');
        const remarksSelect = document.getElementById('weightRemarks');
        const weights = this.collectWeights();

        if (weights.length === 0) {
            alert('Please enter at least one weight value.');
            return;
        }

        const hasFail = this.checkForFailures(weights);

        if (hasFail && !remarksSelect.value) {
            alert('⚠️ Some weights failed specifications!\n\nPlease select remarks before saving.');
            remarksSelect.focus();
            return;
        }

        button.disabled = true;
        indicator.classList.add('active');

        const formData = new FormData(form);

        fetch(form.dataset.url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json().then(data => ({ status: response.status, data })))
        .then(({ status, data }) => {
            indicator.classList.remove('active');
            button.disabled = false;

            if (status === 200 || status === 201) {
                alert('✅ Test results saved successfully!');
                this.resetForm();
                document.getElementById('weightRemarks').value = '';
            } else {
                const errorMsg = data.message || 'Unknown error occurred';
                const errors = data.errors ? '\n\nErrors: ' + JSON.stringify(data.errors) : '';
                alert('❌ Error: ' + errorMsg + errors);
                console.error('Save error:', data);
            }
        })
        .catch(error => {
            indicator.classList.remove('active');
            button.disabled = false;
            alert('❌ Error saving test results: ' + error.message);
            console.error('Error:', error);
        });
    }

    checkForFailures(weights) {
        if (!this.lsl || !this.usl) return false;
        return weights.some(w => w < this.lsl || w > this.usl);
    }

    updateTime() {
        const now = new Date();
        const formatted = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' · ' + now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        document.getElementById('currentTime').textContent = formatted;
    }
}

document.addEventListener('DOMContentLoaded', () => new WeightTestController());
</script>
@endsection