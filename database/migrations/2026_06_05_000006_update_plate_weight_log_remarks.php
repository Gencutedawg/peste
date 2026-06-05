<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->dropColumn('weight_remarks');
            $table->unsignedBigInteger('weight_remark_id')->nullable()->after('plate_quality_status_id');
            $table->foreign('weight_remark_id')
                ->references('id')
                ->on('weight_remarks')
                ->onDelete('setNull');
        });
    }

    public function down(): void
    {
        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->dropForeign(['weight_remark_id']);
            $table->dropColumn('weight_remark_id');
            $table->string('weight_remarks', 255)->nullable();
        });
    }
};

