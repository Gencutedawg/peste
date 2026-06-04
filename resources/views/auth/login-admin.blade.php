<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Plate Pasting Statistical Process Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1D3557;
            --primary-blue: #2C6CB0;
            --accent-blue: #6EA8DA;
            --off-white: #EAF2F8;
            --text-dark: #1D3557;
            --text-muted: #6B7280;
            --border-light: #D1DFE8;
            --success: #10B981;
            --warning: #F59E0B;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--off-white);
        }

        .login-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Left Panel */
        .login-left {
            flex: 1;
            background-color: var(--off-white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .login-left::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border-light);
        }

        .login-content {
            width: 100%;
            max-width: 380px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border-radius: 12px;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 12px rgba(44, 108, 176, 0.15);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--primary-blue);
        }

        .admin-badge {
            display: inline-block;
            background-color: #FEF3C7;
            color: #92400E;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .form-wrapper {
            margin-bottom: 0.75rem;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 14px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            background-color: white;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(44, 108, 176, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--primary-blue);
        }

        .password-input-wrapper {
            position: relative;
        }

        .remember-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-custom {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-blue);
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
            margin: 0;
        }

        .forgot-password {
            font-size: 14px;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .action-button {
            width: 100%;
            padding: 0.875rem 1.5rem;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            max-width: 280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-button {
            background-color: var(--primary-blue);
            color: white;
        }

        .login-button:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(29, 53, 87, 0.15);
        }

        .register-button {
            background-color: white;
            color: var(--primary-blue);
            border: 1.5px solid var(--border-light);
        }

        .register-button:hover {
            border-color: var(--primary-blue);
            background-color: #F0F7FF;
        }

        .action-button:active {
            transform: translateY(1px);
        }

        .error-message {
            background-color: #FEE2E2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        .field-error {
            color: #991B1B;
            font-size: 12px;
            margin-top: 0.35rem;
        }

        /* Right Panel */
        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #1D3557 0%, #2C6CB0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .industrial-illustration {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 800 600' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3ClinearGradient id='grad'%3E%3Cstop offset='0%25' style='stop-color:white'/%3E%3Cstop offset='100%25' style='stop-color:white'/%3E%3C/linearGradient%3E%3C/defs%3E%3C!-- Factory structure --%3E%3Crect x='150' y='300' width='30' height='200' fill='url(%23grad)' stroke='white' stroke-width='2'/%3E%3Crect x='350' y='200' width='40' height='300' fill='url(%23grad)' stroke='white' stroke-width='2'/%3E%3Crect x='550' y='250' width='35' height='250' fill='url(%23grad)' stroke='white' stroke-width='2'/%3E%3C!-- Conveyor belts --%3E%3Cline x1='100' y1='320' x2='700' y2='320' stroke='white' stroke-width='3'/%3E%3Cline x1='100' y1='340' x2='700' y2='340' stroke='white' stroke-width='2'/%3E%3C!-- Plates on conveyor --%3E%3Crect x='150' y='310' width='50' height='30' fill='url(%23grad)' stroke='white' stroke-width='1.5' opacity='0.7'/%3E%3Crect x='300' y='310' width='50' height='30' fill='url(%23grad)' stroke='white' stroke-width='1.5' opacity='0.7'/%3E%3Crect x='450' y='310' width='50' height='30' fill='url(%23grad)' stroke='white' stroke-width='1.5' opacity='0.7'/%3E%3Crect x='600' y='310' width='50' height='30' fill='url(%23grad)' stroke='white' stroke-width='1.5' opacity='0.7'/%3E%3C!-- Machinery details --%3E%3Ccircle cx='140' cy='350' r='8' fill='none' stroke='white' stroke-width='2'/%3E%3Ccircle cx='710' cy='350' r='8' fill='none' stroke='white' stroke-width='2'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            pointer-events: none;
        }

        .login-right-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
            max-width: 500px;
        }

        .right-heading {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin: 0;
            color: white;
        }

        .login-status-badge {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .status-card {
            background-color: #D1FAE5;
            border: 1px solid #A7F3D0;
            color: #065F46;
            padding: 0.875rem 1rem;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        .divider-text {
            font-size: 13px;
            color: var(--text-muted);
            margin: 0.75rem 0 0.5rem;
        }

        .motolite-info {
            background-color: #EFF6FF;
            border: 1px solid #BFD7EE;
            color: #1E40AF;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.4;
            margin-top: 0.5rem;
        }

        .motolite-info strong {
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-right {
                display: none;
            }

            .login-left {
                flex: 1;
            }

            .right-heading {
                font-size: 36px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                height: auto;
                min-height: 100vh;
            }

            .login-left {
                padding: 1.5rem;
            }

            .login-content {
                max-width: 100%;
            }

            .logo-wrapper {
                width: 64px;
                height: 64px;
                margin-bottom: 1.5rem;
            }

            .logo-icon {
                width: 32px;
                height: 32px;
                font-size: 18px;
            }

            .login-title {
                font-size: 20px;
            }

            .button-group {
                gap: 0.6rem;
            }

            .action-button {
                max-width: 100%;
            }

            .right-heading {
                font-size: 28px;
            }

            .divider-text {
                margin: 1rem 0 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Panel -->
        <div class="login-left">
            <div class="login-content">
                <div class="logo-wrapper">
                    <div class="logo-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <span class="admin-badge">Administrator</span>

                <h1 class="login-title">PPSC Admin</h1>
                <p class="login-subtitle">Manage system configuration and user access</p>

                @if (session('status'))
                    <div class="status-card">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        <strong>Authentication failed.</strong>
                        <ul style="margin: .5rem 0 0; padding-left: 1rem; font-size: 13px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.admin') }}" class="form-wrapper">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" name="login" value="{{ old('login') }}" required autofocus autocomplete="email" class="form-control @error('login') is-invalid @enderror" placeholder="admin@motolite.com" />
                        @error('login')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-input-wrapper">
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" />
                            <button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="password-toggle-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <label class="remember-wrapper">
                            <input type="checkbox" name="remember" class="checkbox-custom" />
                            <span class="checkbox-label">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="action-button login-button">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Sign In
                    </button>
                </form>

                <div class="divider-text">
                    Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-blue); text-decoration: none; font-weight: 500;">Sign up</a>
                </div>

                <div class="motolite-info">
                    <strong>Authorized Domains:</strong>
                    motolite.com email addresses and approved administrator accounts only.
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="login-right">
            <div class="industrial-illustration"></div>
            <div class="login-right-content">
                <span class="login-status-badge">Admin Portal</span>
                <h2 class="right-heading">
                    PLATE PASTING<br>
                    STATISTICAL<br>
                    PROCESS CONTROL
                </h2>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
