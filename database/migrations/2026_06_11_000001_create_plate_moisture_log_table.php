<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plate_moisture_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('production_line_id');
            $table->string('production_line_name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('operator_name')->nullable();
            $table->unsignedBigInteger('time_shift_id');
            $table->string('shift_name')->nullable();
            $table->unsignedBigInteger('plate_specification_id');
            $table->string('plate_code')->nullable();
            $table->unsignedBigInteger('run_type_id');
            $table->string('run_type_name')->nullable();
            $table->date('moisture_date_log');
            $table->time('moisture_time_log');
            $table->decimal('mc_result', 10, 2)->nullable();
            $table->unsignedBigInteger('plate_quality_status_id');
            $table->string('quality_status_name')->nullable();
            $table->unsignedBigInteger('moisture_remark_id')->nullable();
            $table->string('remark_name')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('is_active')->default(true);

            // Foreign keys
            $table->foreign('production_line_id')
                ->references('id')
                ->on('production_line')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('time_shift_id')
                ->references('id')
                ->on('time_shift')
                ->onDelete('cascade');
            $table->foreign('plate_specification_id')
                ->references('id')
                ->on('plate_specification')
                ->onDelete('cascade');
            $table->foreign('run_type_id')
                ->references('id')
                ->on('run_type')
                ->onDelete('cascade');
            $table->foreign('plate_quality_status_id')
                ->references('id')
                ->on('plate_quality_status')
                ->onDelete('cascade');
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

    public function down(): void
    {
        Schema::dropIfExists('plate_moisture_log');
    }
};
