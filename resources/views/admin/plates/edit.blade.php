@extends('layouts.admin')

@section('title', 'Edit Plate Specification - ' . $plate->plate_code)

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

    .form-control,
    .form-select {
        height: 40px;
        font-size: 0.9375rem;
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        transition: all 0.15s ease;
        background-color: #fff;
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
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    /* Validation feedback */
    .invalid-feedback {
        display: block;
        font-size: 0.8125rem;
        color: #dc3545;
        margin-top: 0.25rem;
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

    /* Info box */
    .info-box {
        background-color: #f0f7ff;
        border: 1px solid #b3d9ff;
        border-radius: 6px;
        padding: 1rem;
    }

    .info-box-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .info-box-item {
        display: flex;
        flex-direction: column;
    }

    .info-box-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #0c5aa0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.375rem;
    }

    .info-box-value {
        font-size: 0.9375rem;
        color: #0c5aa0;
        font-weight: 500;
    }

    .info-box-time {
        font-size: 0.8125rem;
        color: #0c5aa0;
        margin-top: 0.25rem;
    }

    /* Field hint */
    .field-hint {
        font-size: 0.75rem;
        color: #999;
        margin-top: 0.2rem;
        font-style: italic;
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

        .info-box-row {
            grid-template-columns: 1fr;
            gap: 1rem;
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
            <span>Edit</span>
        </div>
        <div class="form-header-buttons">
            <a href="{{ route('plates.index') }}" class="btn-secondary">
                <i class="bi bi-x"></i>Cancel
            </a>
            <button type="submit" form="editPlateForm" class="btn-primary">
                <i class="bi bi-check"></i>Save Changes
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('plates.update', $plate) }}" method="POST" id="editPlateForm">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="form-group-section">
                <span class="form-section-title">Basic Information</span>

                <div class="form-row full">
                    <div>
                        <label for="plate_code" class="form-label">
                            Plate Code
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control @error('plate_code') is-invalid @enderror"
                               id="plate_code" name="plate_code" value="{{ old('plate_code', $plate->plate_code) }}"
                               placeholder="e.g., PL-001" required>
                        @error('plate_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Weight Specifications -->
            <div class="form-group-section">
                <span class="form-section-title">Weight Specifications (grams)</span>

                <div class="form-row">
                    <div>
                        <label for="weight_usl" class="form-label">
                            Upper Limit (USL)
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('weight_usl') is-invalid @enderror"
                               id="weight_usl" name="weight_usl" value="{{ old('weight_usl', $plate->weight_usl) }}"
                               placeholder="100.00" required>
                        @error('weight_usl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Maximum allowed</div>
                    </div>
                    <div>
                        <label for="weight_target" class="form-label">
                            Target Value
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('weight_target') is-invalid @enderror"
                               id="weight_target" name="weight_target" value="{{ old('weight_target', $plate->weight_target) }}"
                               placeholder="95.00" required>
                        @error('weight_target')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Ideal weight</div>
                    </div>
                    <div>
                        <label for="weight_lsl" class="form-label">
                            Lower Limit (LSL)
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('weight_lsl') is-invalid @enderror"
                               id="weight_lsl" name="weight_lsl" value="{{ old('weight_lsl', $plate->weight_lsl) }}"
                               placeholder="90.00" required>
                        @error('weight_lsl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Minimum allowed</div>
                    </div>
                </div>
            </div>

            <!-- Thickness Specifications -->
            <div class="form-group-section">
                <span class="form-section-title">Thickness Specifications (mm)</span>

                <div class="form-row">
                    <div>
                        <label for="thick_usl" class="form-label">
                            Upper Limit (USL)
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('thick_usl') is-invalid @enderror"
                               id="thick_usl" name="thick_usl" value="{{ old('thick_usl', $plate->thick_usl) }}"
                               placeholder="5.00" required>
                        @error('thick_usl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Maximum allowed</div>
                    </div>
                    <div>
                        <label for="thick_target" class="form-label">
                            Target Value
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('thick_target') is-invalid @enderror"
                               id="thick_target" name="thick_target" value="{{ old('thick_target', $plate->thick_target) }}"
                               placeholder="4.75" required>
                        @error('thick_target')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Ideal thickness</div>
                    </div>
                    <div>
                        <label for="thick_lsl" class="form-label">
                            Lower Limit (LSL)
                            <span class="required">*</span>
                        </label>
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('thick_lsl') is-invalid @enderror"
                               id="thick_lsl" name="thick_lsl" value="{{ old('thick_lsl', $plate->thick_lsl) }}"
                               placeholder="4.50" required>
                        @error('thick_lsl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Minimum allowed</div>
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
                        <input type="number" step="0.01" min="0" max="999.99"
                               class="form-control @error('mc_lsl') is-invalid @enderror"
                               id="mc_lsl" name="mc_lsl" value="{{ old('mc_lsl', $plate->mc_lsl) }}"
                               placeholder="8.00" required>
                        @error('mc_lsl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="field-hint">Minimum moisture percentage</div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="form-group-section">
                <span class="form-section-title">Status</span>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                           {{ old('is_active', $plate->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        {{ old('is_active', $plate->is_active) ? 'Active' : 'Inactive' }}
                    </label>
                </div>
            </div>

            <!-- Audit Information -->
            <div class="form-group-section">
                <span class="form-section-title">Audit Information</span>
                <div class="info-box">
                    <div class="info-box-row">
                        <div class="info-box-item">
                            <div class="info-box-label">Created</div>
                            <div class="info-box-value">
                                {{ $plate->creator ? $plate->creator->name : 'System' }}
                            </div>
                            <div class="info-box-time">
                                {{ $plate->created_at->format('d M Y H:i:s') }}
                            </div>
                        </div>
                        <div class="info-box-item">
                            <div class="info-box-label">Last Updated</div>
                            <div class="info-box-value">
                                {{ $plate->updater ? $plate->updater->name : 'System' }}
                            </div>
                            <div class="info-box-time">
                                {{ $plate->updated_at->format('d M Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert confirmation for form submission
        const editPlateForm = document.getElementById('editPlateForm');
        const isEditForm = editPlateForm.getAttribute('action').includes('update');
        
        editPlateForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const plateCode = document.querySelector('#plate_code').value;
            const weightTarget = document.querySelector('#weight_target').value;
            const weightUsl = document.querySelector('#weight_usl').value;
            const weightLsl = document.querySelector('#weight_lsl').value;
            const thickTarget = document.querySelector('#thick_target').value;
            const thickUsl = document.querySelector('#thick_usl').value;
            const thickLsl = document.querySelector('#thick_lsl').value;
            
            // Build summary HTML
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
            
            const actionText = isEditForm ? 'update' : 'create';
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
                    editPlateForm.submit();
                }
            });
        });
    });
</script>
@endsection
