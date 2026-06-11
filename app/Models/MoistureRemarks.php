<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoistureRemarks extends Model
{
    protected $table = 'moisture_remarks';

    protected $fillable = [
        'remark_name',
        'description',
        'is_active',
    ];
}
