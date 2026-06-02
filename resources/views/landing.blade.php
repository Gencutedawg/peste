<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peste - Paste Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1D3557;
            --secondary: #2C6CB0;
            --accent: #6EA8DA;
            --light: #EAF2F8;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: var(--primary);
            background-color: #f8f9fa;
        }

        /* Navigation */
        .navbar {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--primary) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary) !important;
        }

        .btn-primary {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: white;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary {
            color: var(--secondary);
            border-color: var(--secondary);
            font-weight: 600;
        }

        .btn-outline-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        /* Hero Section */
        .hero {
            background-color: var(--light);
            padding: 5rem 0;
            border-bottom: 1px solid #dae8f0;
        }

        .hero h1 {
            color: var(--primary);
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero p {
            color: #555;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Feature Cards */
        .feature-card {
            background-color: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(110, 168, 218, 0.15);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background-color: var(--light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--secondary);
            font-size: 1.5rem;
        }

        .feature-card h5 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .feature-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            background-color: var(--primary);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: rgba(255, 255, 255, 0.8);
            padding: 3rem 0 1rem;
        }

        footer h6 {
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        .footer-top {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 2rem;
            margin-bottom: 1.5rem;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1rem;
            font-size: 0.85rem;
            opacity: 0.7;
        }

        /* Sections */
        .section {
            padding: 4rem 0;
        }

        .section h2 {
            color: var(--primary);
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section h2 {
                font-size: 1.75rem;
            }

            .cta-section h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-paste"></i> Peste
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1>Welcome to Peste</h1>
                    <p class="mb-4">A modern paste management system for sharing, storing, and organizing your code snippets and text.</p>
                    @guest
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Sign In</a>
                        </div>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Open Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section bg-white">
        <div class="container">
            <h2>Features</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <h5>Easy Management</h5>
                        <p>Organize and manage your pastes with intuitive controls and powerful search capabilities.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Secure & Private</h5>
                        <p>Your data is protected with enterprise-grade security and privacy controls.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5>Lightning Fast</h5>
                        <p>Lightning-quick performance with optimized queries and efficient data handling.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>Ready to get started?</h2>
                    <p>Join our community of developers managing their code snippets with Peste.</p>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg" style="color: var(--primary);">Create Free Account</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg" style="color: var(--primary);">Open Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-top">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <h6><i class="fas fa-paste"></i> Peste</h6>
                        <p style="font-size: 0.9rem;">Professional paste management for developers.</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h6>Product</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Documentation</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h6>Company</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h6>Legal</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Security</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Peste. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
