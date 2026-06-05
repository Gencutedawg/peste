<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RunTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('run_type')->insert([
            ['id' => 1, 'run_type_name' => 'Start-Up', 'is_active' => 1],
            ['id' => 2, 'run_type_name' => 'Normal', 'is_active' => 1],
        ]);
    }
}
