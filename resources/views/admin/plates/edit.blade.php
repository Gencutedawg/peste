@extends('layouts.admin')

@section('title', 'Edit Plate Specification')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Edit Plate Specification</h1>
    <a href="{{ route('plates.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left" style="font-size: 13px; margin-right: 6px;"></i>Back
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                <h5 class="mb-0" style="color: #1D3557; font-weight: 600;">Plate Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('plates.update', $plate) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Plate Code -->
                    <div class="mb-3">
                        <label for="plate_code" class="form-label">Plate Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('plate_code') is-invalid @enderror" 
                               id="plate_code" name="plate_code" value="{{ old('plate_code', $plate->plate_code) }}" 
                               placeholder="Enter plate code" required>
                        @error('plate_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Weight Specifications -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Weight Specifications(g)</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="weight_usl" class="form-label">Upper Specification Limit (USL)</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_usl') is-invalid @enderror" 
                                       id="weight_usl" name="weight_usl" value="{{ old('weight_usl', $plate->weight_usl) }}" placeholder="e.g., 100.00">
                                @error('weight_usl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_target" class="form-label">Target Value</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_target') is-invalid @enderror" 
                                       id="weight_target" name="weight_target" value="{{ old('weight_target', $plate->weight_target) }}" placeholder="e.g., 95.00">
                                @error('weight_target')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_lsl" class="form-label">Lower Specification Limit (LSL)</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_lsl') is-invalid @enderror" 
                                       id="weight_lsl" name="weight_lsl" value="{{ old('weight_lsl', $plate->weight_lsl) }}" placeholder="e.g., 90.00">
                                @error('weight_lsl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Thickness Specifications -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Thickness Specifications (mm)</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="thick_usl" class="form-label">Upper Specification Limit (USL)</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_usl') is-invalid @enderror" 
                                       id="thick_usl" name="thick_usl" value="{{ old('thick_usl', $plate->thick_usl) }}" placeholder="e.g., 5.00">
                                @error('thick_usl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="thick_target" class="form-label">Target Value</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_target') is-invalid @enderror" 
                                       id="thick_target" name="thick_target" value="{{ old('thick_target', $plate->thick_target) }}" placeholder="e.g., 4.75">
                                @error('thick_target')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="thick_lsl" class="form-label">Lower Specification Limit (LSL)</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_lsl') is-invalid @enderror" 
                                       id="thick_lsl" name="thick_lsl" value="{{ old('thick_lsl', $plate->thick_lsl) }}" placeholder="e.g., 4.50">
                                @error('thick_lsl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Moisture Content Specification -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Moisture Content %</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="mc_lsl" class="form-label">Lower Specification Limit (LSL)</label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('mc_lsl') is-invalid @enderror" 
                                       id="mc_lsl" name="mc_lsl" value="{{ old('mc_lsl', $plate->mc_lsl) }}" placeholder="e.g., 8.00">
                                @error('mc_lsl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status Toggle -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Status</h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $plate->is_active) ? 'checked' : '' }} style="cursor: pointer; width: 50px; height: 25px;">
                            <label class="form-check-label" for="is_active" style="margin-top: 5px;">
                                {{ old('is_active', $plate->is_active) ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                    </div>

                    <!-- Audit Information -->
                    <div class="mb-4 p-3" style="background: #f8f9fa; border-radius: 6px;">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Audit Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Created by</small>
                                <p style="margin: 0; color: #1D3557; font-weight: 500;">
                                    {{ $plate->creator ? $plate->creator->name : 'System' }}
                                </p>
                                <small class="text-muted">{{ $plate->created_at->format('d M Y H:i:s') }}</small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Last updated by</small>
                                <p style="margin: 0; color: #1D3557; font-weight: 500;">
                                    {{ $plate->updater ? $plate->updater->name : 'System' }}
                                </p>
                                <small class="text-muted">{{ $plate->updated_at->format('d M Y H:i:s') }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 pt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-check" style="font-size: 14px; margin-right: 6px;"></i>Save Changes
                        </button>
                        <a href="{{ route('plates.index') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-x" style="font-size: 14px; margin-right: 6px;"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
