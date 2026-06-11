<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightRemarksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('weight_remarks')->insertOrIgnore([
            [
                'remark_name' => 'Within Specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Minor Deviation',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Out of Specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Equipment Malfunction',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Operator Error',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Material Issue',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Other',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
