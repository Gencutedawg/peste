<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuringBooth extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'curing_booth';

    protected $fillable = [
        'curing_booth',
        'created_by',
        'updated_by',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user who created this curing booth
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this curing booth
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
