<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Login - Plate Pasting Statistical Process Control</title>
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
            padding: 2rem;
            position: relative;
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
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border-radius: 12px;
            margin: 0 auto 2rem;
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

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form-wrapper {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
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

        .login-button {
            width: 100%;
            padding: 0.875rem 1.5rem;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-blue);
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            max-width: 280px;
            margin: 0 auto;
            display: block;
        }

        .login-button:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(29, 53, 87, 0.15);
        }

        .login-button:active {
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

        /* Status/Success Messages */
        .status-card {
            background-color: #D1FAE5;
            border: 1px solid #A7F3D0;
            color: #065F46;
            padding: 0.875rem 1rem;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 1.5rem;
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

            .login-button {
                max-width: 100%;
            }

            .right-heading {
                font-size: 28px;
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
                        <i class="bi bi-layers"></i>
                    </div>
                </div>

                <h1 class="login-title">PPSC</h1>
                <p class="login-subtitle">Sign in to access Plate Pasting Statistical Process Control</p>

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

                <form method="POST" action="{{ route('login.operator') }}" class="form-wrapper">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text" name="login" value="{{ old('login') }}" required autofocus autocomplete="username" class="form-control @error('login') is-invalid @enderror" placeholder="Enter your username" />
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

                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem;">
                        <label class="remember-wrapper">
                            <input type="checkbox" name="remember" class="checkbox-custom" />
                            <span class="checkbox-label">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="login-button">
                        <i class="bi bi-box-arrow-in-right" style="margin-right: 0.5rem;"></i>
                        Log In
                    </button>
                </form>

                <p style="font-size: 13px; color: var(--text-muted); margin-top: 1.5rem;">
                    Contact your administrator for access credentials.
                </p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="login-right">
            <div class="industrial-illustration"></div>
            <div class="login-right-content">
                <span class="login-status-badge">Operator Portal</span>
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
