<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlateMoistureLog extends Model
{
    protected $table = 'plate_moisture_log';

    public $timestamps = false;

    protected $fillable = [
        'production_line_id',
        'production_line_name',
        'user_id',
        'operator_name',
        'time_shift_id',
        'shift_name',
        'plate_specification_id',
        'plate_code',
        'run_type_id',
        'run_type_name',
        'moisture_date_log',
        'moisture_time_log',
        'mc_result',
        'plate_quality_status_id',
        'quality_status_name',
        'moisture_remark_id',
        'remark_name',
        'curing_booth_id',
        'rack_no',
        'created_by', 'updated_by', 'is_active',
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'moisture_date_log' => 'date',
        'mc_result' => 'decimal:2',
    ];

    public function productionLine()
    {
        return $this->belongsTo(ProductionLine::class, 'production_line_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift()
    {
        return $this->belongsTo(TimeShift::class, 'time_shift_id');
    }

    public function plateSpecification()
    {
        return $this->belongsTo(PlateSpecification::class);
    }

    public function runType()
    {
        return $this->belongsTo(RunType::class, 'run_type_id');
    }

    public function qualityStatus()
    {
        return $this->belongsTo(PlateQualityStatus::class, 'plate_quality_status_id');
    }

    public function remark()
    {
        return $this->belongsTo(MoistureRemarks::class, 'moisture_remark_id');
    }
}
