<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThicknessRemarksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('thickness_remarks')->insert([
            [
                'remark_name' => 'Decreased clearance between hopper trowell roll and drum',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Increased clearance between hopper trowell roll and drum',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked grid/coining thickness - out of specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked grid/coining thickness - within specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked paste density at hopper - out of specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Checked paste density at hopper - within specification',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
