<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\PlateThicknessLog;
use App\Models\PlateSpecification;
use App\Models\ProductionLine;
use App\Models\TimeShift;
use App\Models\RunType;
use App\Models\PlateQualityStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ThicknessTestingController extends Controller
{
    public function index()
    {
        $runTypes = RunType::where('is_active', 1)->get();
        $plateSpecifications = PlateSpecification::where('is_active', 1)->get();
        $shifts = TimeShift::where('is_active', 1)->get();
        $lines = ProductionLine::where('is_active', 1)->get();
        $remarks = \App\Models\ThicknessRemarks::where('is_active', 1)->get();

        return view('operator.testing.thickness', compact(
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
                'op_c1' => 'nullable|numeric|min:0',
                'op_c2' => 'nullable|numeric|min:0',
                'op_c3' => 'nullable|numeric|min:0',
                'op_c4' => 'nullable|numeric|min:0',
                'nop_c1' => 'nullable|numeric|min:0',
                'nop_c2' => 'nullable|numeric|min:0',
                'nop_c3' => 'nullable|numeric|min:0',
                'nop_c4' => 'nullable|numeric|min:0',
                'thickness_remark_id' => 'nullable|exists:thickness_remarks,id',
            ]);

            $plate = PlateSpecification::findOrFail($validated['plate_specification_id']);
            $productionLine = ProductionLine::findOrFail($validated['production_line_id']);
            $shift = TimeShift::findOrFail($validated['time_shift_id']);
            $runType = RunType::findOrFail($validated['run_type_id']);

            $thickness = [
                $validated['op_c1'] ?? null,
                $validated['op_c2'] ?? null,
                $validated['op_c3'] ?? null,
                $validated['op_c4'] ?? null,
                $validated['nop_c1'] ?? null,
                $validated['nop_c2'] ?? null,
                $validated['nop_c3'] ?? null,
                $validated['nop_c4'] ?? null,
            ];

            $thickness = array_filter($thickness, fn($t) => !is_null($t));
            $hasFail = false;

            foreach ($thickness as $value) {
                if ($value < $plate->thick_lsl || $value > $plate->thick_usl) {
                    $hasFail = true;
                    break;
                }
            }

            $statusId = $hasFail ? 2 : 1;
            $qualityStatus = PlateQualityStatus::findOrFail($statusId);

            $remarkName = null;
            if ($validated['thickness_remark_id']) {
                $remark = \App\Models\ThicknessRemarks::findOrFail($validated['thickness_remark_id']);
                $remarkName = $remark->remark_name;
            }

            $philippineTime = Carbon::now('Asia/Manila');

            $log = PlateThicknessLog::create([
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
                'thickness_date_log' => $philippineTime->toDateString(),
                'thickness_time_log' => $philippineTime->format('H:i:s'),
                'op_c1' => $validated['op_c1'] ?? null,
                'op_c2' => $validated['op_c2'] ?? null,
                'op_c3' => $validated['op_c3'] ?? null,
                'op_c4' => $validated['op_c4'] ?? null,
                'nop_c1' => $validated['nop_c1'] ?? null,
                'nop_c2' => $validated['nop_c2'] ?? null,
                'nop_c3' => $validated['nop_c3'] ?? null,
                'nop_c4' => $validated['nop_c4'] ?? null,
                'plate_quality_status_id' => $statusId,
                'quality_status_name' => $qualityStatus->status_name,
                'thickness_remark_id' => $validated['thickness_remark_id'] ?? null,
                'remark_name' => $remarkName,
                'created_by' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thickness test results saved successfully',
                'data' => $log
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Thickness test save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
