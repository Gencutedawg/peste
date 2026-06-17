@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- User Management Card -->
            <a href="{{ route('users.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">User Management</h3>
                        <p class="text-gray-600 text-sm mt-1">Manage system users</p>
                    </div>
                    <i class="bi bi-people text-3xl text-blue-600"></i>
                </div>
            </a>

            <!-- Plate Management Card -->
            <a href="{{ route('plates.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Plate Specifications</h3>
                        <p class="text-gray-600 text-sm mt-1">Manage plate specs</p>
                    </div>
                    <i class="bi bi-box text-3xl text-green-600"></i>
                </div>
            </a>

            <!-- Booth Management Card -->
            <a href="{{ route('booths.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Curing Booths</h3>
                        <p class="text-gray-600 text-sm mt-1">Manage booths</p>
                    </div>
                    <i class="bi bi-bricks text-3xl text-purple-600"></i>
                </div>
            </a>

            <!-- Remarks Management Card -->
            <a href="{{ route('remarks.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Remarks Management</h3>
                        <p class="text-gray-600 text-sm mt-1">Manage test remarks</p>
                    </div>
                    <i class="bi bi-chat-dots text-3xl text-orange-600"></i>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection


