<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeShiftSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('time_shift')->insert([
            ['shift_name' => 'Morning Shift', 'start_time' => '06:00:00', 'end_time' => '14:00:00', 'is_active' => 1],
            ['shift_name' => 'Afternoon Shift', 'start_time' => '14:00:00', 'end_time' => '22:00:00', 'is_active' => 1],
            ['shift_name' => 'Night Shift', 'start_time' => '22:00:00', 'end_time' => '06:00:00', 'is_active' => 1],
        ]);
    }
}
