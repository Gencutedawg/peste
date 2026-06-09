@extends('layouts.admin')

@section('title', 'Create Plate Specification')

@section('styles')
<style>
    /* Modern SaaS Form Design */
    .form-container {
        max-width: 850px;
        margin: 0 auto;
    }

    /* Header with breadcrumb */
    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    .form-header-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.125rem;
        color: #1D3557;
    }

    .form-header-title .breadcrumb-sep {
        color: #ccc;
        margin: 0 0.25rem;
    }

    .form-header-buttons {
        display: flex;
        gap: 0.75rem;
    }

    /* Card styling - minimal */
    .form-card {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        padding: 2rem;
    }

    /* Error Icon Tooltip */
    .field-error-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: transparent;
        font-size: 1.25rem;
        display: none;
        pointer-events: none;
        width: 1px;
        height: 1px;
    }

    /* Form groups - compact */
    .form-group-section {
        margin-bottom: 2rem;
    }

    .form-group-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1D3557;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        display: block;
    }

    /* Multi-column grid */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .form-row.two-col {
        grid-template-columns: 1fr 1fr;
    }

    /* Form controls */
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #1D3557;
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .form-label .required {
        color: #dc3545;
        font-weight: 600;
    }

    .form-control-wrapper {
        position: relative;
    }

    .form-control,
    .form-select {
        height: 40px;
        font-size: 0.9375rem;
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        transition: all 0.15s ease;
        background-color: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2C6CB0;
        outline: none;
        box-shadow: 0 0 0 3px rgba(44, 108, 176, 0.1);
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        padding-right: 2.5rem;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    /* Error icon on field */
    .field-error-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #dc3545;
        font-size: 1.25rem;
        display: none;
        pointer-events: none;
    }

    .form-control.is-invalid ~ .field-error-icon,
    .form-select.is-invalid ~ .field-error-icon {
        display: block;
    }

    /* Validation feedback */
    .invalid-feedback {
        display: none;
        font-size: 0.8125rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    .invalid-feedback.show {
        display: block;
    }

    /* Helper text */
    .form-text {
        font-size: 0.8125rem;
        color: #6c757d;
        margin-top: 0.25rem;
        display: block;
    }

    /* Toggle switch */
    .form-check {
        margin-top: 0.5rem;
    }

    .form-check-input {
        width: 2.5rem;
        height: 1.5rem;
        margin-top: 0.125rem;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #2C6CB0;
        border-color: #2C6CB0;
    }

    .form-check-label {
        font-size: 0.9375rem;
        color: #1D3557;
        margin-left: 0.75rem;
        font-weight: 500;
        cursor: pointer;
    }

    /* Buttons */
    .btn-primary,
    .btn-secondary {
        height: 40px;
        padding: 0.5rem 1rem;
        font-size: 0.9375rem;
        font-weight: 500;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background-color: #2C6CB0;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1D3557;
    }

    .btn-secondary {
        background-color: #f0f0f0;
        color: #1D3557;
        border: 1px solid #e3e6f0;
    }

    .btn-secondary:hover {
        background-color: #e8e8e8;
    }

    /* Field hint */
    .field-hint {
        font-size: 0.75rem;
        color: #999;
        margin-top: 0.2rem;
        font-style: italic;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            max-width: 100%;
            padding: 0 1rem;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .form-header-buttons {
            width: 100%;
            justify-content: flex-end;
        }

        .form-header-buttons .btn-secondary {
            display: none;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .form-row.two-col {
            grid-template-columns: 1fr;
        }

        .form-header-title {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <!-- Header with Breadcrumb & Buttons -->
    <div class="form-header">
        <div class="form-header-title">
            <a href="{{ route('plates.index') }}" style="color: #2C6CB0; text-decoration: none;">Plate Specifications</a>
            <span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <div class="form-header-buttons">
            <a href="{{ route('plates.index') }}" class="btn-secondary">
                <i class="bi bi-x"></i>Cancel
            </a>
            <button type="submit" form="createPlateForm" class="btn-primary">
                <i class="bi bi-check"></i>Create Plate
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('plates.store') }}" method="POST" id="createPlateForm">
            @csrf

            <!-- Basic Information -->
            <div class="form-group-section">
                <span class="form-section-title">Basic Information</span>

                <div class="form-row full">
                    <div>
                        <label for="plate_code" class="form-label">
                            Plate Code
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="text" class="form-control @error('plate_code') is-invalid @enderror"
                                   id="plate_code" name="plate_code" value="{{ old('plate_code') }}"
                                   placeholder="e.g., PL-001" required>
                            <span class="field-error-icon"></span>
                            
                        </div>
                        @error('plate_code')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Weight Specifications -->
            <div class="form-group-section">
                <span class="form-section-title">Weight Specifications (grams)</span>

                <div class="form-row">
                    <div>
                        <label for="weight_lsl" class="form-label">
                            Lower Limit (LSL)
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('weight_lsl') is-invalid @enderror"
                                   id="weight_lsl" name="weight_lsl" value="{{ old('weight_lsl') }}"
                                   placeholder="90.00" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('weight_lsl')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Minimum allowed</div>
                    </div>
                    <div>
                        <label for="weight_target" class="form-label">
                            Target Value
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('weight_target') is-invalid @enderror"
                                   id="weight_target" name="weight_target" value="{{ old('weight_target') }}"
                                   placeholder="95.00" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('weight_target')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Ideal weight</div>
                    </div>
                    <div>
                        <label for="weight_usl" class="form-label">
                            Upper Limit (USL)
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('weight_usl') is-invalid @enderror"
                                   id="weight_usl" name="weight_usl" value="{{ old('weight_usl') }}"
                                   placeholder="100.00" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('weight_usl')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Maximum allowed</div>
                    </div>
                </div>
            </div>

            <!-- Thickness Specifications -->
            <div class="form-group-section">
                <span class="form-section-title">Thickness Specifications (mm)</span>

                <div class="form-row">
                    <div>
                        <label for="thick_lsl" class="form-label">
                            Lower Limit (LSL)
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('thick_lsl') is-invalid @enderror"
                                   id="thick_lsl" name="thick_lsl" value="{{ old('thick_lsl') }}"
                                   placeholder="4.50" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('thick_lsl')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Minimum allowed</div>
                    </div>
                    <div>
                        <label for="thick_target" class="form-label">
                            Target Value
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('thick_target') is-invalid @enderror"
                                   id="thick_target" name="thick_target" value="{{ old('thick_target') }}"
                                   placeholder="4.75" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('thick_target')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Ideal thickness</div>
                    </div>
                    <div>
                        <label for="thick_usl" class="form-label">
                            Upper Limit (USL)
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <input type="number" step="0.01" min="0" max="999.99"
                                   class="form-control @error('thick_usl') is-invalid @enderror"
                                   id="thick_usl" name="thick_usl" value="{{ old('thick_usl') }}"
                                   placeholder="5.00" required>
                            <span class="field-error-icon"></span>

                        </div>
                        @error('thick_usl')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Maximum allowed</div>
                    </div>
                </div>
            </div>

            <!-- Moisture Content -->
            <div class="form-group-section">
                <span class="form-section-title">Moisture Content</span>

                <div class="form-row full">
                    <div>
                        <label for="mc_lsl" class="form-label">
                            Lower Specification Limit (LSL) %
                            <span class="required">*</span>
                        </label>
                        <div class="form-control-wrapper">
                            <select class="form-select @error('mc_lsl') is-invalid @enderror"
                                    id="mc_lsl" name="mc_lsl" required>
                                <option value="">Select LSL %</option>
                                <option value="9.5" {{ old('mc_lsl') === '9.5' ? 'selected' : '' }}>9.5%</option>
                                <option value="8.5" {{ old('mc_lsl') === '8.5' ? 'selected' : '' }}>8.5%</option>
                            </select>
                            <span class="field-error-icon"></span>
                            
                        </div>
                        @error('mc_lsl')
                            <div class="invalid-feedback show">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Select minimum moisture percentage</div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="form-group-section">
                <span class="form-section-title">Status</span>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const createPlateForm = document.getElementById('createPlateForm');
        const isEditForm = createPlateForm.getAttribute('action').includes('update');

        // Auto-convert plate code to uppercase
        const plateCodeInput = document.querySelector('#plate_code');
        if (plateCodeInput) {
            plateCodeInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }

        function validateSpecifications() {
            clearValidationErrors();
            let errors = [];

            const weightUsl = parseFloat(document.querySelector('#weight_usl').value);
            const weightTarget = parseFloat(document.querySelector('#weight_target').value);
            const weightLsl = parseFloat(document.querySelector('#weight_lsl').value);

            if (weightLsl >= weightUsl) {
                errors.push('Weight LSL must be lower than USL');
            }
            if (weightTarget < weightLsl || weightTarget > weightUsl) {
                errors.push('Weight target must be between LSL and USL');
            }

            const thickUsl = parseFloat(document.querySelector('#thick_usl').value);
            const thickTarget = parseFloat(document.querySelector('#thick_target').value);
            const thickLsl = parseFloat(document.querySelector('#thick_lsl').value);

            if (thickLsl >= thickUsl) {
                errors.push('Thickness LSL must be lower than USL');
            }
            if (thickTarget < thickLsl || thickTarget > thickUsl) {
                errors.push('Thickness target must be between LSL and USL');
            }

            if (errors.length > 0) {
                showErrorAlert(errors);
            }

            return errors.length === 0;
        }

        function showErrorAlert(errors) {
            const errorList = errors.map(err => `<li style="margin-bottom: 0.5rem;">• ${err}</li>`).join('');
            Swal.fire({
                title: 'Validation Errors',
                html: `<ul style="text-align: left; list-style: none; padding: 0;">${errorList}</ul>`,
                icon: 'error',
                confirmButtonColor: '#2C6CB0'
            });
        }

        function clearValidationErrors() {
            document.querySelectorAll('.form-control.is-invalid, .form-select.is-invalid').forEach(field => {
                field.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(div => {
                div.classList.remove('show');
            });
        }

        ['weight_usl', 'weight_target', 'weight_lsl', 'thick_usl', 'thick_target', 'thick_lsl'].forEach(fieldId => {
            const field = document.querySelector(`#${fieldId}`);
            if (field) {
                field.addEventListener('change', validateSpecifications);
            }
        });

        createPlateForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateSpecifications()) {
                return;
            }

            const plateCode = document.querySelector('#plate_code').value;
            const weightTarget = document.querySelector('#weight_target').value;
            const weightUsl = document.querySelector('#weight_usl').value;
            const weightLsl = document.querySelector('#weight_lsl').value;
            const thickTarget = document.querySelector('#thick_target').value;
            const thickUsl = document.querySelector('#thick_usl').value;
            const thickLsl = document.querySelector('#thick_lsl').value;

            let summaryHtml = `
                <div style="text-align: left; font-size: 0.95rem; line-height: 1.8;">
                    <div style="margin-bottom: 0.5rem;"><strong>Plate Code:</strong> ${plateCode}</div>
                    <div style="background: #f5f5f5; padding: 0.75rem; border-radius: 4px; margin: 0.5rem 0;">
                        <div style="font-weight: bold; margin-bottom: 0.5rem;">Weight Specifications:</div>
                        <div>Target: ${weightTarget} | USL: ${weightUsl} | LSL: ${weightLsl}</div>
                    </div>
                    <div style="background: #f5f5f5; padding: 0.75rem; border-radius: 4px;">
                        <div style="font-weight: bold; margin-bottom: 0.5rem;">Thickness Specifications:</div>
                        <div>Target: ${thickTarget} | USL: ${thickUsl} | LSL: ${thickLsl}</div>
                    </div>
                </div>
            `;

            const confirmText = isEditForm ? 'Yes, Update' : 'Yes, Create';

            Swal.fire({
                title: 'Confirm ' + (isEditForm ? 'Update' : 'Create'),
                html: `<div style="margin-bottom: 1rem;">Please review the information below:</div>${summaryHtml}`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2C6CB0',
                cancelButtonColor: '#6c757d',
                confirmButtonText: confirmText,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    createPlateForm.submit();
                }
            });
        });
    });
</script>
@endsection
