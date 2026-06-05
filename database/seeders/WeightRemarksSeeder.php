<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightRemarksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('weight_remarks')->insert([
            [
                'remark_name' => 'Within Specification',
                'description' => 'All samples passed weight specification limits',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Minor Deviation',
                'description' => 'Some samples slightly outside limits but acceptable',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Out of Specification',
                'description' => 'Samples exceeded acceptable weight limits',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Equipment Malfunction',
                'description' => 'Scale or measuring equipment malfunction detected',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Operator Error',
                'description' => 'Measurement error by operator',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Material Issue',
                'description' => 'Raw material quality issue detected',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'remark_name' => 'Other',
                'description' => 'Other remarks not listed above',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
