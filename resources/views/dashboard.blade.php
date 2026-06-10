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



