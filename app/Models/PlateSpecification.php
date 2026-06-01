<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateSpecification extends Model
{
    use HasFactory;

    protected $table = 'plate_specification';

    protected $fillable = [
        'plate_code',
        'weight_usl',
        'weight_target',
        'weight_lsl',
        'thick_usl',
        'thick_target',
        'thick_lsl',
        'mc_lsl',
        'created_by',
        'updated_by',
        'is_active',
    ];

    protected $casts = [
        'weight_usl' => 'decimal:2',
        'weight_target' => 'decimal:2',
        'weight_lsl' => 'decimal:2',
        'thick_usl' => 'decimal:2',
        'thick_target' => 'decimal:2',
        'thick_lsl' => 'decimal:2',
        'mc_lsl' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created this plate specification
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this plate specification
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
