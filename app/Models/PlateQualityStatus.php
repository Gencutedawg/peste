<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlateQualityStatus extends Model
{
    protected $table = 'plate_quality_status';

    protected $fillable = ['status_name', 'created_by', 'updated_by', 'is_active'];

    public function weightLogs()
    {
        return $this->hasMany(PlateWeightLog::class, 'plate_quality_status_id');
    }
}
