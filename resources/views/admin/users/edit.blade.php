@extends('layouts.admin')

@section('title', 'Edit User - ' . $user->name)

@section('styles')
<style>
    /* Modern SaaS Form Design */
    .form-container {
        max-width: 750px;
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
        margin-bottom: 1.75rem;
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

    /* Two-column grid */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .form-row.full {
        grid-template-columns: 1fr;
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
    }

    /* Info alert */
    .info-box {
        background-color: #f0f7ff;
        border: 1px solid #b3d9ff;
        border-radius: 6px;
        padding: 1rem;
        margin-bottom: 1.75rem;
    }

    .info-box-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #0c5aa0;
        display: block;
        margin-bottom: 0.5rem;
    }

    .info-box-content {
        font-size: 0.8125rem;
        color: #0c5aa0;
        line-height: 1.5;
    }

    .info-box-content strong {
        font-weight: 600;
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
            <a href="{{ route('users.index') }}" style="color: #2C6CB0; text-decoration: none;">Users</a>
            <span class="breadcrumb-sep">/</span>
            <span>Edit User</span>
        </div>
        <div class="form-header-buttons">
            <a href="{{ route('users.index') }}" class="btn-secondary">
                <i class="bi bi-x"></i>Cancel
            </a>
            <button type="submit" form="editUserForm" class="btn-primary">
                <i class="bi bi-check"></i>Update User
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('users.update', $user) }}" method="POST" id="editUserForm">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="form-group-section">
                <span class="form-section-title">Personal Information</span>

                <div class="form-row">
                    <div>
                        <label for="first_name" class="form-label">
                            First Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                               id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                               id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}">
                        @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="last_name" class="form-label">
                            Last Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                               id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="name" class="form-label">
                            Full Name (Display)
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Account Information -->
            <div class="form-group-section">
                <span class="form-section-title">Account Information</span>

                <div class="form-row">
                    <div>
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Required for admin accounts</small>
                    </div>
                    <div>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               id="username" name="username" value="{{ old('username', $user->username) }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Optional for operators</small>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="role" class="form-label">
                            Role
                            <span class="required">*</span>
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">-- Select Role --</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="is_active" class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                {{ old('is_active', $user->is_active) ? 'Active' : 'Inactive' }}
                            </label>
                        </div>
                        @error('is_active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="form-group-section">
                <span class="form-section-title">Security</span>

                <div class="form-row full">
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Leave blank to keep current password. Minimum 8 characters if changing.</small>
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="info-box">
                <span class="info-box-title"><i class="bi bi-info-circle" style="margin-right: 0.5rem;"></i>Account Information</span>
                <div class="info-box-content">
                    <div><strong>Created:</strong> {{ $user->created_at->format('d M Y H:i:s') }} @if($user->creator)by <strong>{{ $user->creator->name }}</strong>@else by <strong>System</strong>@endif</div>
                    <div style="margin-top: 0.5rem;"><strong>Last Updated:</strong> {{ $user->updated_at->format('d M Y H:i:s') }} @if($user->updater)by <strong>{{ $user->updater->name }}</strong>@endif</div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
