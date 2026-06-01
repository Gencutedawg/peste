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
        Schema::create('plate_specification', function (Blueprint $table) {
            $table->id();
            $table->string('plate_name', 100);
            
            // Weight specifications
            $table->decimal('weight_usl', 10, 2)->nullable();
            $table->decimal('weight_target', 10, 2)->nullable();
            $table->decimal('weight_lsl', 10, 2)->nullable();
            
            // Thickness specifications
            $table->decimal('thick_usl', 10, 2)->nullable();
            $table->decimal('thick_target', 10, 2)->nullable();
            $table->decimal('thick_lsl', 10, 2)->nullable();
            
            // Moisture content specifications
            $table->decimal('mc_lsl', 10, 2)->nullable();
            
            // Audit tracking
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('is_active')->default(true);
            
            // Foreign key constraint
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plate_specification');
    }
};
