<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plate Pasting Statistical Process Control</title>
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
            max-width: 420px;
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
            margin-bottom: 0.75rem;
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .role-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .role-button {
            width: 100%;
            padding: 1.25rem;
            max-width: 280px;
            margin: 0 auto;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .operator-btn {
            background-color: var(--primary-blue);
            color: white;
        }

        .operator-btn:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(29, 53, 87, 0.15);
            text-decoration: none;
            color: white;
        }

        .admin-btn {
            background-color: white;
            color: var(--primary-blue);
            border: 1.5px solid var(--border-light);
        }

        .admin-btn:hover {
            border-color: var(--primary-blue);
            background-color: #F0F7FF;
            box-shadow: 0 4px 12px rgba(44, 108, 176, 0.1);
            text-decoration: none;
            color: var(--primary-blue);
        }

        .role-button:active {
            transform: translateY(1px);
        }

        /* Login Right Panel */
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

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-right {
                display: none;
            }

            .login-left {
                flex: 1;
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
                margin-bottom: 0.5rem;
            }

            .login-subtitle {
                font-size: 13px;
                margin-bottom: 2rem;
            }

            .role-button {
                padding: 1rem;
                font-size: 15px;
                max-width: 100%;
            }

            .role-buttons {
                gap: 0.75rem;
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

                <h1 class="login-title">PPSC Portal</h1>
                <p class="login-subtitle">Plate Pasting Statistical Process Control System</p>

                <div class="role-buttons">
                    <a href="{{ route('login.operator') }}" class="role-button operator-btn">
                        <i class="bi bi-person-check"></i>
                        Operator Login
                    </a>

                    <a href="{{ route('login.admin') }}" class="role-button admin-btn">
                        <i class="bi bi-shield-lock"></i>
                        Admin Portal
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="login-right">
            <div class="industrial-illustration"></div>
            <div class="login-right-content">
                <h2 class="right-heading">
                    PLATE PASTING<br>
                    STATISTICAL<br>
                    PROCESS CONTROL
                </h2>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
