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
                'remark_name' => 'Decreased Clearance between hopper trowell roll and drum',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Increased Clearance between hopper trowell roll and drum',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked grid weight - out of specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked grid weight - within specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
