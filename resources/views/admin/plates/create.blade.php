@extends('layouts.admin')

@section('title', 'Create Plate Specification')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Create Plate Specification</h1>
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
                <form action="{{ route('plates.store') }}" method="POST">
                    @csrf

                    <!-- Plate Code -->
                    <div class="mb-4">
                        <label for="plate_code" class="form-label">Plate Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('plate_code') is-invalid @enderror" 
                               id="plate_code" name="plate_code" value="{{ old('plate_code') }}" 
                               placeholder="Enter plate code" required>
                        @error('plate_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Weight Specifications -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Weight Specifications (grams)</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="weight_usl" class="form-label">Upper Specification Limit (USL) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_usl') is-invalid @enderror" 
                                       id="weight_usl" name="weight_usl" value="{{ old('weight_usl') }}" placeholder="e.g., 100.00" required>
                                @error('weight_usl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_target" class="form-label">Target Value <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_target') is-invalid @enderror" 
                                       id="weight_target" name="weight_target" value="{{ old('weight_target') }}" placeholder="e.g., 95.00" required>
                                @error('weight_target')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_lsl" class="form-label">Lower Specification Limit (LSL) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('weight_lsl') is-invalid @enderror" 
                                       id="weight_lsl" name="weight_lsl" value="{{ old('weight_lsl') }}" placeholder="e.g., 90.00" required>
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
                                <label for="thick_usl" class="form-label">Upper Specification Limit (USL) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_usl') is-invalid @enderror" 
                                       id="thick_usl" name="thick_usl" value="{{ old('thick_usl') }}" placeholder="e.g., 5.00" required>
                                @error('thick_usl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="thick_target" class="form-label">Target Value <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_target') is-invalid @enderror" 
                                       id="thick_target" name="thick_target" value="{{ old('thick_target') }}" placeholder="e.g., 4.75" required>
                                @error('thick_target')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="thick_lsl" class="form-label">Lower Specification Limit (LSL) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('thick_lsl') is-invalid @enderror" 
                                       id="thick_lsl" name="thick_lsl" value="{{ old('thick_lsl') }}" placeholder="e.g., 4.50" required>
                                @error('thick_lsl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Moisture Content Specification -->
                    <div class="mb-4">
                        <h6 style="color: #1D3557; font-weight: 600; margin-bottom: 15px;">Moisture Content</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="mc_lsl" class="form-label">Lower Specification Limit (LSL) (%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="999.99" class="form-control @error('mc_lsl') is-invalid @enderror" 
                                       id="mc_lsl" name="mc_lsl" value="{{ old('mc_lsl') }}" placeholder="e.g., 8.00" required>
                                @error('mc_lsl')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 pt-3">
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-check" style="font-size: 14px; margin-right: 6px;"></i>Create Plate
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
