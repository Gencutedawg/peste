<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionLineSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('production_line')->insert([
            ['id' => 1, 'line_name' => 'Cominco 1', 'is_active' => 1],
            ['id' => 2, 'line_name' => 'Cominco 2', 'is_active' => 1],
            ['id' => 3, 'line_name' => 'Cominco 3', 'is_active' => 1],
            ['id' => 4, 'line_name' => 'Delphi 1', 'is_active' => 1],
            ['id' => 5, 'line_name' => 'Delphi 2', 'is_active' => 1],
            ['id' => 6, 'line_name' => 'Delphi 3', 'is_active' => 1],
        ]);
    }
}
