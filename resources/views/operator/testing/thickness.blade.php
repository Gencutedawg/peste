@extends('layouts.operator')

@section('title', 'Thickness Testing')

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
        border-left: 4px solid #2C6CB0;
    }

    .feature-item strong {
        color: #2C6CB0;
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
        <i class="bi bi-rulers"></i> Thickness Testing
    </h1>
    <p class="page-subtitle">Monitor and manage thickness testing operations for quality assurance</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <h3>Current Thickness Testing Status</h3>
            <div class="feature-grid">
                <div class="feature-item">
                    <strong>📊 Total Tests</strong>
                    <p>0 tests recorded</p>
                </div>
                <div class="feature-item">
                    <strong>✅ Passed</strong>
                    <p>0 tests passed</p>
                </div>
                <div class="feature-item">
                    <strong>❌ Failed</strong>
                    <p>0 tests failed</p>
                </div>
                <div class="feature-item">
                    <strong>⏱️ Pending</strong>
                    <p>0 tests pending</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h3>Testing Information</h3>
            <p>This section displays comprehensive thickness testing data and analytics. You can:</p>
            <ul style="color: #6c757d; line-height: 1.8;">
                <li>Record new thickness tests</li>
                <li>View historical test data</li>
                <li>Analyze thickness variations</li>
                <li>Generate test reports</li>
                <li>Set thickness thresholds and limits</li>
            </ul>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="content-card">
            <h3>Quick Actions</h3>
            <div class="d-grid gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Test
                </button>
                <button class="btn btn-outline-primary">
                    <i class="bi bi-file-earmark-pdf"></i> Download Report
                </button>
                <button class="btn btn-outline-primary">
                    <i class="bi bi-gear"></i> Settings
                </button>
            </div>
        </div>

        <div class="content-card">
            <h3>Test Specifications</h3>
            <table class="table table-sm">
                <tr>
                    <td style="color: #6c757d;">Min Thickness:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">Max Thickness:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">Target Thickness:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
                <tr>
                    <td style="color: #6c757d;">Tolerance:</td>
                    <td style="font-weight: 600; color: #1D3557;">-- mm</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
