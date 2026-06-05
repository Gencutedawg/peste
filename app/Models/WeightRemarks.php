<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightRemarks extends Model
{
    protected $table = 'weight_remarks';

    protected $fillable = [
        'remark_name',
        'description',
        'is_active',
    ];
}
