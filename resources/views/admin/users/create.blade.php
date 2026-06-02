@extends('layouts.admin')

@section('title', 'Create New User')

@section('styles')
<style>
    .role-toggle {
        display: flex;
        gap: 0.5rem;
    }

    .role-toggle .btn {
        flex: 1;
        border: 1px solid #2C6CB0;
        background: rgba(44, 108, 176, 0.08);
        color: #2C6CB0;
        font-weight: 600;
        transition: all 0.25s ease;
    }

    .role-toggle .btn:hover,
    .role-toggle .btn:focus {
        background: rgba(44, 108, 176, 0.16);
        color: #1D3557;
    }

    .role-toggle .btn.active {
        background: #2C6CB0;
        color: #ffffff;
        box-shadow: 0 8px 24px rgba(44, 108, 176, 0.24);
    }

    .role-toggle .btn.active:hover,
    .role-toggle .btn.active:focus {
        background: #1D3557;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">Create New User</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left" style="font-size: 13px; margin-right: 6px;"></i>Back
        </a>
    </div>

    <div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card">
            <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #e3e6f0;">
                <h5 class="mb-0" style="color: #1D3557; font-weight: 600;">User Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">User Role <span class="text-danger">*</span></label>
                        <div class="btn-group role-toggle" role="group" aria-label="User role">
                            <button type="button" class="btn {{ old('role', 'admin') === 'admin' ? 'active' : '' }}" data-role="admin">Admin</button>
                            <button type="button" class="btn {{ old('role') === 'operator' ? 'active' : '' }}" data-role="operator">Operator</button>
                        </div>
                        <input type="hidden" name="role" id="role" value="{{ old('role', 'admin') }}">
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                               id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror" 
                               id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                        @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted d-block mt-2">
                            Optional.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                               id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" id="emailField" style="{{ old('role', 'admin') === 'operator' ? 'display:none;' : '' }}">
                        <label for="email" class="form-label">Email Address <span class="text-danger">{{ old('role', 'admin') === 'admin' ? '*' : '' }}</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" {{ old('role', 'admin') === 'admin' ? 'required' : '' }}>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted d-block mt-2">
                            Only needed for admin accounts. Operators can be created without email.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted d-block mt-2">
                            Required. Operators can use this field to login instead of email.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted d-block mt-2">
                            Password must be at least 8 characters long
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-3 justify-content-end">
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-check" style="font-size: 14px; margin-right: 6px;"></i>Create User
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 14px;">
                            <i class="bi bi-x" style="font-size: 14px; margin-right: 6px;"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    function updateEmailField(role) {
        const emailField = document.getElementById('emailField');
        const emailInput = document.getElementById('email');
        const label = emailField.querySelector('label');

        if (role === 'operator') {
            emailField.style.display = 'none';
            emailInput.removeAttribute('required');
            label.innerHTML = 'Email Address';
        } else {
            emailField.style.display = '';
            emailInput.setAttribute('required', 'required');
            label.innerHTML = 'Email Address <span class="text-danger">*</span>';
        }
    }

    function updateRoleSelection(role) {
        document.getElementById('role').value = role;
        document.querySelectorAll('[data-role]').forEach((button) => {
            button.classList.toggle('active', button.dataset.role === role);
        });
        updateEmailField(role);
    }

    document.querySelectorAll('[data-role]').forEach((button) => {
        button.addEventListener('click', () => updateRoleSelection(button.dataset.role));
    });

    document.addEventListener('DOMContentLoaded', () => {
        updateRoleSelection(document.getElementById('role').value || 'admin');
    });
</script>
@endsection
