@extends('layouts.operator')

@section('title', 'Moisture Content Testing')

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

    .filter-group input {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
        background-color: white;
        color: var(--primary);
        transition: all 0.2s ease;
    }

    .filter-group input:focus {
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
        grid-template-columns: 1fr;
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

    .moisture-input {
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

    .moisture-input:focus {
        outline: none;
        border-color: var(--info);
    }

    .moisture-input.pass {
        border-color: var(--success);
        background: rgba(40, 167, 69, 0.05);
    }

    .moisture-input.fail {
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
        grid-template-columns: 1fr;
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

    .loading { display: none; color: var(--info); font-size: 12px; }
    .loading.active { display: inline-block; }

    #moistureTestForm {
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

    .specification-grid *,
    .stats-grid *,
    .data-table * {
        transition: none !important;
    }

    .specification-grid *:hover,
    .stats-grid *:hover,
    .data-table tbody tr:hover {
        transform: none !important;
    }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; gap: 8px; }
        .btn-measure { align-self: flex-start; }
        .filter-bar { grid-template-columns: 1fr; }
        .specification-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
        .data-table th, .data-table td { padding: 4px 4px; }
        .moisture-input { padding: 4px; font-size: 12px; }
        #moistureTestForm { height: calc(100vh - 80px); }
    }
</style>
@endsection

@section('content')
<form id="moistureTestForm" data-url="{{ route('testing.moisture.store') }}">
    @csrf
    <input type="hidden" name="moisture_remark_id" id="moistureRemarkInput" value="">
    <input type="hidden" name="from_temperature" id="fromTemperatureInput" value="">
    <input type="hidden" name="to_temperature" id="toTemperatureInput" value="">

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
                    <option value="{{ $ps->id }}" data-mc-lsl="{{ $ps->mc_lsl }}">{{ $ps->plate_code }}</option>
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

        <div class="filter-group">
            <label for="curingBooth">Curing Booth</label>
            <select id="curingBooth" name="curing_booth_id" required>
                <option value="">Select Curing Booth</option>
                @foreach($curingBooths ?? [] as $cb)
                    <option value="{{ $cb->id }}">{{ $cb->curing_booth }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="rackNo">Rack No.</label>
            <input type="text" id="rackNo" name="rack_no" placeholder="Enter rack number" required>
        </div>

        <button type="button" class="btn-measure" id="measureBtn"><i class="bi bi-play-circle"></i> Measure</button>
    </div>

    <div class="content-grid">
        <div>
            <div class="card">
                <h3 class="card-title"><i class="bi bi-diagram-3"></i> Specification</h3>
                <div class="specification-grid">
                    <div class="spec-item"><div class="spec-label">LSL %</div><div class="spec-value" id="specLSL">—</div></div>
                </div>
            </div>

            <div class="card" style="margin-top: 24px;">
                <h3 class="card-title"><i class="bi bi-graph-up"></i> Live Value</h3>
                <div class="stats-grid">
                    <div class="stat-item"><div class="stat-label">Moisture Result</div><div class="stat-value" id="statValue">—</div></div>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="card-title"><i class="bi bi-droplet"></i> Moisture Content Collection</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Sample</th>
                        <th>MC Result Input</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td><input type="number" class="moisture-input" id="mcResult" name="mc_result" placeholder="Enter moisture %" step="any" data-sample="mc01" min="0" max="100" disabled></td>
                        <td><span class="status-badge status-empty" id="status-mc01">—</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="text-align: right; margin-top: 24px;">
        <span class="loading" id="savingIndicator">Saving...</span>
    </div>
</form>
@endsection

@section('scripts')
<script>
class MoistureTestController {
    constructor() {
        this.mcLsl = null;
        this.remarks = @json($remarks ?? []);
        this.isSaving = false;
        this.init();
    }

    init() {
        this.attachEventListeners();

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
            this.validateAndEnableMoistureInput();
        });

        document.getElementById('runType').addEventListener('change', () => {
            this.validateAndEnableMoistureInput();
        });

        document.getElementById('shift').addEventListener('change', () => {
            this.validateAndEnableMoistureInput();
        });

        document.getElementById('line').addEventListener('change', () => {
            this.validateAndEnableMoistureInput();
        });

        document.getElementById('curingBooth').addEventListener('change', () => {
            this.validateAndEnableMoistureInput();
        });

        document.getElementById('rackNo').addEventListener('change', () => {
            this.validateAndEnableMoistureInput();
        });

        const mcInput = document.getElementById('mcResult');

        mcInput.addEventListener('focus', () => {
            if (mcInput.disabled) {
                this.showValidationError();
                return false;
            }
        });

        mcInput.addEventListener('blur', () => this.handleMoistureInput(mcInput));

        mcInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.checkAndAutoSave();
            }
        });

        document.getElementById('measureBtn').addEventListener('click', () => {
            if (!this.areAllRequiredFieldsSelected()) {
                this.showValidationError();
                return;
            }
            this.resetForm();
            mcInput.focus();
            mcInput.select();
        });

        document.getElementById('moistureTestForm').addEventListener('submit', (e) => {
            this.submitForm(e);
        });
    }

    areAllRequiredFieldsSelected() {
        const runType = document.getElementById('runType').value;
        const plateSpec = document.getElementById('plateSpec').value;
        const shift = document.getElementById('shift').value;
        const line = document.getElementById('line').value;
        const curingBooth = document.getElementById('curingBooth').value;
        const rackNo = document.getElementById('rackNo').value.trim();

        return runType && plateSpec && shift && line && curingBooth && rackNo;
    }

    validateAndEnableMoistureInput() {
        const mcInput = document.getElementById('mcResult');
        const isValid = this.areAllRequiredFieldsSelected();

        if (isValid) {
            mcInput.disabled = false;
        } else {
            mcInput.disabled = true;
            mcInput.value = '';
            mcInput.classList.remove('pass', 'fail');
        }

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
                        <li>Curing Booth</li>
                        <li>Rack No.</li>
                    </ul>
                    <p style="margin-top: 15px; font-size: 13px; color: #666;">Then click the <strong>Measure</strong> button to start entering moisture content.</p>
                </div>
            `,
            confirmButtonColor: '#1D3557',
            confirmButtonText: 'OK'
        });
    }

    checkAndAutoSave() {
        if (this.isSaving) return;

        const mcInput = document.getElementById('mcResult');
        const mcValue = mcInput.value.trim();

        if (mcValue === '') return;

        const mcResult = parseFloat(mcValue);
        const hasFail = mcResult < this.mcLsl;

        if (hasFail) {
            this.showRemarksDialog();
        } else {
            this.autoSave();
        }
    }

    autoSave() {
        if (this.isSaving) return;

        this.isSaving = true;
        const form = document.getElementById('moistureTestForm');
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
                        const mcInput = document.getElementById('mcResult');
                        if (mcInput) {
                            mcInput.focus();
                            mcInput.setSelectionRange(0, 0);
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

        this.mcLsl = parseFloat(option.dataset.mcLsl);

        document.getElementById('specLSL').textContent = this.mcLsl.toFixed(2);
    }

    resetSpecification() {
        this.mcLsl = null;
        document.getElementById('specLSL').textContent = '—';
    }

    handleMoistureInput(input) {
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

        if (this.mcLsl === null) {
            const option = document.getElementById('plateSpec').options[document.getElementById('plateSpec').selectedIndex];
            this.loadSpecification(option);
        }

        if (this.mcLsl !== null) {
            const isPass = value >= this.mcLsl;
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
        const mcInput = document.getElementById('mcResult');
        const value = parseFloat(mcInput.value);

        if (!mcInput.value || isNaN(value)) {
            this.resetStatistics();
            return;
        }

        document.getElementById('statValue').textContent = value.toFixed(2) + ' %';
    }

    resetStatistics() {
        document.getElementById('statValue').textContent = '—';
    }

    resetForm() {
        const mcInput = document.getElementById('mcResult');
        mcInput.value = '';
        mcInput.classList.remove('pass', 'fail');
        const statusEl = document.getElementById('status-mc01');
        statusEl.textContent = '—';
        statusEl.className = 'status-badge status-empty';
        this.resetStatistics();
    }

    submitForm(e) {
        if (e) e.preventDefault();
    }

    showRemarksDialog() {
        const remarksOptions = this.remarks.map(r => `<option value="${r.id}">${r.remark_name}</option>`).join('');

        Swal.fire({
            icon: 'warning',
            title: 'Failed Measurement',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>⚠️ Moisture content failed specification!</strong></p>
                    <p style="margin-top: 15px; margin-bottom: 10px;">Please select a remark:</p>
                    <select id="swal-remarks" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Select a remark --</option>
                        ${remarksOptions}
                    </select>
                    <p style="margin-top: 15px; margin-bottom: 10px;">Enter temperature range (°C):</p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 600; color: #666; margin-bottom: 5px; display: block;">From (°C)</label>
                            <input type="number" id="swal-from-temperature" placeholder="From" step="0.01" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 600; color: #666; margin-bottom: 5px; display: block;">To (°C)</label>
                            <input type="number" id="swal-to-temperature" placeholder="To" step="0.01" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                        </div>
                    </div>
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
                const fromTemp = document.getElementById('swal-from-temperature').value;
                const toTemp = document.getElementById('swal-to-temperature').value;

                if (!remarkId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required',
                        text: 'Please select a remark',
                        confirmButtonColor: '#dc3545'
                    });
                    return;
                }

                if (!fromTemp || !toTemp) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required',
                        text: 'Please enter both from and to temperatures',
                        confirmButtonColor: '#dc3545'
                    });
                    return;
                }

                document.getElementById('moistureRemarkInput').value = remarkId;
                document.getElementById('fromTemperatureInput').value = fromTemp;
                document.getElementById('toTemperatureInput').value = toTemp;
                this.autoSave();
            }
        });
    }

    updateTime() {
        const timeElement = document.getElementById('currentTime');
        if (!timeElement) return;

        const now = new Date();
        const formatted = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' · ' + now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        timeElement.textContent = formatted;
    }
}

document.addEventListener('DOMContentLoaded', () => new MoistureTestController());
</script>
@endsection
