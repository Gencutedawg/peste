@extends('layouts.operator')

@section('title', 'Thickness Alarm')

@section('styles')
<style>
    .page-header {
        background: white;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1D3557;
        margin: 0 0 8px 0;
    }

    .page-subtitle {
        font-size: 14px;
        color: #6c757d;
        margin: 0;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
    }

    .content-card h3 {
        color: #1D3557;
        margin-top: 0;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .feature-item {
        padding: 16px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #dc3545;
    }

    .feature-item strong {
        color: #dc3545;
        display: block;
        margin-bottom: 8px;
    }

    .feature-item p {
        margin: 0;
        color: #6c757d;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-exclamation-triangle"></i> Thickness Alarm
    </h1>
    <p class="page-subtitle">Monitor thickness-related alarms and alerts</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <h3>Thickness Alarm Status</h3>
            <div class="feature-grid">
                <div class="feature-item">
                    <strong>🔴 Critical Alarms</strong>
                    <p>0 active alarms</p>
                </div>
                <div class="feature-item">
                    <strong>🟡 Warnings</strong>
                    <p>0 warnings</p>
                </div>
                <div class="feature-item">
                    <strong>🟢 Normal</strong>
                    <p>System normal</p>
                </div>
                <div class="feature-item">
                    <strong>📋 Total Events</strong>
                    <p>0 events logged</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h3>Alarm Information</h3>
            <p>This section displays thickness-related alarms and alerts. You can:</p>
            <ul style="color: #6c757d; line-height: 1.8;">
                <li>View active thickness alarms</li>
                <li>Acknowledge and resolve alarms</li>
                <li>View alarm history</li>
                <li>Set alarm thresholds</li>
                <li>Configure alarm notifications</li>
            </ul>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card">
            <h3>Quick Actions</h3>
            <div class="d-grid gap-2">
                <button class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Acknowledge Alarm
                </button>
                <button class="btn btn-outline-primary">
                    <i class="bi bi-file-earmark-pdf"></i> Alarm History
                </button>
                <button class="btn btn-outline-primary">
                    <i class="bi bi-gear"></i> Settings
                </button>
            </div>
        </div>

        <div class="content-card">
            <h3>Alarm Configuration</h3>
            <table class="table table-sm">
                <tr>
                    <td style="color: #6c757d;">Alarm Status:</td>
                    <td style="font-weight: 600; color: #28a745;"><span class="badge bg-success">Active</span></td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">Low Threshold:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">High Threshold:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">Last Trigger:</td>
                    <td style="font-weight: 600; color: #1D3557;">Never</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
