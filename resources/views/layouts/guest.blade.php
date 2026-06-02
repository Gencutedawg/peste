<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Peste') }} - Secure Access</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #1D3557;
                --secondary: #2C6CB0;
                --accent: #6EA8DA;
                --light: #EAF2F8;
                --surface: #ffffff;
                --text: #1D3557;
                --muted: #6C7A92;
                --border: #D7E1EF;
                --danger: #D94A42;
            }

            * {
                box-sizing: border-box;
            }

            html, body {
                margin: 0;
                min-height: 100%;
                font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: linear-gradient(180deg, #F8F9FB 0%, #EAF2F8 100%);
                color: var(--text);
            }

            body {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }

            .auth-shell {
                width: 100%;
                max-width: 520px;
            }

            .auth-panel {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .brand {
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
                margin-bottom: 0.25rem;
            }

            .brand-link {
                font-size: 2rem;
                font-weight: 700;
                color: var(--primary);
                text-decoration: none;
            }

            .brand-tagline {
                font-size: 0.95rem;
                color: var(--muted);
            }

            .auth-card {
                width: 100%;
                background: var(--surface);
                border: 1px solid rgba(29, 53, 87, 0.08);
                box-shadow: 0 24px 80px rgba(29, 53, 87, 0.12);
                border-radius: 28px;
                padding: 2rem;
            }

            .card-title {
                font-size: clamp(1.75rem, 2vw, 2.25rem);
                margin: 0 0 0.5rem;
                font-weight: 700;
                line-height: 1.05;
            }

            .card-subtitle {
                margin: 0 0 1.75rem;
                color: var(--muted);
                line-height: 1.75;
                font-size: 0.98rem;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 1.25rem;
            }

            .form-label {
                font-size: 0.95rem;
                font-weight: 600;
                color: var(--primary);
            }

            .form-control {
                width: 100%;
                min-height: 48px;
                padding: 0.95rem 1rem;
                border-radius: 14px;
                border: 1px solid var(--border);
                background: #fff;
                color: var(--text);
                font-size: 1rem;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--secondary);
                box-shadow: 0 0 0 5px rgba(44, 108, 176, 0.14);
            }

            .password-input-group {
                position: relative;
                display: flex;
                align-items: center;
                width: 100%;
            }

            .password-input-group .form-control {
                width: 100%;
                padding-right: 3.5rem;
            }

            .toggle-password-btn {
                position: absolute;
                right: 0.75rem;
                top: 50%;
                transform: translateY(-50%);
                border: none;
                background: transparent;
                color: var(--muted);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2.4rem;
                height: 2.4rem;
                border-radius: 999px;
                cursor: pointer;
                transition: background 0.2s ease, color 0.2s ease;
                padding: 0;
                z-index: 1;
            }

            .toggle-password-btn:hover {
                background: rgba(44, 108, 176, 0.08);
                color: var(--secondary);
            }

            .toggle-password-btn svg {
                width: 1.25rem;
                height: 1.25rem;
            }

            .toggle-password-btn .icon-closed {
                display: none;
            }

            .toggle-password-btn.visible .icon-open {
                display: none;
            }

            .toggle-password-btn.visible .icon-closed {
                display: block;
            }

            .field-error {
                color: var(--danger);
                font-size: 0.92rem;
                margin-top: 0.45rem;
            }

            .form-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                justify-content: space-between;
                align-items: center;
                margin-top: 0.5rem;
            }

            .primary-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 48px;
                padding: 0 1.45rem;
                border-radius: 14px;
                border: none;
                background: var(--secondary);
                color: white;
                font-weight: 700;
                cursor: pointer;
                transition: transform 0.2s ease, background 0.2s ease;
            }

            .primary-btn:hover {
                background: var(--primary);
                transform: translateY(-1px);
            }

            .secondary-link {
                color: var(--secondary);
                text-decoration: none;
                font-weight: 600;
            }

            .secondary-link:hover {
                color: var(--primary);
            }

            .checkbox-wrap {
                display: inline-flex;
                align-items: center;
                gap: 0.65rem;
                font-size: 0.95rem;
                color: var(--muted);
            }

            .checkbox-wrap input {
                width: 16px;
                height: 16px;
                border-radius: 6px;
                border: 1px solid var(--border);
                accent-color: var(--secondary);
            }

            .status-card {
                padding: 1rem 1.1rem;
                border-radius: 14px;
                background: #EDF5FF;
                color: var(--primary);
                border: 1px solid rgba(44, 108, 176, 0.18);
                margin-bottom: 1.25rem;
                font-size: 0.95rem;
            }

            .error-card {
                padding: 1rem 1.1rem;
                border-radius: 14px;
                background: #FFEDED;
                color: var(--danger);
                border: 1px solid rgba(217, 74, 66, 0.16);
                margin-bottom: 1.25rem;
                font-size: 0.95rem;
            }

            .auth-footer {
                font-size: 0.92rem;
                color: var(--muted);
                text-align: center;
            }

            @media (max-width: 540px) {
                body {
                    padding: 1rem;
                }

                .auth-card {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="auth-shell">
            <div class="auth-panel">
                <div class="brand">
                    <a href="/" class="brand-link">{{ config('app.name', 'Peste') }}</a>
                    <div class="brand-tagline">Paste Management System</div>
                </div>

                <div class="auth-card">
                    {{ $slot }}
                </div>

                <div class="auth-footer">Secure access for your paste workflow.</div>
            </div>
        </div>
    </body>
</html>
