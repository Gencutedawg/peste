<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestingLogsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : Carbon::now()->endOfDay();
        $perPage = 15;

        $weightLogs = DB::table('plate_weight_log')
            ->joinSub(
                DB::table('plate_specification'),
                'plate_specification',
                function($join) {
                    $join->on(DB::raw('plate_weight_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                              DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
                },
                'left'
            )
            ->whereBetween('weight_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('weight_date_log', 'desc')
            ->orderBy('weight_time_log', 'desc')
            ->select('plate_weight_log.*', 'plate_specification.weight_lsl', 'plate_specification.weight_target', 'plate_specification.weight_usl')
            ->paginate($perPage, ['*'], 'weight_page');

        $thicknessLogs = DB::table('plate_thickness_log')
            ->joinSub(
                DB::table('plate_specification'),
                'plate_specification',
                function($join) {
                    $join->on(DB::raw('plate_thickness_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                              DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
                },
                'left'
            )
            ->whereBetween('thickness_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('thickness_date_log', 'desc')
            ->orderBy('thickness_time_log', 'desc')
            ->select('plate_thickness_log.*', 'plate_specification.thick_lsl', 'plate_specification.thick_target', 'plate_specification.thick_usl')
            ->paginate($perPage, ['*'], 'thickness_page');

        $moistureLogs = DB::table('plate_moisture_log')
            ->leftJoin('plate_specification', function($join) {
                $join->on(DB::raw('plate_moisture_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                          DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
            })
            ->whereBetween('moisture_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->orderBy('moisture_date_log', 'desc')
            ->orderBy('moisture_time_log', 'desc')
            ->select('plate_moisture_log.*', 'plate_specification.mc_lsl')
            ->paginate($perPage, ['*'], 'moisture_page');

        return view('admin.testing_logs.index', [
            'weightLogs' => $weightLogs,
            'thicknessLogs' => $thicknessLogs,
            'moistureLogs' => $moistureLogs,
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : Carbon::now()->endOfDay();
        $type = $request->query('type', 'all');

        $filename = 'testing_logs_' . $type . '_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () use ($startDate, $endDate, $type) {
            $handle = fopen('php://output', 'w');

            if ($type === 'weight' || $type === 'all') {
                if ($type === 'all') {
                    fputcsv($handle, ['WEIGHT LOG']);
                }

                $headers = ['Date', 'Time', 'Production Line', 'Operator', 'Shift', 'Run Type', 'Plate Type',
                           'Weight LSL', 'Target', 'Weight USL', 'OP W1', 'OP W2', 'OP W3', 'OP W4',
                           'NOP W1', 'NOP W2', 'NOP W3', 'NOP W4', 'Quality Status', 'Remarks'];
                fputcsv($handle, $headers);

                $logs = DB::table('plate_weight_log')
                    ->joinSub(
                        DB::table('plate_specification'),
                        'plate_specification',
                        function($join) {
                            $join->on(DB::raw('plate_weight_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                                      DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
                        },
                        'left'
                    )
                    ->whereBetween('weight_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->orderBy('weight_date_log', 'desc')
                    ->select('plate_weight_log.*', 'plate_specification.weight_lsl', 'plate_specification.weight_target', 'plate_specification.weight_usl')
                    ->get();

                foreach ($logs as $log) {
                    fputcsv($handle, [
                        $log->weight_date_log,
                        $log->weight_time_log,
                        $log->production_line_name ?? '',
                        $log->operator_name ?? '',
                        $log->shift_name ?? '',
                        $log->run_type_name ?? '',
                        $log->plate_code ?? '',
                        $log->weight_lsl ?? '',
                        $log->weight_target ?? '',
                        $log->weight_usl ?? '',
                        $log->op_w1,
                        $log->op_w2,
                        $log->op_w3,
                        $log->op_w4,
                        $log->nop_w1,
                        $log->nop_w2,
                        $log->nop_w3,
                        $log->nop_w4,
                        $log->quality_status_name ?? '',
                        $log->remark_name ?? ''
                    ]);
                }

                if ($type === 'all') {
                    fputcsv($handle, []);
                }
            }

            if ($type === 'thickness' || $type === 'all') {
                if ($type === 'all') {
                    fputcsv($handle, ['THICKNESS LOG']);
                }

                $headers = ['Date', 'Time', 'Production Line', 'Operator', 'Shift', 'Run Type', 'Plate Type',
                           'Thickness LSL', 'Target', 'Thickness USL',
                           'OP C1', 'OP C2', 'OP C3', 'OP C4', 'NOP C1', 'NOP C2', 'NOP C3', 'NOP C4',
                           'Quality Status', 'Remarks'];
                fputcsv($handle, $headers);

                $logs = DB::table('plate_thickness_log')
                    ->joinSub(
                        DB::table('plate_specification'),
                        'plate_specification',
                        function($join) {
                            $join->on(DB::raw('plate_thickness_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                                      DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
                        },
                        'left'
                    )
                    ->whereBetween('thickness_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->orderBy('thickness_date_log', 'desc')
                    ->select('plate_thickness_log.*', 'plate_specification.thick_lsl', 'plate_specification.thick_target', 'plate_specification.thick_usl')
                    ->get();

                foreach ($logs as $log) {
                    fputcsv($handle, [
                        $log->thickness_date_log,
                        $log->thickness_time_log,
                        $log->production_line_name ?? '',
                        $log->operator_name ?? '',
                        $log->shift_name ?? '',
                        $log->run_type_name ?? '',
                        $log->plate_code ?? '',
                        $log->thick_lsl ?? '',
                        $log->thick_target ?? '',
                        $log->thick_usl ?? '',
                        $log->op_c1,
                        $log->op_c2,
                        $log->op_c3,
                        $log->op_c4,
                        $log->nop_c1,
                        $log->nop_c2,
                        $log->nop_c3,
                        $log->nop_c4,
                        $log->quality_status_name ?? '',
                        $log->remark_name ?? ''
                    ]);
                }

                if ($type === 'all') {
                    fputcsv($handle, []);
                }
            }

            if ($type === 'moisture' || $type === 'all') {
                if ($type === 'all') {
                    fputcsv($handle, ['MOISTURE LOG']);
                }

                $headers = ['Date', 'Time', 'Production Line', 'Operator', 'Shift', 'Plate Code', 'Run Type',
                           'MC LSL', 'MC Result', 'Quality Status', 'Remarks'];
                fputcsv($handle, $headers);

                $logs = DB::table('plate_moisture_log')
                    ->leftJoin('plate_specification', function($join) {
                        $join->on(DB::raw('plate_moisture_log.plate_code COLLATE utf8mb4_unicode_ci'), '=',
                                  DB::raw('plate_specification.plate_code COLLATE utf8mb4_unicode_ci'));
                    })
                    ->whereBetween('moisture_date_log', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->orderBy('moisture_date_log', 'desc')
                    ->select('plate_moisture_log.*', 'plate_specification.mc_lsl')
                    ->get();

                foreach ($logs as $log) {
                    fputcsv($handle, [
                        $log->moisture_date_log,
                        $log->moisture_time_log,
                        $log->production_line_name ?? '',
                        $log->operator_name ?? '',
                        $log->shift_name ?? '',
                        $log->plate_code ?? '',
                        $log->run_type_name ?? '',
                        $log->mc_lsl ?? '',
                        $log->mc_result,
                        $log->quality_status_name ?? '',
                        $log->remark_name ?? ''
                    ]);
                }
            }

            fclose($handle);
        }, $filename);
    }
}

