<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RunType extends Model
{
    protected $table = 'run_type';
    public $timestamps = false;

    protected $fillable = ['run_type_name', 'created_by', 'updated_by', 'is_active'];

    public function weightLogs()
    {
        return $this->hasMany(PlateWeightLog::class, 'run_type_id');
    }
}
