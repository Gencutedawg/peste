@extends('layouts.admin')

@section('title', 'Edit Curing Booth - ' . $booth->curing_booth)

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
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        padding: 0.625rem 0.875rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2C6CB0;
        box-shadow: 0 0 0 3px rgba(44, 108, 176, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #a0aec0;
    }

    /* Error handling */
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.8125rem;
        margin-top: 0.25rem;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8125rem;
        font-weight: 500;
    }

    .status-badge.active {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.inactive {
        background: #f8d7da;
        color: #721c24;
    }

    /* Checkbox switch */
    .form-check {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-switch .form-check-input {
        width: 2.5rem;
        height: 1.25rem;
    }

    .form-check-label {
        margin: 0;
        font-weight: 500;
        color: #2d3748;
    }

    /* Audit Information Section */
    .audit-info {
        background: #f8f9fa;
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        padding: 1.5rem;
    }

    .audit-info-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .audit-info-row:last-child {
        margin-bottom: 0;
    }

    .audit-info-item {
        display: flex;
        flex-direction: column;
    }

    .audit-info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.375rem;
    }

    .audit-info-value {
        font-size: 0.875rem;
        color: #2d3748;
        font-weight: 500;
    }

    /* Button group */
    .form-actions {
        display: flex;
        gap: 1rem;
        padding-top: 2rem;
        border-top: 1px solid #e3e6f0;
        margin-top: 2rem;
    }

    .btn {
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.625rem 1.5rem;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: #2C6CB0;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: #6EA8DA;
    }

    .btn-secondary {
        background: #e3e6f0;
        border: none;
        color: #2d3748;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    /* Help text */
    .form-text {
        display: block;
        font-size: 0.8125rem;
        color: #718096;
        margin-top: 0.375rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-container {
            max-width: 100%;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-header-buttons {
            width: 100%;
        }

        .form-header-buttons > * {
            flex: 1;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-row.two-col {
            grid-template-columns: 1fr;
        }

        .audit-info-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions > * {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <!-- Page Header -->
    <div class="form-header">
        <div class="form-header-title">
            <i class="bi bi-shop"></i>
            <span>Edit Curing Booth</span>
        </div>
        <div class="form-header-buttons">
            <a href="{{ route('booths.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('booths.update', $booth) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="form-group-section">
                <label class="form-section-title">
                    <i class="bi bi-info-circle"></i> Basic Information
                </label>

                <div class="form-row full">
                    <div>
                        <label class="form-label" for="curing_booth">
                            Booth Name <span style="color: #dc3545;">*</span>
                        </label>
                        <input
                            type="text"
                            id="curing_booth"
                            name="curing_booth"
                            class="form-control @error('curing_booth') is-invalid @enderror"
                            placeholder="e.g., Booth A, Booth 1"
                            value="{{ old('curing_booth', $booth->curing_booth) }}"
                            required
                        >
                        @error('curing_booth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Enter a unique name for the curing booth</small>
                    </div>
                </div>
            </div>

            <!-- Status Section -->
            <div class="form-group-section">
                <label class="form-section-title">
                    <i class="bi bi-toggle2-on"></i> Status
                </label>

                <div class="form-row full">
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $booth->is_active) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>
            </div>

            <!-- Audit Information Section -->
            <div class="form-group-section">
                <label class="form-section-title">
                    <i class="bi bi-clock-history"></i> Audit Information
                </label>

                <div class="audit-info">
                    <div class="audit-info-row">
                        <div class="audit-info-item">
                            <span class="audit-info-label">Created By</span>
                            <span class="audit-info-value">
                                {{ $booth->creator ? $booth->creator->name : 'System' }}
                            </span>
                        </div>
                        <div class="audit-info-item">
                            <span class="audit-info-label">Created At</span>
                            <span class="audit-info-value">
                                {{ $booth->created_at->format('d M Y H:i:s') }}
                            </span>
                        </div>
                    </div>
                    <div class="audit-info-row">
                        <div class="audit-info-item">
                            <span class="audit-info-label">Last Updated By</span>
                            <span class="audit-info-value">
                                {{ $booth->updater ? $booth->updater->name : 'Not yet updated' }}
                            </span>
                        </div>
                        <div class="audit-info-item">
                            <span class="audit-info-label">Last Updated At</span>
                            <span class="audit-info-value">
                                {{ $booth->updated_at->format('d M Y H:i:s') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Booth
                </button>
                <a href="{{ route('booths.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        const boothName = document.getElementById('curing_booth').value.trim();
        const isActive = document.getElementById('is_active').checked;

        Swal.fire({
            title: 'Confirm Update',
            html: `<p>Update curing booth to:</p><strong>${boothName}</strong><p style="margin-top: 0.5rem; font-size: 0.875rem; color: #718096;">Status: ${isActive ? 'Active' : 'Inactive'}</p>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#2C6CB0',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });

        e.preventDefault();
    });
</script>
@endsection
