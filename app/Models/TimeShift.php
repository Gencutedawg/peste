<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeShift extends Model
{
    protected $table = 'time_shift';
    public $timestamps = false;

    protected $fillable = ['shift_name', 'start_time', 'end_time', 'created_by', 'updated_by', 'is_active'];

    public function weightLogs()
    {
        return $this->hasMany(PlateWeightLog::class, 'time_shift_id');
    }
}
