@extends('layouts.operator')

@section('title', 'Operator Dashboard')

@section('styles')
<style>
    .stat-card {
        background: white;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .stat-icon.icon-tasks {
        background: rgba(44, 108, 176, 0.1);
        color: #2C6CB0;
    }

    .stat-icon.icon-completed {
        background: rgba(106, 168, 218, 0.1);
        color: #6EA8DA;
    }

    .stat-icon.icon-pending {
        background: rgba(29, 53, 87, 0.1);
        color: #1D3557;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #1D3557;
        margin: 0;
    }

    .stat-label {
        font-size: 14px;
        color: #6c757d;
        margin: 0;
        margin-top: 4px;
        font-weight: 500;
    }

    .welcome-section {
        background: white;
        border-radius: 12px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .welcome-title {
        font-size: 32px;
        font-weight: 700;
        color: #1D3557;
        margin: 0 0 8px 0;
    }

    .welcome-subtitle {
        font-size: 16px;
        color: #6c757d;
        margin: 0;
    }
</style>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="welcome-section mb-4">
    <h1 class="welcome-title">Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name }}! 👋</h1>
    <p class="welcome-subtitle">You're logged in as <strong>{{ ucfirst(Auth::user()->role) }}</strong>. Here's your dashboard overview.</p>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <!-- Total Tasks Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">0</p>
                    <p class="stat-label">Total Tasks</p>
                </div>
                <div class="stat-icon icon-tasks">
                    <i class="bi bi-clipboard-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Tasks Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">0</p>
                    <p class="stat-label">Completed Tasks</p>
                </div>
                <div class="stat-icon icon-completed">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Tasks Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">0</p>
                    <p class="stat-label">Pending Tasks</p>
                </div>
                <div class="stat-icon icon-pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0">Dashboard Overview</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Welcome to your operator dashboard. More features coming soon!</p>
            </div>
        </div>
    </div>
</div>
@endsection
