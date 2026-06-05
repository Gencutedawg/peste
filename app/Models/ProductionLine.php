<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionLine extends Model
{
    protected $table = 'production_line';
    public $timestamps = false;

    protected $fillable = ['line_name', 'is_active'];

    public function weightLogs()
    {
        return $this->hasMany(PlateWeightLog::class, 'production_line_id');
    }
}
