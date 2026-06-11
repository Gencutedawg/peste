<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $weightLogs = \DB::table('plate_weight_log')
            ->whereNull('operator_name')
            ->orWhereNull('production_line_name')
            ->orWhereNull('shift_name')
            ->orWhereNull('plate_code')
            ->get();

        foreach ($weightLogs as $log) {
            $updates = [];

            if (is_null($log->operator_name)) {
                $user = \DB::table('users')->find($log->user_id);
                if ($user) {
                    $updates['operator_name'] = $user->first_name && $user->last_name
                        ? $user->first_name . ' ' . $user->last_name
                        : $user->name;
                }
            }

            if (is_null($log->production_line_name)) {
                $line = \DB::table('production_line')->find($log->production_line_id);
                if ($line) {
                    $updates['production_line_name'] = $line->line_name;
                }
            }

            if (is_null($log->shift_name)) {
                $shift = \DB::table('time_shift')->find($log->time_shift_id);
                if ($shift) {
                    $updates['shift_name'] = $shift->shift_name;
                }
            }

            if (is_null($log->plate_code)) {
                $plate = \DB::table('plate_specification')->find($log->plate_specification_id);
                if ($plate) {
                    $updates['plate_code'] = $plate->plate_code;
                }
            }

            if (!empty($updates)) {
                \DB::table('plate_weight_log')
                    ->where('id', $log->id)
                    ->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('plate_weight_log')
            ->update([
                'operator_name' => null,
                'production_line_name' => null,
                'shift_name' => null,
                'plate_code' => null
            ]);
    }
};
