@extends('layouts.admin')

@section('title', 'Testing Logs')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Testing Logs</h1>

            <!-- Filters -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" id="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $startDate }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" id="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $endDate }}">
                    </div>
                    <div class="flex items-end gap-2">
                        <button onclick="applyFilter()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                            <i class="bi bi-search mr-2"></i> Filter
                        </button>
                    </div>
                    <div class="flex items-end gap-2">
                        <button onclick="resetFilter()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg">
                            <i class="bi bi-arrow-clockwise mr-2"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px space-x-8" role="tablist">
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm active" data-tab="weight-tab">
                        <span class="text-blue-600 border-blue-600">Weight Log ({{ $weightLogs->total() }})</span>
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm" data-tab="thickness-tab">
                        <span class="text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300">Thickness Log ({{ $thicknessLogs->total() }})</span>
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 font-medium text-sm" data-tab="moisture-tab">
                        <span class="text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300">Moisture Log ({{ $moistureLogs->total() }})</span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Weight Log Tab -->
        <div id="weight-tab" class="tab-content">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Weight Testing Log</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Line</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Run Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Plate Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">LSL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Target</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">USL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">W1-W4</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($weightLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $log->weight_date_log }} {{ $log->weight_time_log }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->production_line_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->operator_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->shift_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->run_type_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->plate_code ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->weight_lsl ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->weight_target ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->weight_usl ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="font-mono text-xs">{{ $log->op_w1 ?? '-' }}/{{ $log->op_w2 ?? '-' }}/{{ $log->op_w3 ?? '-' }}/{{ $log->op_w4 ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->quality_status_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->remark_name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No weight logs found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Export -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            {{ $weightLogs->render('pagination.tailwind', ['pageName' => 'weight_page']) }}
                        </div>
                        <div class="flex gap-2 justify-end">
                            <button onclick="exportData('csv', 'weight')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded-lg text-sm flex items-center">
                                <i class="bi bi-download mr-1"></i> CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thickness Log Tab -->
        <div id="thickness-tab" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Thickness Testing Log</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Line</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Run Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Plate Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">LSL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Target</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">USL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">OP C1-C4</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">NOP C1-C4</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($thicknessLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $log->thickness_date_log }} {{ $log->thickness_time_log }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->production_line_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->operator_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->shift_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->run_type_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->plate_code ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->thick_lsl ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->thick_target ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->thick_usl ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="font-mono text-xs">{{ $log->op_c1 ?? '-' }}/{{ $log->op_c2 ?? '-' }}/{{ $log->op_c3 ?? '-' }}/{{ $log->op_c4 ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="font-mono text-xs">{{ $log->nop_c1 ?? '-' }}/{{ $log->nop_c2 ?? '-' }}/{{ $log->nop_c3 ?? '-' }}/{{ $log->nop_c4 ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->quality_status_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->remark_name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No thickness logs found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Export -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            {{ $thicknessLogs->render('pagination.tailwind', ['pageName' => 'thickness_page']) }}
                        </div>
                        <div class="flex gap-2 justify-end">
                            <button onclick="exportData('csv', 'thickness')" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-3 rounded-lg text-sm flex items-center">
                                <i class="bi bi-download mr-1"></i> CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Moisture Log Tab -->
        <div id="moisture-tab" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Moisture Testing Log</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Line</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Operator</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Shift</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Plate</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Run Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">MC LSL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">MC Result</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($moistureLogs as $log)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $log->moisture_date_log }} {{ $log->moisture_time_log }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->production_line_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->operator_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->shift_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->plate_code ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->run_type_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->mc_lsl ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 font-mono">{{ $log->mc_result ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->quality_status_name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $log->remark_name ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                                        <i class="bi bi-inbox text-2xl mb-2 block opacity-50"></i>
                                        No moisture logs found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and Export -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex-1">
                            {{ $moistureLogs->render('pagination.tailwind', ['pageName' => 'moisture_page']) }}
                        </div>
                        <div class="flex gap-2 justify-end">
                            <button onclick="exportData('csv', 'moisture')" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-3 rounded-lg text-sm flex items-center">
                                <i class="bi bi-download mr-1"></i> CSV
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const tabButtons = document.querySelectorAll('.tab-button');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(b => {
                b.querySelector('span').classList.remove('text-blue-600', 'border-blue-600');
                b.querySelector('span').classList.add('text-gray-500', 'border-transparent');
            });
            document.getElementById(tabId).classList.remove('hidden');
            this.querySelector('span').classList.add('text-blue-600', 'border-blue-600');
            this.querySelector('span').classList.remove('text-gray-500', 'border-transparent');
        });
    });

    function applyFilter() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
            alert('Please select both start and end dates');
            return;
        }

        const params = new URLSearchParams();
        params.append('start_date', startDate);
        params.append('end_date', endDate);
        window.location.href = '{{ route("testing-logs.index") }}?' + params.toString();
    }

    function resetFilter() {
        window.location.href = '{{ route("testing-logs.index") }}';
    }

    function exportData(format, type) {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
            alert('Please select both start and end dates');
            return;
        }

        const params = new URLSearchParams();
        params.append('start_date', startDate);
        params.append('end_date', endDate);
        params.append('type', type);

        window.location.href = '{{ route("testing-logs.export-csv") }}?' + params.toString();
    }
</script>
@endsection
