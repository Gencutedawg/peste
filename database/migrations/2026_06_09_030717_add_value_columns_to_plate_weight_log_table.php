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
        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->string('production_line_name')->nullable()->after('production_line_id');
            $table->string('shift_name')->nullable()->after('time_shift_id');
            $table->string('plate_code')->nullable()->after('plate_specification_id');
            $table->string('run_type_name')->nullable()->after('run_type_id');
            $table->string('quality_status_name')->nullable()->after('plate_quality_status_id');
            $table->string('remark_name')->nullable()->after('weight_remark_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->dropColumn([
                'production_line_name',
                'shift_name',
                'plate_code',
                'run_type_name',
                'quality_status_name',
                'remark_name'
            ]);
        });
    }
};
