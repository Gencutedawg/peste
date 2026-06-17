<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PlateMoistureLog;
use App\Models\ProductionLine;
use App\Models\TimeShift;
use App\Models\PlateSpecification;
use Illuminate\Http\Request;

class MoistureAlarmController extends Controller
{
    public function moisture(Request $request)
    {
        $query = PlateMoistureLog::where('plate_quality_status_id', 2)->with('plateSpecification', 'curingBooth');

        $fromDate = $request->filled('from_date') ? $request->from_date : null;
        $toDate = $request->filled('to_date') ? $request->to_date : null;

        if ($fromDate && !$toDate) {
            $toDate = $fromDate;
        } elseif ($toDate && !$fromDate) {
            $fromDate = $toDate;
        }

        if ($fromDate) {
            $query->whereDate('moisture_date_log', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('moisture_date_log', '<=', $toDate);
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

        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;

        $failedTests = $query->orderBy('moisture_date_log', 'desc')
            ->orderBy('moisture_time_log', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $totalFailed = PlateMoistureLog::where('plate_quality_status_id', 2)->count();

        $operators = \App\Models\User::where('role', 'operator')
            ->where('is_active', 1)
            ->orderBy('first_name')
            ->get()
            ->map(fn($u) => $u->first_name . ' ' . $u->last_name)
            ->unique()
            ->sort()
            ->values();

        $lines = ProductionLine::where('is_active', 1)
            ->orderBy('line_name')
            ->pluck('line_name')
            ->values();

        $shifts = TimeShift::where('is_active', 1)
            ->orderBy('shift_name')
            ->pluck('shift_name')
            ->values();

        $plateCodes = PlateSpecification::where('is_active', 1)
            ->orderBy('plate_code')
            ->pluck('plate_code')
            ->values();

        return view('operator.alarm.moisture', compact(
            'failedTests',
            'totalFailed',
            'operators',
            'lines',
            'shifts',
            'plateCodes',
            'activeFilters',
            'filterSummary',
            'perPage'
        ));
    }
}
