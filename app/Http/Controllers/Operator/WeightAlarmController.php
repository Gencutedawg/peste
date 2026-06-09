<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PlateWeightLog;
use Illuminate\Http\Request;

class WeightAlarmController extends Controller
{
    public function weight(Request $request)
    {
        $query = PlateWeightLog::where('plate_quality_status_id', 2);

        if ($request->filled('from_date')) {
            $query->whereDate('weight_date_log', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('weight_date_log', '<=', $request->to_date);
        }

        if ($request->filled('operator')) {
            $query->where('operator_name', $request->operator);
        }

        if ($request->filled('line')) {
            $query->where('production_line_name', $request->line);
        }

        if ($request->filled('shift')) {
            $query->where('shift_name', $request->shift);
        }

        if ($request->filled('plate_code')) {
            $query->where('plate_code', $request->plate_code);
        }

        $activeFilters = [];
        if ($request->filled('from_date') || $request->filled('to_date')) {
            $activeFilters['date'] = true;
        }
        if ($request->filled('operator')) {
            $activeFilters['operator'] = $request->operator;
        }
        if ($request->filled('line')) {
            $activeFilters['line'] = $request->line;
        }
        if ($request->filled('shift')) {
            $activeFilters['shift'] = $request->shift;
        }
        if ($request->filled('plate_code')) {
            $activeFilters['plate_code'] = $request->plate_code;
        }

        $filterSummary = [];
        if ($request->filled('shift')) {
            $filterSummary[] = $request->shift;
        }
        if ($request->filled('line')) {
            $filterSummary[] = $request->line;
        }
        if ($request->filled('operator')) {
            $filterSummary[] = $request->operator;
        }

        $failedTests = $query->orderBy('weight_date_log', 'desc')
            ->orderBy('weight_time_log', 'desc')
            ->paginate(15);

        $totalFailed = PlateWeightLog::where('plate_quality_status_id', 2)->count();

        $operators = PlateWeightLog::where('plate_quality_status_id', 2)
            ->distinct()
            ->pluck('operator_name')
            ->sort()
            ->values();

        $lines = PlateWeightLog::where('plate_quality_status_id', 2)
            ->distinct()
            ->pluck('production_line_name')
            ->sort()
            ->values();

        $shifts = PlateWeightLog::where('plate_quality_status_id', 2)
            ->distinct()
            ->pluck('shift_name')
            ->sort()
            ->values();

        $plateCodes = PlateWeightLog::where('plate_quality_status_id', 2)
            ->distinct()
            ->pluck('plate_code')
            ->sort()
            ->values();

        return view('operator.alarm.weight', compact(
            'failedTests',
            'totalFailed',
            'operators',
            'lines',
            'shifts',
            'plateCodes',
            'activeFilters',
            'filterSummary'
        ));
    }
}

