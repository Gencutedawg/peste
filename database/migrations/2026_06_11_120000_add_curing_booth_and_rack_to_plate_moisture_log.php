<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('plate_moisture_log', function (Blueprint $table) {
            $table->unsignedBigInteger('curing_booth_id')->nullable()->after('moisture_remark_id');
            $table->string('rack_no')->nullable()->after('curing_booth_id');

            $table->foreign('curing_booth_id')
                ->references('id')
                ->on('curing_booth')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('plate_moisture_log', function (Blueprint $table) {
            $table->dropForeign(['curing_booth_id']);
            $table->dropColumn(['curing_booth_id', 'rack_no']);
        });
    }
};
