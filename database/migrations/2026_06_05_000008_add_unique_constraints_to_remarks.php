<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        try {
            Schema::table('weight_remarks', function (Blueprint $table) {
                $table->unique('remark_name', 'uk_weight_remark_name');
            });
        } catch (\Exception $e) {
            // Index might already exist
        }

        try {
            Schema::table('thickness_remarks', function (Blueprint $table) {
                $table->unique('remark_name', 'uk_thickness_remark_name');
            });
        } catch (\Exception $e) {
            // Index might already exist
        }
    }

    public function down(): void
    {
        Schema::table('weight_remarks', function (Blueprint $table) {
            $table->dropUnique('uk_weight_remark_name');
        });

        Schema::table('thickness_remarks', function (Blueprint $table) {
            $table->dropUnique('uk_thickness_remark_name');
        });
    }
};
