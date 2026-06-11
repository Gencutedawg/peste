<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoistureRemarksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('moisture_remarks')->insert([
            [
                'remark_name' => 'Increased oven temp',
                'description' => 'Oven temperature was increased',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Decreased oven temp',
                'description' => 'Oven temperature was decreased',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Increased conveyor speed',
                'description' => 'Conveyor speed was increased',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Decreased conveyor speed',
                'description' => 'Conveyor speed was decreased',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
