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

        if ($request->filled('date')) {
            $query->whereDate('weight_date_log', $request->date);
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

        return view('operator.alarm.weight', compact('failedTests', 'totalFailed', 'operators', 'lines', 'shifts', 'plateCodes'));
    }
}
