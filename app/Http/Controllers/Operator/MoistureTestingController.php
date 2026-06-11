<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PlateMoistureLog;
use App\Models\PlateSpecification;
use App\Models\ProductionLine;
use App\Models\TimeShift;
use App\Models\RunType;
use App\Models\PlateQualityStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MoistureTestingController extends Controller
{
    public function index()
    {
        $runTypes = RunType::where('is_active', 1)->get();
        $plateSpecifications = PlateSpecification::where('is_active', 1)->get();
        $shifts = TimeShift::where('is_active', 1)->get();
        $lines = ProductionLine::where('is_active', 1)->get();
        $remarks = \App\Models\MoistureRemarks::where('is_active', 1)->get();

        return view('operator.testing.moisture', compact(
            'runTypes',
            'plateSpecifications',
            'shifts',
            'lines',
            'remarks'
        ));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'production_line_id' => 'required|exists:production_line,id',
                'time_shift_id' => 'required|exists:time_shift,id',
                'plate_specification_id' => 'required|exists:plate_specification,id',
                'run_type_id' => 'required|exists:run_type,id',
                'mc_result' => 'required|numeric|min:0',
                'moisture_remark_id' => 'nullable|exists:moisture_remarks,id',
            ]);

            $plate = PlateSpecification::findOrFail($validated['plate_specification_id']);
            $productionLine = ProductionLine::findOrFail($validated['production_line_id']);
            $shift = TimeShift::findOrFail($validated['time_shift_id']);
            $runType = RunType::findOrFail($validated['run_type_id']);

            $mcResult = floatval($validated['mc_result']);
            $hasFail = $mcResult < $plate->mc_lsl;

            $statusId = $hasFail ? 2 : 1;
            $qualityStatus = PlateQualityStatus::findOrFail($statusId);

            $remarkName = null;
            if ($validated['moisture_remark_id']) {
                $remark = \App\Models\MoistureRemarks::findOrFail($validated['moisture_remark_id']);
                $remarkName = $remark->remark_name;
            }

            $philippineTime = Carbon::now('Asia/Manila');

            $log = PlateMoistureLog::create([
                'production_line_id' => $validated['production_line_id'],
                'production_line_name' => $productionLine->line_name,
                'user_id' => Auth::id(),
                'operator_name' => Auth::user()->first_name ? Auth::user()->first_name . ' ' . Auth::user()->last_name : Auth::user()->name,
                'time_shift_id' => $validated['time_shift_id'],
                'shift_name' => $shift->shift_name,
                'plate_specification_id' => $validated['plate_specification_id'],
                'plate_code' => $plate->plate_code,
                'run_type_id' => $validated['run_type_id'],
                'run_type_name' => $runType->run_type_name,
                'moisture_date_log' => $philippineTime->toDateString(),
                'moisture_time_log' => $philippineTime->format('H:i:s'),
                'mc_result' => $mcResult,
                'plate_quality_status_id' => $statusId,
                'quality_status_name' => $qualityStatus->status_name,
                'moisture_remark_id' => $validated['moisture_remark_id'] ?? null,
                'remark_name' => $remarkName,
                'created_by' => Auth::id(),
                'created_at' => $philippineTime,
                'updated_at' => $philippineTime,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Moisture test results saved successfully',
                'data' => $log
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Moisture test save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
