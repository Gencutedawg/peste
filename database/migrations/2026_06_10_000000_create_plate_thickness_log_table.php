<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('thickness_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('remark_name', 255);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('plate_thickness_log', function (Blueprint $table) {
            $table->id();
            $table->integer('production_line_id');
            $table->string('production_line_name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('operator_name')->nullable();
            $table->integer('time_shift_id');
            $table->string('shift_name')->nullable();
            $table->unsignedBigInteger('plate_specification_id');
            $table->string('plate_code')->nullable();
            $table->integer('run_type_id');
            $table->string('run_type_name')->nullable();
            $table->date('thickness_date_log');
            $table->time('thickness_time_log');
            $table->decimal('op_c1', 10, 2)->nullable();
            $table->decimal('op_c2', 10, 2)->nullable();
            $table->decimal('op_c3', 10, 2)->nullable();
            $table->decimal('op_c4', 10, 2)->nullable();
            $table->decimal('nop_c1', 10, 2)->nullable();
            $table->decimal('nop_c2', 10, 2)->nullable();
            $table->decimal('nop_c3', 10, 2)->nullable();
            $table->decimal('nop_c4', 10, 2)->nullable();
            $table->integer('plate_quality_status_id');
            $table->string('quality_status_name')->nullable();
            $table->integer('thickness_remark_id')->nullable();
            $table->string('remark_name')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plate_thickness_log');
        Schema::dropIfExists('thickness_remarks');
    }
};



