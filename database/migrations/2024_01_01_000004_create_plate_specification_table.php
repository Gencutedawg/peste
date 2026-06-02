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
            $table->string('plate_code', 100);

            $table->decimal('weight_usl', 10, 2)->nullable();
            $table->decimal('weight_target', 10, 2)->nullable();
            $table->decimal('weight_lsl', 10, 2)->nullable();

            $table->decimal('thick_usl', 10, 2)->nullable();
            $table->decimal('thick_target', 10, 2)->nullable();
            $table->decimal('thick_lsl', 10, 2)->nullable();

            $table->decimal('mc_lsl', 10, 2)->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
