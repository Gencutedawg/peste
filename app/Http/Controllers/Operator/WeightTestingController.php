<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PlateWeightLog;
use App\Models\PlateSpecification;
use App\Models\ProductionLine;
use App\Models\TimeShift;
use App\Models\RunType;
use App\Models\PlateQualityStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WeightTestingController extends Controller
{
    public function index()
    {
        $runTypes = RunType::where('is_active', 1)->get();
        $plateSpecifications = PlateSpecification::where('is_active', 1)->get();
        $shifts = TimeShift::where('is_active', 1)->get();
        $lines = ProductionLine::where('is_active', 1)->get();
        $remarks = \App\Models\WeightRemarks::where('is_active', 1)->get();

        return view('operator.testing.weight', compact(
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
                'op_w01' => 'nullable|numeric|min:0',
                'op_w02' => 'nullable|numeric|min:0',
                'op_w03' => 'nullable|numeric|min:0',
                'op_w04' => 'nullable|numeric|min:0',
                'nop_w01' => 'nullable|numeric|min:0',
                'nop_w02' => 'nullable|numeric|min:0',
                'nop_w03' => 'nullable|numeric|min:0',
                'nop_w04' => 'nullable|numeric|min:0',
                'weight_remark_id' => 'nullable|exists:weight_remarks,id',
            ]);

            $plate = PlateSpecification::findOrFail($validated['plate_specification_id']);

            $weights = [
                $validated['op_w01'] ?? null,
                $validated['op_w02'] ?? null,
                $validated['op_w03'] ?? null,
                $validated['op_w04'] ?? null,
                $validated['nop_w01'] ?? null,
                $validated['nop_w02'] ?? null,
                $validated['nop_w03'] ?? null,
                $validated['nop_w04'] ?? null,
            ];

            $weights = array_filter($weights, fn($w) => !is_null($w));
            $hasFail = false;

            foreach ($weights as $weight) {
                if ($weight < $plate->weight_lsl || $weight > $plate->weight_usl) {
                    $hasFail = true;
                    break;
                }
            }

            $statusId = $hasFail ? 2 : 1;

            $log = PlateWeightLog::create([
                'production_line_id' => $validated['production_line_id'],
                'user_id' => Auth::id(),
                'time_shift_id' => $validated['time_shift_id'],
                'plate_specification_id' => $validated['plate_specification_id'],
                'run_type_id' => $validated['run_type_id'],
                'weight_date_log' => Carbon::now()->toDateString(),
                'weight_time_log' => Carbon::now()->toTimeString(),
                'op_w1' => $validated['op_w01'] ?? null,
                'op_w2' => $validated['op_w02'] ?? null,
                'op_w3' => $validated['op_w03'] ?? null,
                'op_w4' => $validated['op_w04'] ?? null,
                'nop_w1' => $validated['nop_w01'] ?? null,
                'nop_w2' => $validated['nop_w02'] ?? null,
                'nop_w3' => $validated['nop_w03'] ?? null,
                'nop_w4' => $validated['nop_w04'] ?? null,
                'plate_quality_status_id' => $statusId,
                'weight_remark_id' => $validated['weight_remark_id'] ?? null,
                'created_by' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Weight test results saved successfully',
                'data' => $log
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Weight test save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
