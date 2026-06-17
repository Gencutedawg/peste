@extends('layouts.operator')

@section('title', 'Thickness Testing')

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
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 8px;
        margin-bottom: 8px;
    }

    .filter-group { display: flex; flex-direction: column; }

    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group select {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
        background-color: white;
        color: var(--primary);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-group select:focus {
        outline: none;
        border-color: var(--info);
    }

    .btn-measure {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        align-self: flex-end;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1.8fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    @media (max-width: 1200px) { .content-grid { grid-template-columns: 1fr; } }

    .card {
        background: white;
        border-radius: 12px;
        padding: 12px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .card-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--primary);
        margin: 0 0 10px 0;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--light-gray);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .specification-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .spec-item {
        text-align: center;
        padding: 8px;
        background: var(--light-gray);
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .spec-label {
        font-size: 10px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .spec-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }

    .data-table thead {
        background: var(--light-gray);
        border-bottom: 2px solid var(--border-color);
    }

    .data-table th {
        padding: 6px 8px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 6px 8px;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }

    .side-label {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 6px;
        font-size: 11px;
        min-width: 45px;
    }

    .thickness-input {
        width: 100%;
        padding: 6px;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        color: var(--primary);
        text-align: center;
        transition: all 0.2s ease;
    }

    .thickness-input:focus {
        outline: none;
        border-color: var(--info);
    }

    .thickness-input.pass {
        border-color: var(--success);
        background: rgba(40, 167, 69, 0.05);
    }

    .thickness-input.fail {
        border-color: var(--danger);
        background: rgba(220, 53, 69, 0.05);
    }

    .status-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 10px;
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
        gap: 6px;
        margin-top: 8px;
    }

    .stat-item {
        background: var(--light-gray);
        padding: 8px;
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .stat-label {
        font-size: 10px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary);
    }

    .nonconformance-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin: 10px 0;
    }

    .nc-item {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        padding: 8px;
        border-radius: 6px;
        border-left: 4px solid var(--danger);
    }

    .nc-label {
        font-size: 10px;
        font-weight: 600;
        color: var(--danger);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .nc-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--danger);
    }

    .loading { display: none; color: var(--info); font-size: 12px; }
    .loading.active { display: inline-block; }

    .plate-indicator-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
        padding: 16px;
        background: var(--light-gray);
        border-radius: 8px;
        border: 2px solid var(--border-color);
    }

    .plate-visual {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 8px;
        width: 120px;
        height: 120px;
    }

    .corner {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-color);
        border-radius: 4px;
        background: white;
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
        cursor: default;
        transition: all 0.2s ease;
    }

    .corner.active {
        animation: cornerBlink 2s ease-in-out infinite;
    }

    @keyframes cornerBlink {
        0%, 100% { background: white; box-shadow: none; }
        50% { background: #0dcaf0; color: white; box-shadow: 0 0 12px rgba(13, 202, 240, 0.6); }
    }

    .corner-label {
        font-size: 10px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        text-align: center;
    }

    #thicknessTestForm {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 120px);
        gap: 0;
        overflow: hidden;
    }

    .content-grid {
        flex: 1;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; gap: 8px; }
        .btn-measure { align-self: flex-start; }
        .filter-bar { grid-template-columns: 1fr; }
        .specification-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
        .nonconformance-grid { grid-template-columns: 1fr; }
        .data-table th, .data-table td { padding: 4px 4px; }
        .thickness-input { padding: 4px; font-size: 12px; }
        #thicknessTestForm { height: calc(100vh - 80px); }
    }
</style>
@endsection

@section('content')
<form id="thicknessTestForm" data-url="{{ route('testing.thickness.store') }}">
    @csrf
    <input type="hidden" name="thickness_remark_id" id="thicknessRemarkInput" value="">

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
                    <option value="{{ $ps->id }}" data-lsl="{{ $ps->thick_lsl }}" data-target="{{ $ps->thick_target }}" data-usl="{{ $ps->thick_usl }}">{{ $ps->plate_code }}</option>
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
                    <div class="stat-item"><div class="stat-label">LSL</div><div class="stat-value" id="statLSL">—</div></div>
                    <div class="stat-item"><div class="stat-label">USL</div><div class="stat-value" id="statUSL">—</div></div>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title"><i class="bi bi-rulers"></i> Thickness Collection</h3>

            <div style="margin-bottom: 20px;">
                <div class="corner-label">Active Corner Testing</div>
                <div class="plate-indicator-container">
                    <div class="plate-visual">
                        <div class="corner" id="corner-c1">C1</div>
                        <div class="corner" id="corner-c2">C2</div>
                        <div class="corner" id="corner-c4">C4</div>
                        <div class="corner" id="corner-c3">C3</div>
                    </div>
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Side</th>
                        <th>Corner</th>
                        <th>Thickness Input</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(['c1', 'c2', 'c3', 'c4'] as $corner)
                        <tr>
                            @if($loop->first)<td rowspan="4" class="side-label">OP</td>@endif
                            <td>{{ strtoupper($corner) }}</td>
                            <td><input type="number" class="thickness-input" name="op_{{ $corner }}" placeholder="Enter thickness" step="any" data-sample="op{{ $corner }}" min="0" disabled></td>
                            <td><span class="status-badge status-empty" id="status-op{{ $corner }}">—</span></td>
                        </tr>
                    @endforeach
                    @foreach(['c1', 'c2', 'c3', 'c4'] as $corner)
                        <tr>
                            @if($loop->first)<td rowspan="4" class="side-label">NOP</td>@endif
                            <td>{{ strtoupper($corner) }}</td>
                            <td><input type="number" class="thickness-input" name="nop_{{ $corner }}" placeholder="Enter thickness" step="any" data-sample="nop{{ $corner }}" min="0" disabled></td>
                            <td><span class="status-badge status-empty" id="status-nop{{ $corner }}">—</span></td>
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
        <span class="loading" id="savingIndicator">Saving...</span>
    </div>
</form>
@endsection

@section('scripts')
<script>
class ThicknessTestController {
    constructor() {
        this.lsl = null;
        this.target = null;
        this.usl = null;
        this.remarks = @json($remarks ?? []);
        this.isSaving = false;
        this.cornerMap = {
            'op_c1': 'c1', 'nop_c1': 'c1',
            'op_c2': 'c2', 'nop_c2': 'c2',
            'op_c3': 'c3', 'nop_c3': 'c3',
            'op_c4': 'c4', 'nop_c4': 'c4'
        };
        this.init();
    }

    init() {
        this.attachEventListeners();

        // Load spec if one is already selected
        const plateSpecSelect = document.getElementById('plateSpec');
        if (plateSpecSelect.value) {
            const option = plateSpecSelect.options[plateSpecSelect.selectedIndex];
            this.loadSpecification(option);
        }

        this.updateTime();
        setInterval(() => this.updateTime(), 60000);
    }

    attachEventListeners() {
        document.getElementById('plateSpec').addEventListener('change', (e) => {
            this.loadSpecification(e.target.options[e.target.selectedIndex]);
            this.validateAndEnableThicknessInputs();
        });

        // Also load specification on initial value change (in case form is populated)
        if (document.getElementById('plateSpec').value) {
            const option = document.getElementById('plateSpec').options[document.getElementById('plateSpec').selectedIndex];
            this.loadSpecification(option);
        }

        document.getElementById('runType').addEventListener('change', () => {
            this.validateAndEnableThicknessInputs();
        });

        document.getElementById('shift').addEventListener('change', () => {
            this.validateAndEnableThicknessInputs();
        });

        document.getElementById('line').addEventListener('change', () => {
            this.validateAndEnableThicknessInputs();
        });

        const thicknessInputs = document.querySelectorAll('.thickness-input');
        const inputArray = Array.from(thicknessInputs);

        thicknessInputs.forEach((input, index) => {
            input.addEventListener('focus', () => {
                if (input.disabled) {
                    this.showValidationError();
                    return false;
                }
                this.activateCornerBlink(input);
            });

            input.addEventListener('blur', () => this.handleThicknessInput(input));

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Tab' || e.key === 'Enter') {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                    }
                    const nextInput = inputArray[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                        nextInput.select();
                    } else if (e.key === 'Enter') {
                        this.checkAndAutoSave();
                    }
                    return false;
                }
            });
        });

        document.getElementById('measureBtn').addEventListener('click', () => {
            if (!this.areAllRequiredFieldsSelected()) {
                this.showValidationError();
                return;
            }
            this.resetForm();
            const firstInput = document.querySelector('.thickness-input:not([disabled])');
            if (firstInput) {
                firstInput.focus();
                firstInput.select();
            }
        });

        document.getElementById('thicknessTestForm').addEventListener('submit', (e) => {
            this.submitForm(e);
        });
    }

    activateCornerBlink(input) {
        const inputName = input.getAttribute('name');
        const cornerId = this.cornerMap[inputName];

        if (cornerId) {
            const cornerElement = document.getElementById(`corner-${cornerId}`);
            if (cornerElement) {
                // Remove active class from all corners
                document.querySelectorAll('.corner').forEach(corner => {
                    corner.classList.remove('active');
                });
                // Add active class to current corner
                cornerElement.classList.add('active');
            }
        }
    }

    areAllRequiredFieldsSelected() {
        const runType = document.getElementById('runType').value;
        const plateSpec = document.getElementById('plateSpec').value;
        const shift = document.getElementById('shift').value;
        const line = document.getElementById('line').value;

        return runType && plateSpec && shift && line;
    }

    validateAndEnableThicknessInputs() {
        const thicknessInputs = document.querySelectorAll('.thickness-input');
        const isValid = this.areAllRequiredFieldsSelected();

        thicknessInputs.forEach(input => {
            if (isValid) {
                input.disabled = false;
            } else {
                input.disabled = true;
                input.value = '';
                input.classList.remove('pass', 'fail');
            }
        });

        if (!isValid) {
            this.resetStatistics();
        }
    }

    showValidationError() {
        Swal.fire({
            icon: 'warning',
            title: 'Required Fields Missing',
            html: `
                <div style="text-align: left;">
                    <p><strong>⚠️ Please select all required fields first:</strong></p>
                    <ul style="margin: 15px 0; text-align: left;">
                        <li>Run Type</li>
                        <li>Plate Specification</li>
                        <li>Shift</li>
                        <li>Production Line</li>
                    </ul>
                    <p style="margin-top: 15px; font-size: 13px; color: #666;">Then click the <strong>Measure</strong> button to start entering thickness values.</p>
                </div>
            `,
            confirmButtonColor: '#1D3557',
            confirmButtonText: 'OK'
        });
    }

    checkAndAutoSave() {
        if (this.isSaving) return;

        const thickness = this.collectThickness();

        if (thickness.length === 8) {
            const hasFail = this.checkForFailures(thickness);

            if (hasFail) {
                this.showRemarksDialog();
            } else {
                this.autoSave();
            }
        }
    }

    autoSave() {
        if (this.isSaving) return;

        this.isSaving = true;
        const form = document.getElementById('thicknessTestForm');
        const indicator = document.getElementById('savingIndicator');

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
            this.isSaving = false;

            if (status === 200 || status === 201) {
                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Test results saved successfully',
                    confirmButtonColor: '#28a745'
                }).then(() => {
                    this.resetForm();
                    setTimeout(() => {
                        const inputs = document.querySelectorAll('.thickness-input');
                        if (inputs.length > 0) {
                            inputs[0].focus();
                            inputs[0].setSelectionRange(0, 0);
                        }
                    }, 100);
                });
            } else {
                const errorMsg = data.message || 'Unknown error occurred';
                const errors = data.errors ? Object.values(data.errors).flat().join('\n') : '';
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: `<div style="text-align: left;">${errorMsg}<br>${errors ? '<br>' + errors : ''}</div>`,
                    confirmButtonColor: '#dc3545'
                });
                console.error('Save error:', data);
            }
        })
        .catch(error => {
            indicator.classList.remove('active');
            this.isSaving = false;
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Error saving test results: ' + error.message,
                confirmButtonColor: '#dc3545'
            });
            console.error('Error:', error);
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

        document.getElementById('statLSL').textContent = this.lsl.toFixed(2);
        document.getElementById('statUSL').textContent = this.usl.toFixed(2);
    }

    resetSpecification() {
        this.lsl = null;
        this.target = null;
        this.usl = null;
        document.getElementById('specLSL').textContent = '—';
        document.getElementById('specTarget').textContent = '—';
        document.getElementById('specUSL').textContent = '—';
    }

    handleThicknessInput(input) {
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

        // Ensure specifications are loaded
        if (this.lsl === null || this.usl === null) {
            const option = document.getElementById('plateSpec').options[document.getElementById('plateSpec').selectedIndex];
            this.loadSpecification(option);
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
        const thickness = this.collectThickness();

        if (thickness.length === 0) {
            this.resetStatistics();
            return;
        }

        const avg = this.calculateAverage(thickness);
        const stdDev = this.calculateStdDev(thickness, avg);
        const rsd = (stdDev / avg * 100).toFixed(2);
        const range = Math.max(...thickness) - Math.min(...thickness);

        document.getElementById('statAverage').textContent = avg.toFixed(2);
        document.getElementById('statStdDev').textContent = stdDev.toFixed(2);
        document.getElementById('statRSD').textContent = rsd + '%';
        document.getElementById('statRange').textContent = range.toFixed(2);

        this.updateNonconformance(thickness);
    }

    collectThickness() {
        const thickness = [];
        document.querySelectorAll('.thickness-input').forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) thickness.push(value);
        });
        return thickness;
    }

    calculateAverage(thickness) {
        return thickness.reduce((a, b) => a + b, 0) / thickness.length;
    }

    calculateStdDev(thickness, avg) {
        const squareDiffs = thickness.map(x => Math.pow(x - avg, 2));
        const avgSquareDiff = squareDiffs.reduce((a, b) => a + b, 0) / thickness.length;
        return Math.sqrt(avgSquareDiff);
    }

    updateNonconformance(thickness) {
        if (!this.lsl || !this.usl) return;

        const failedCount = thickness.filter(t => t < this.lsl || t > this.usl).length;
        const failureRate = thickness.length > 0 ? ((failedCount / thickness.length) * 100).toFixed(1) : 0;

        document.getElementById('failedCount').textContent = failedCount;
        document.getElementById('failureRate').textContent = failureRate + '%';
    }

    resetStatistics() {
        document.getElementById('statAverage').textContent = '—';
        document.getElementById('statStdDev').textContent = '—';
        document.getElementById('statRSD').textContent = '—';
        document.getElementById('statRange').textContent = '—';
        document.getElementById('statLSL').textContent = '—';
        document.getElementById('statUSL').textContent = '—';
        document.getElementById('failedCount').textContent = '0';
        document.getElementById('failureRate').textContent = '0%';
    }

    resetForm() {
        document.querySelectorAll('.thickness-input').forEach(input => {
            input.value = '';
            input.classList.remove('pass', 'fail');
            const sample = input.dataset.sample;
            const statusEl = document.getElementById(`status-${sample}`);
            statusEl.textContent = '—';
            statusEl.className = 'status-badge status-empty';
        });
        document.querySelectorAll('.corner').forEach(corner => {
            corner.classList.remove('active');
        });
        this.resetStatistics();
    }

    submitForm(e) {
        if (e) e.preventDefault();
    }

    showRemarksDialog() {
        const remarksOptions = this.remarks.map(r => `<option value="${r.id}">${r.remark_name}</option>`).join('');

        Swal.fire({
            icon: 'warning',
            title: 'Failed Measurements',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>⚠️ Some thickness values failed specifications!</strong></p>
                    <p style="margin-top: 15px; margin-bottom: 10px;">Please select a remark:</p>
                    <select id="swal-remarks" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Select a remark --</option>
                        ${remarksOptions}
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#1D3557',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Save',
            cancelButtonText: 'Cancel',
            didOpen: () => {
                document.getElementById('swal-remarks').focus();
            },
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(result => {
            if (result.isConfirmed) {
                const remarkId = document.getElementById('swal-remarks').value;
                if (!remarkId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required',
                        text: 'Please select a remark',
                        confirmButtonColor: '#dc3545'
                    });
                    return;
                }
                document.getElementById('thicknessRemarkInput').value = remarkId;
                this.autoSave();
            }
        });
    }

    checkForFailures(thickness) {
        if (!this.lsl || !this.usl) return false;
        return thickness.some(t => t < this.lsl || t > this.usl);
    }

    updateTime() {
        const timeElement = document.getElementById('currentTime');
        if (!timeElement) return;

        const now = new Date();
        const formatted = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' · ' + now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        timeElement.textContent = formatted;
    }
}

document.addEventListener('DOMContentLoaded', () => new ThicknessTestController());
</script>
@endsection
