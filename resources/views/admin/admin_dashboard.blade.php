@extends('layouts.admin')

@section('title', 'Admin Dashboard')

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

    .stat-icon.icon-users {
        background: rgba(44, 108, 176, 0.1);
        color: #2C6CB0;
    }

    .stat-icon.icon-active {
        background: rgba(106, 168, 218, 0.1);
        color: #6EA8DA;
    }

    .stat-icon.icon-admin {
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

    .action-card {
        background: white;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .action-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .action-card-header {
        padding: 30px 24px;
        background: linear-gradient(135deg, rgba(44, 108, 176, 0.1), rgba(106, 168, 218, 0.05));
        border-bottom: 1px solid #f0f0f0;
    }

    .action-card-icon {
        font-size: 48px;
        margin-bottom: 12px;
    }

    .action-card-title {
        font-size: 18px;
        font-weight: 600;
        color: #1D3557;
        margin: 0;
    }

    .action-card-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .action-card-description {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .action-card-footer {
        padding-top: 12px;
        border-top: 1px solid #f0f0f0;
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

    .recent-users-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .recent-users-header {
        padding: 24px;
        background: linear-gradient(135deg, rgba(44, 108, 176, 0.1), rgba(106, 168, 218, 0.05));
        border-bottom: 1px solid #f0f0f0;
    }

    .recent-users-header h5 {
        font-size: 18px;
        font-weight: 600;
        color: #1D3557;
        margin: 0;
    }

    .user-row {
        padding: 16px 24px;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease;
    }

    .user-row:last-child {
        border-bottom: none;
    }

    .user-row:hover {
        background-color: #f8f9fa;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-details {
        flex-grow: 1;
    }

    .user-name {
        font-weight: 600;
        color: #1D3557;
        font-size: 14px;
        margin: 0;
    }

    .user-email {
        font-size: 13px;
        color: #6c757d;
        margin: 4px 0 0 0;
    }

    .coming-soon-badge {
        display: inline-block;
        background: #f8f9fa;
        color: #6c757d;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="welcome-section mb-4">
    <h1 class="welcome-title">Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name }}! 👋</h1>
    <p class="welcome-subtitle">You're logged in as <strong>{{ ucfirst(Auth::user()->role) }}</strong>. Here's what's happening in your system today.</p>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <!-- Total Users Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">{{ \App\Models\User::count() }}</p>
                    <p class="stat-label">Total Users</p>
                </div>
                <div class="stat-icon icon-users">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Users Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">{{ \App\Models\User::where('is_active', 1)->count() }}</p>
                    <p class="stat-label">Active Users</p>
                </div>
                <div class="stat-icon icon-active">
                    <i class="bi bi-person-check-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Admins Card -->
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="stat-card p-4">
            <div class="d-flex align-items-start justify-content-between">
                <div>
                    <p class="stat-number">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                    <p class="stat-label">Admin Users</p>
                </div>
                <div class="stat-icon icon-admin">
                    <i class="bi bi-shield-check-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Management Section -->
<div class="row mb-4">
    <!-- User Management Card -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="action-card">
            <div class="action-card-header">
                <div class="action-card-icon" style="color: #2C6CB0;">
                    <i class="bi bi-people"></i>
                </div>
                <p class="action-card-title">User Management</p>
            </div>
            <div class="action-card-body">
                <p class="action-card-description">Manage all system users, roles, and permissions</p>
                <div class="action-card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-right"></i> Manage Users
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Plate Type Management Card -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="action-card">
            <div class="action-card-header">
                <div class="action-card-icon" style="color: #6EA8DA;">
                    <i class="bi bi-layers"></i>
                </div>
                <p class="action-card-title">Plate Types</p>
            </div>
            <div class="action-card-body">
                <p class="action-card-description">Manage and configure different plate specifications</p>
                <div class="action-card-footer">
                    <a href="{{ route('plates.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-right"></i> Manage Plates
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SPC Report Card -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="action-card">
            <div class="action-card-header">
                <div class="action-card-icon" style="color: #2C6CB0;">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </div>
                <p class="action-card-title">SPC Reports</p>
            </div>
            <div class="action-card-body">
                <p class="action-card-description">View and analyze SPC reports and data</p>
                <div class="action-card-footer">
                    <span class="coming-soon-badge">Coming Soon</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users Section -->
<div class="row">
    <div class="col-12">
        <div class="recent-users-card">
            <div class="recent-users-header">
                <h5>Recent Users <span style="font-size: 12px; color: #6c757d; font-weight: 400;">(Last 8 added)</span></h5>
            </div>
            <div>
                @forelse(\App\Models\User::latest()->take(8)->get() as $user)
                    <div class="user-row">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user-info">
                                <div class="user-avatar" style="width: 40px; height: 40px; font-size: 14px;">
                                    {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <p class="user-name">{{ $user->first_name ? $user->first_name . ' ' . $user->last_name : $user->name }}</p>
                                    <p class="user-email">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <div>
                                    @if($user->role === 'admin')
                                        <span class="badge badge-admin">Admin</span>
                                    @else
                                        <span class="badge badge-moderator">Operator</span>
                                    @endif
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 12px;">{{ $user->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="user-row text-center text-muted py-5">
                        <i class="bi bi-inbox" style="font-size: 32px; color: #ccc;"></i>
                        <p class="mt-2">No users found</p>
                    </div>
                @endforelse
            </div>
            <div style="padding: 16px 24px; border-top: 1px solid #f0f0f0;">
                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-right"></i> View All Users
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

