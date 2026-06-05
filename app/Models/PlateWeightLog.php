<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlateWeightLog extends Model
{
    protected $table = 'plate_weight_log';

    protected $fillable = [
        'production_line_id',
        'user_id',
        'time_shift_id',
        'plate_specification_id',
        'run_type_id',
        'weight_date_log',
        'weight_time_log',
        'op_w1', 'op_w2', 'op_w3', 'op_w4',
        'nop_w1', 'nop_w2', 'nop_w3', 'nop_w4',
        'plate_quality_status_id',
        'weight_remark_id',
        'created_by', 'updated_by', 'is_active'
    ];

    protected $casts = [
        'weight_date_log' => 'date',
        'weight_time_log' => 'datetime:H:i:s',
        'op_w1' => 'decimal:2',
        'op_w2' => 'decimal:2',
        'op_w3' => 'decimal:2',
        'op_w4' => 'decimal:2',
        'nop_w1' => 'decimal:2',
        'nop_w2' => 'decimal:2',
        'nop_w3' => 'decimal:2',
        'nop_w4' => 'decimal:2',
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
        return $this->belongsTo(WeightRemarks::class, 'weight_remark_id');
    }
}
