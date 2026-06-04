@extends('layouts.admin')

@section('title', 'Create New User')

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

    /* Radio button group - modern style */
    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.75rem;
    }

    .radio-option {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        border: 1px solid #e3e6f0;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.15s ease;
        background: #fff;
    }

    .radio-option:hover {
        border-color: #2C6CB0;
        background-color: #f8f9fa;
    }

    .radio-option input[type="radio"] {
        margin-right: 0.75rem;
        cursor: pointer;
        accent-color: #2C6CB0;
    }

    .radio-option-label {
        flex: 1;
        display: flex;
        flex-direction: column;
        cursor: pointer;
    }

    .radio-option-title {
        font-weight: 600;
        color: #1D3557;
        font-size: 0.9375rem;
    }

    .radio-option-desc {
        font-size: 0.8125rem;
        color: #6c757d;
        margin-top: 0.125rem;
    }

    .radio-option input[type="radio"]:checked + .radio-option-label .radio-option-title {
        color: #2C6CB0;
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

    /* Conditional sections */
    .conditional-section {
        display: none;
    }

    .conditional-section.active {
        display: block;
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
            <span>Create User</span>
        </div>
        <div class="form-header-buttons">
            <a href="{{ route('users.index') }}" class="btn-secondary">
                <i class="bi bi-x"></i>Cancel
            </a>
            <button type="submit" form="createUserForm" class="btn-primary">
                <i class="bi bi-check"></i>Create User
            </button>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
            @csrf

            <!-- Account Type Selection -->
            <div class="form-group-section">
                <label class="form-label">
                    Account Type
                    <span class="required">*</span>
                </label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="role" value="admin" {{ old('role', 'admin') === 'admin' ? 'checked' : '' }} required>
                        <div class="radio-option-label">
                            <span class="radio-option-title">Admin</span>
                            <span class="radio-option-desc">Full access with email login</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="role" value="operator" {{ old('role') === 'operator' ? 'checked' : '' }} required>
                        <div class="radio-option-label">
                            <span class="radio-option-title">Operator</span>
                            <span class="radio-option-desc">Limited access with username login</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
                               id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                               id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
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
                               id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email only for Admin -->
                    @if(old('role', 'admin') === 'admin')
                    <div id="emailField">
                        <label for="email" class="form-label">
                            Email Address
                            <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @else
                    <!-- Username only for Operator -->
                    <div id="usernameField">
                        <label for="username" class="form-label">
                            Username
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               id="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                </div>
            </div>

            <!-- Security Information -->
            <div class="form-group-section">
                <span class="form-section-title">Security</span>

                <div class="form-row">
                    <div>
                        <label for="password" class="form-label">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text">Minimum 8 characters</small>
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
        const adminRadio = document.querySelector('input[value="admin"]');
        const operatorRadio = document.querySelector('input[value="operator"]');
        const lastNameDiv = document.querySelector('input[name="last_name"]').parentElement;
        const emailInput = document.querySelector('#email');
        const usernameInput = document.querySelector('#username');
        const emailFieldDiv = emailInput ? emailInput.parentElement : null;
        const usernameFieldDiv = usernameInput ? usernameInput.parentElement : null;

        function updateFields(role) {
            const formRow = lastNameDiv.parentElement;
            
            if (role === 'admin') {
                if (usernameFieldDiv && usernameFieldDiv.parentElement === formRow) {
                    usernameFieldDiv.remove();
                }
                
                if (!document.querySelector('#emailField')) {
                    const emailField = document.createElement('div');
                    emailField.id = 'emailField';
                    emailField.innerHTML = `
                        <label for="email" class="form-label">
                            Email Address
                            <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" value="" required>
                        <div class="invalid-feedback"></div>
                    `;
                    formRow.appendChild(emailField);
                }
            } else {
                if (emailFieldDiv && emailFieldDiv.parentElement === formRow) {
                    emailFieldDiv.remove();
                }
                
                if (!document.querySelector('#usernameField')) {
                    const usernameField = document.createElement('div');
                    usernameField.id = 'usernameField';
                    usernameField.innerHTML = `
                        <label for="username" class="form-label">
                            Username
                            <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="username" name="username" value="">
                        <div class="invalid-feedback"></div>
                    `;
                    formRow.appendChild(usernameField);
                }
            }
        }

        adminRadio.addEventListener('change', () => updateFields('admin'));
        operatorRadio.addEventListener('change', () => updateFields('operator'));

        // SweetAlert confirmation for form submission
        const createUserForm = document.getElementById('createUserForm');
        const isEditForm = createUserForm.getAttribute('action').includes('update');
        
        createUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const role = document.querySelector('input[name="role"]:checked').value;
            const firstName = document.querySelector('#first_name').value;
            const middleName = document.querySelector('#middle_name').value;
            const lastName = document.querySelector('#last_name').value;
            const email = document.querySelector('#email')?.value || 'N/A';
            const username = document.querySelector('#username')?.value || 'N/A';
            const isActive = document.querySelector('#is_active')?.checked ? 'Yes' : 'No';
            
            // Build summary HTML
            let summaryHtml = `
                <div style="text-align: left; font-size: 0.95rem; line-height: 1.8;">
                    <div style="margin-bottom: 0.5rem;"><strong>Full Name:</strong> ${firstName} ${middleName ? middleName + ' ' : ''}${lastName}</div>
                    <div style="margin-bottom: 0.5rem;"><strong>Account Type:</strong> <span style="text-transform: capitalize; background: ${role === 'admin' ? '#e7f3ff' : '#f0f0f0'}; padding: 2px 8px; border-radius: 4px;">${role}</span></div>
                    ${role === 'admin' ? `<div style="margin-bottom: 0.5rem;"><strong>Email:</strong> ${email}</div>` : `<div style="margin-bottom: 0.5rem;"><strong>Username:</strong> ${username}</div>`}
                    ${isEditForm ? `<div style="margin-bottom: 0.5rem;"><strong>Status:</strong> ${isActive}</div>` : ''}
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
                    createUserForm.submit();
                }
            });
        });
    });
</script>
@endsection
