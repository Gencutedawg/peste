<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlateQualityStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plate_quality_status')->insert([
            ['status_name' => 'Pass', 'is_active' => 1],
            ['status_name' => 'Fail', 'is_active' => 1],
            ['status_name' => 'Pending', 'is_active' => 1],
        ]);
    }
}
