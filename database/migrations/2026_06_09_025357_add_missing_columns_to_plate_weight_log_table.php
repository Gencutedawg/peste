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
        // The base create_plate_weight_log_table migration already defines
        // created_by/updated_by/is_active. This migration only needs to add
        // them on databases that were created before that fix existed.
        if (Schema::hasColumn('plate_weight_log', 'created_by')) {
            return;
        }

        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('weight_remark_id');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            $table->boolean('is_active')->default(true)->after('updated_by');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('plate_weight_log', 'created_by')) {
            return;
        }

        Schema::table('plate_weight_log', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'is_active']);
        });
    }
};
