<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('plate_moisture_log', function (Blueprint $table) {
            $table->decimal('from_temperature', 5, 2)->nullable()->comment('From temperature in Celsius');
            $table->decimal('to_temperature', 5, 2)->nullable()->comment('To temperature in Celsius');
        });
    }

    public function down(): void
    {
        Schema::table('plate_moisture_log', function (Blueprint $table) {
            $table->dropColumn(['from_temperature', 'to_temperature']);
        });
    }
};
