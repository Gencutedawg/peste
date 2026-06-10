<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlateThicknessLog extends Model
{
    protected $table = 'plate_thickness_log';

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
        'thickness_date_log',
        'thickness_time_log',
        'op_c1', 'op_c2', 'op_c3', 'op_c4',
        'nop_c1', 'nop_c2', 'nop_c3', 'nop_c4',
        'plate_quality_status_id',
        'quality_status_name',
        'thickness_remark_id',
        'remark_name',
        'created_by', 'updated_by', 'is_active'
    ];

    protected $casts = [
        'thickness_date_log' => 'date',
        'op_c1' => 'decimal:2',
        'op_c2' => 'decimal:2',
        'op_c3' => 'decimal:2',
        'op_c4' => 'decimal:2',
        'nop_c1' => 'decimal:2',
        'nop_c2' => 'decimal:2',
        'nop_c3' => 'decimal:2',
        'nop_c4' => 'decimal:2',
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
        return $this->belongsTo(ThicknessRemarks::class, 'thickness_remark_id');
    }
}
